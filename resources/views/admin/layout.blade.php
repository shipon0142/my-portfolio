<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · Study</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:'Geist',ui-sans-serif,system-ui,sans-serif}</style>
    @stack('head')
</head>
<body class="h-full bg-zinc-950 text-zinc-100 antialiased">
<div class="min-h-full flex">
    <aside class="w-60 border-r border-zinc-800 bg-zinc-950 p-6">
        <a href="{{ route('admin.study.index') }}" class="block text-xl font-semibold text-cyan-400 mb-8">Study CMS</a>
        <nav class="space-y-1 text-sm">
            <a href="{{ route('admin.study.index') }}" class="block px-3 py-2 rounded-lg hover:bg-zinc-900">Dashboard</a>
            <a href="{{ url('/admin/study/topics') }}" class="block px-3 py-2 rounded-lg hover:bg-zinc-900">Topics</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-8">
            @csrf
            <button class="text-sm text-zinc-400 hover:text-cyan-400">Log out</button>
        </form>
    </aside>
    <main class="flex-1 p-8">
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 px-4 py-2">
                {{ session('status') }}
            </div>
        @endif
        @yield('body')
    </main>
</div>
@stack('scripts')
</body>
</html>
