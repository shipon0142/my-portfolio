<?php

/**
 * Standalone Migration Console.
 *
 * Deliberately bypasses routes/web.php, routes/api.php, and the HTTP kernel
 * so it keeps working when the rest of the app is broken. Bootstraps only
 * enough of Laravel to reach config, DB, Artisan, and Log.
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

$expectedToken  = config('migration.token');
$migrationsDir  = realpath(__DIR__ . '/../database/migrations') ?: (__DIR__ . '/../database/migrations');
$throttleFile   = __DIR__ . '/../storage/framework/cache/mig-throttle.json';
$cookieName     = 'mig_auth';
$cookiePath     = '/migrate.php';
$rateWindowSec  = 3600;
$rateMaxFails   = 10;

function mig_client_ip(): string {
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

function mig_is_throttled(string $file, string $ip, int $window, int $max): bool {
    if (!is_file($file)) return false;
    try {
        $data = json_decode((string) @file_get_contents($file), true) ?: [];
    } catch (\Throwable $e) {
        return false;
    }
    $entry = $data[$ip] ?? null;
    if (!$entry) return false;
    if ((int) ($entry['first_attempt'] ?? 0) < time() - $window) return false;
    return (int) ($entry['count'] ?? 0) >= $max;
}

function mig_record_failure(string $file, string $ip, int $window): void {
    try {
        $data = is_file($file) ? (json_decode((string) @file_get_contents($file), true) ?: []) : [];
        $entry = $data[$ip] ?? null;
        if (!$entry || (int) ($entry['first_attempt'] ?? 0) < time() - $window) {
            $data[$ip] = ['count' => 1, 'first_attempt' => time()];
        } else {
            $data[$ip]['count'] = (int) $data[$ip]['count'] + 1;
        }
        foreach ($data as $k => $v) {
            if ((int) ($v['first_attempt'] ?? 0) < time() - $window) unset($data[$k]);
        }
        @mkdir(dirname($file), 0775, true);
        @file_put_contents($file, json_encode($data), LOCK_EX);
    } catch (\Throwable $e) {
        // Rate limiting is best-effort; failing here must not break the page.
    }
}

function mig_token_ok(?string $expected): bool {
    if (empty($expected)) return false;
    $provided = $_POST['password'] ?? $_COOKIE['mig_auth'] ?? '';
    if (!is_string($provided) || $provided === '') return false;
    return hash_equals($expected, $provided);
}

function mig_set_cookie(string $name, string $value, string $path): void {
    setcookie($name, $value, [
        'expires'  => time() + 3600,
        'path'     => $path,
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    $_COOKIE[$name] = $value;
}

function mig_clear_cookie(string $name, string $path): void {
    setcookie($name, '', [
        'expires'  => time() - 3600,
        'path'     => $path,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    unset($_COOKIE[$name]);
}

$flash            = null;
$isAuthenticated  = mig_token_ok($expectedToken);
$dbError          = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $ip = mig_client_ip();
        if (mig_is_throttled($throttleFile, $ip, $rateWindowSec, $rateMaxFails)) {
            $flash = ['type' => 'error', 'msg' => 'Too many failed attempts. Try again in an hour.'];
            $isAuthenticated = false;
        } elseif (mig_token_ok($expectedToken)) {
            mig_set_cookie($cookieName, (string) $_POST['password'], $cookiePath);
            $isAuthenticated = true;
        } else {
            mig_record_failure($throttleFile, $ip, $rateWindowSec);
            Log::warning('Migration UI: failed login', ['ip' => $ip]);
            $flash = ['type' => 'error', 'msg' => 'Invalid password.'];
            $isAuthenticated = false;
        }
    } elseif ($action === 'logout') {
        mig_clear_cookie($cookieName, $cookiePath);
        $isAuthenticated = false;
        $flash = ['type' => 'info', 'msg' => 'Signed out.'];
    } elseif ($action === 'run' && $isAuthenticated) {
        $name = (string) ($_POST['migration_name'] ?? '');
        if (!preg_match('/^[A-Za-z0-9_]+$/', $name)) {
            $flash = ['type' => 'error', 'msg' => 'Invalid migration name.'];
        } else {
            $filePath = $migrationsDir . DIRECTORY_SEPARATOR . $name . '.php';
            if (!is_file($filePath)) {
                $flash = ['type' => 'error', 'msg' => 'Migration file not found: ' . $name];
            } else {
                try {
                    $alreadyApplied = DB::table('migrations')->where('migration', $name)->exists();
                } catch (\Throwable $e) {
                    Log::error('Migration UI: DB check failed', ['exception' => $e->getMessage()]);
                    $alreadyApplied = null;
                    $flash = ['type' => 'error', 'msg' => 'Database unreachable. Check server logs.'];
                }
                if ($alreadyApplied === true) {
                    $flash = ['type' => 'info', 'msg' => 'Already executed: ' . $name];
                } elseif ($alreadyApplied === false) {
                    try {
                        Log::info('Migration UI: running', ['migration' => $name]);
                        Artisan::call('migrate', [
                            '--force' => true,
                            '--path'  => 'database/migrations/' . $name . '.php',
                        ]);
                        Log::info('Migration UI: success', ['migration' => $name]);
                        $flash = ['type' => 'success', 'msg' => 'Migration executed: ' . $name];
                    } catch (\Throwable $e) {
                        Log::error('Migration UI: migrate command threw', [
                            'migration' => $name,
                            'exception' => $e->getMessage(),
                        ]);
                        $flash = ['type' => 'error', 'msg' => 'Migration failed. Check server logs.'];
                    }
                }
            }
        }
    }
}

$migrations = [];
if ($isAuthenticated) {
    try {
        $files = glob($migrationsDir . DIRECTORY_SEPARATOR . '*.php') ?: [];
        $applied = DB::table('migrations')->pluck('migration')->all();
        $appliedSet = array_flip($applied);
        foreach ($files as $file) {
            $mname = basename($file, '.php');
            $migrations[] = [
                'name'    => $mname,
                'applied' => isset($appliedSet[$mname]),
            ];
        }
        usort($migrations, fn($a, $b) => strcmp($a['name'], $b['name']));
    } catch (\Throwable $e) {
        Log::error('Migration UI: failed to load migration list', ['exception' => $e->getMessage()]);
        $dbError = 'Could not read migration status from database.';
    }
}

$appliedCount = count(array_filter($migrations, fn($m) => $m['applied']));
$pendingCount = count($migrations) - $appliedCount;

$flashClasses = [
    'success' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300',
    'error'   => 'bg-red-500/10 border-red-500/30 text-red-300',
    'info'    => 'bg-cyan-500/10 border-cyan-500/30 text-cyan-300',
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Migration Console</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        html, body { font-family: 'Geist', ui-sans-serif, system-ui, sans-serif; }
        .font-mono { font-family: 'Geist Mono', ui-monospace, 'SFMono-Regular', Menlo, monospace; }
    </style>
</head>
<body class="bg-neutral-950 text-neutral-100 min-h-screen antialiased">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-16">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 text-xs font-mono text-neutral-500 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                Standalone
            </div>
            <h1 class="text-2xl font-semibold tracking-tight mt-3">Migration Console</h1>
            <p class="text-sm text-neutral-400 mt-1">Run individual migrations on this environment.</p>
        </div>

        <?php if ($flash): ?>
            <div class="mb-6 border rounded-lg px-4 py-3 text-sm <?= $flashClasses[$flash['type']] ?? '' ?>">
                <?= htmlspecialchars((string) $flash['msg']) ?>
            </div>
        <?php endif; ?>

        <?php if (!$isAuthenticated): ?>
            <form method="POST" class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                <input type="hidden" name="action" value="login">
                <label for="password" class="block text-sm text-neutral-300 mb-2">Password</label>
                <input id="password" type="password" name="password" autofocus required autocomplete="off"
                       class="w-full bg-neutral-950 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-neutral-100 placeholder-neutral-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/40 transition">
                <button type="submit"
                        class="mt-4 w-full bg-cyan-500 hover:bg-cyan-400 text-neutral-950 font-medium rounded-lg px-4 py-2 text-sm transition">
                    Sign in
                </button>
            </form>
        <?php else: ?>
            <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-800">
                    <div>
                        <div class="text-sm text-neutral-200 font-medium">Migrations</div>
                        <div class="text-xs text-neutral-500 mt-0.5">
                            <?= $appliedCount ?> applied · <?= $pendingCount ?> pending
                        </div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="text-xs text-neutral-400 hover:text-neutral-200 transition">
                            Sign out
                        </button>
                    </form>
                </div>

                <?php if ($dbError): ?>
                    <div class="px-6 py-8 text-center text-sm text-red-300">
                        <?= htmlspecialchars($dbError) ?>
                    </div>
                <?php elseif (empty($migrations)): ?>
                    <div class="px-6 py-8 text-center text-sm text-neutral-500">
                        No migration files found in <span class="font-mono">database/migrations</span>.
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-neutral-950/50">
                                <tr class="text-left text-[11px] text-neutral-500 uppercase tracking-wider">
                                    <th class="px-6 py-3 font-medium">Migration</th>
                                    <th class="px-6 py-3 font-medium">Status</th>
                                    <th class="px-6 py-3 font-medium text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-800">
                                <?php foreach ($migrations as $m): ?>
                                    <tr class="hover:bg-neutral-800/30 transition">
                                        <td class="px-6 py-3 font-mono text-xs text-neutral-300 break-all">
                                            <?= htmlspecialchars($m['name']) ?>
                                        </td>
                                        <td class="px-6 py-3">
                                            <?php if ($m['applied']): ?>
                                                <span class="inline-flex items-center gap-1.5 text-[11px] px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                    Applied
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1.5 text-[11px] px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                    Pending
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-3 text-right">
                                            <?php if (!$m['applied']): ?>
                                                <form method="POST" class="inline"
                                                      onsubmit="return confirm('Run migration: <?= htmlspecialchars($m['name'], ENT_QUOTES) ?>?');">
                                                    <input type="hidden" name="action" value="run">
                                                    <input type="hidden" name="migration_name" value="<?= htmlspecialchars($m['name']) ?>">
                                                    <button type="submit"
                                                            class="text-xs bg-cyan-500 hover:bg-cyan-400 text-neutral-950 font-medium px-3 py-1.5 rounded-md transition">
                                                        Run
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-xs text-neutral-600">—</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="mt-8 text-center text-xs text-neutral-600 font-mono">
            /migrate.php
        </div>
    </div>
</body>
</html>
