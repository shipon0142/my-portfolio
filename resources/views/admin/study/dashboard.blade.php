@extends('admin.layout')
@section('title', 'Dashboard')

@section('body')
<h1 class="text-3xl font-semibold">Dashboard</h1>

<div class="grid grid-cols-3 gap-4 mt-6">
    <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-5">
        <p class="text-zinc-400 text-sm">Topics</p>
        <p class="text-3xl font-semibold text-cyan-400 mt-2">{{ $topicCount }}</p>
    </div>
    <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-5">
        <p class="text-zinc-400 text-sm">Pages</p>
        <p class="text-3xl font-semibold text-cyan-400 mt-2">{{ $pageCount }}</p>
    </div>
    <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-5">
        <p class="text-zinc-400 text-sm">Published</p>
        <p class="text-3xl font-semibold text-cyan-400 mt-2">{{ $publishedCount }}</p>
    </div>
</div>

<h2 class="text-xl font-semibold mt-10 mb-3">Published topics</h2>
@if ($publishedTopics->isEmpty())
    <p class="text-zinc-500">No published topics yet.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
        @foreach ($publishedTopics as $topic)
            <div class="flex flex-col justify-between bg-zinc-900/40 border border-zinc-800 rounded-xl p-5 hover:border-cyan-500/50 transition">
                <div>
                    <h3 class="text-lg font-medium text-zinc-100">{{ $topic->title }}</h3>
                    <p class="text-zinc-500 text-sm mt-1">
                        {{ $topic->published_pages_count }} published {{ Str::plural('page', $topic->published_pages_count) }}
                    </p>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.study.topics.pages.index', $topic) }}"
                       class="flex-1 text-center text-xs uppercase tracking-widest border border-zinc-800 hover:border-cyan-500/50 text-zinc-300 hover:text-cyan-400 rounded-lg px-3 py-1.5">
                        Manage
                    </a>
                    <a href="{{ route('study.topic', $topic) }}" target="_blank" rel="noopener"
                       class="flex-1 text-center text-xs uppercase tracking-widest bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg px-3 py-1.5">
                        Read
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif

<h2 class="text-xl font-semibold mt-10 mb-3">Recent pages</h2>
@if ($recentPages->isEmpty())
    <p class="text-zinc-500">No pages yet.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($recentPages as $page)
            <div class="flex flex-col justify-between bg-zinc-900/40 border border-zinc-800 rounded-xl p-5 hover:border-cyan-500/50 transition">
                <div>
                    <p class="text-xs uppercase tracking-widest text-zinc-500">{{ $page->topic->title }}</p>
                    <h3 class="text-lg font-medium text-zinc-100 mt-1">{{ $page->title }}</h3>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-xs uppercase tracking-widest {{ $page->status === 'published' ? 'text-cyan-400' : 'text-zinc-500' }}">
                        {{ $page->status }}
                    </span>
                    <a href="{{ route('admin.study.topics.pages.edit', [$page->topic, $page]) }}"
                       class="text-xs uppercase tracking-widest text-cyan-400 hover:underline">
                        Edit
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
