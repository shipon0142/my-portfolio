<!doctype html>
<html lang="{{ $locale ?? 'en' }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Study') · Shipon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:'Geist',ui-sans-serif,system-ui,sans-serif}</style>
    @stack('head')
</head>
<body class="h-full bg-zinc-950 text-zinc-100 antialiased">
    @yield('body')
</body>
</html>
