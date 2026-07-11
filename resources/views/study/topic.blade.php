@extends('study.layout')
@section('title', $topic->title)

@section('body')
<main class="max-w-3xl mx-auto px-6 py-16">
    <a href="{{ route('study.index') }}" class="text-zinc-500 hover:text-cyan-400 text-sm">&larr; All topics</a>
    <header class="mt-4 mb-8">
        <h1 class="text-4xl font-bold">{{ $topic->title }}</h1>
        @if ($topic->description)
            <p class="text-zinc-400 mt-3">{{ $topic->description }}</p>
        @endif
    </header>

    <ul class="space-y-2">
        @foreach ($pages as $page)
            <li>
                <a href="{{ route('study.page', [$topic, $page]) }}"
                   class="flex items-center justify-between bg-zinc-900/60 border border-zinc-800 rounded-xl px-5 py-4 hover:border-cyan-500/50 transition">
                    <span class="flex items-center gap-4">
                        <span class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-lg border border-zinc-800 bg-zinc-950 text-zinc-400 text-sm font-mono">
                            {{ $loop->iteration }}
                        </span>
                        <span class="text-lg">{{ $page->title }}</span>
                    </span>
                    <span class="text-zinc-500 text-sm">{{ $page->published_at?->format('M j, Y') }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</main>
@endsection
