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
<ul class="space-y-2 mb-10">
    @forelse ($publishedTopics as $topic)
        <li class="flex justify-between items-center bg-zinc-900/40 border border-zinc-800 rounded-lg px-4 py-3">
            <span>
                {{ $topic->title }}
                <span class="text-zinc-500 text-sm">· {{ $topic->published_pages_count }} published {{ Str::plural('page', $topic->published_pages_count) }}</span>
            </span>
            <a href="{{ route('study.topic', $topic) }}" target="_blank" rel="noopener"
               class="text-xs uppercase tracking-widest bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg px-3 py-1.5">
                Read
            </a>
        </li>
    @empty
        <li class="text-zinc-500">No published topics yet.</li>
    @endforelse
</ul>

<h2 class="text-xl font-semibold mt-10 mb-3">Recent pages</h2>
<ul class="space-y-2">
    @forelse ($recentPages as $page)
        <li class="flex justify-between bg-zinc-900/40 border border-zinc-800 rounded-lg px-4 py-3">
            <span>{{ $page->title }} <span class="text-zinc-500 text-sm">· {{ $page->topic->title }}</span></span>
            <span class="text-xs uppercase tracking-widest {{ $page->status === 'published' ? 'text-cyan-400' : 'text-zinc-500' }}">
                {{ $page->status }}
            </span>
        </li>
    @empty
        <li class="text-zinc-500">No pages yet.</li>
    @endforelse
</ul>
@endsection
