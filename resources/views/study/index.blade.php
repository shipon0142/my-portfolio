@extends('study.layout')
@section('title', 'Study')

@section('body')
<main class="max-w-4xl mx-auto px-6 py-16">
    <header class="mb-12">
        <p class="text-cyan-400 uppercase tracking-widest text-sm">Notes</p>
        <h1 class="text-5xl font-bold mt-2">Study</h1>
        <p class="text-zinc-400 mt-3">Things I'm learning, in one place.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($topics as $topic)
            <a href="{{ route('study.topic', $topic) }}"
               class="block bg-zinc-900/60 border border-zinc-800 rounded-2xl p-6 hover:border-cyan-500/50 transition">
                <h2 class="text-2xl font-semibold text-cyan-400">{{ $topic->title }}</h2>
                @if ($topic->description)
                    <p class="text-zinc-400 mt-2">{{ $topic->description }}</p>
                @endif
                <p class="text-zinc-500 text-sm mt-4">{{ $topic->published_pages_count }} pages</p>
            </a>
        @empty
            <p class="text-zinc-500">No published topics yet.</p>
        @endforelse
    </div>
</main>
@endsection
