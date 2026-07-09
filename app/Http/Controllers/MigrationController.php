<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MigrationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $expected = config('migration.token');
        $provided = $request->bearerToken();

        if (empty($expected) || empty($provided) || !hash_equals($expected, $provided)) {
            Log::warning('Migration endpoint: unauthorized request', [
                'ip' => $request->ip(),
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $validated = $request->validate([
            'migration_name' => ['required', 'string', 'regex:/^[A-Za-z0-9_]+$/'],
        ]);

        $name = $validated['migration_name'];
        $relativePath = "database/migrations/{$name}.php";
        $absolutePath = base_path($relativePath);

        if (!File::exists($absolutePath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Migration file not found',
                'migration' => $name,
            ], 404);
        }

        if (DB::table('migrations')->where('migration', $name)->exists()) {
            Log::info('Migration endpoint: already executed', ['migration' => $name]);
            return response()->json([
                'status' => 'skipped',
                'message' => 'Migration already executed',
                'migration' => $name,
            ], 200);
        }

        Log::info('Migration endpoint: running', ['migration' => $name]);

        try {
            Artisan::call('migrate', [
                '--force' => true,
                '--path' => $relativePath,
            ]);
        } catch (\Throwable $e) {
            Log::error('Migration endpoint: migrate command threw', [
                'migration' => $name,
                'exception' => $e->getMessage(),
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Migration failed',
                'migration' => $name,
            ], 500);
        }

        Log::info('Migration endpoint: success', ['migration' => $name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Migration executed',
            'migration' => $name,
        ], 200);
    }
}
