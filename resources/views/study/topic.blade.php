@extends('study.layout')
@section('title', $topic->title)

@section('body')
<main class="max-w-6xl mx-auto px-6 py-16">
    <a href="{{ route('study.index') }}" class="text-zinc-500 hover:text-cyan-400 text-sm">&larr; All topics</a>
    <header class="mt-4 mb-8">
        <h1 class="text-4xl font-bold">{{ $topic->title }}</h1>
        @if ($topic->description)
            <p class="text-zinc-400 mt-3">{{ $topic->description }}</p>
        @endif
    </header>

    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($pages as $page)
            <li>
                <a href="{{ route('study.page', [$topic, $page]) }}"
                   class="flex flex-col justify-between h-full bg-zinc-900/60 border border-zinc-800 rounded-xl p-5 hover:border-cyan-500/50 transition">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-lg border border-zinc-800 bg-zinc-950 text-zinc-400 text-sm font-mono shrink-0">
                            {{ $loop->iteration }}
                        </span>
                        <span class="text-lg leading-snug">{{ $page->title }}</span>
                    </div>
                    <span class="text-zinc-500 text-sm mt-4 self-end">{{ $page->published_at?->format('M j, Y') }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</main>
@endsection
