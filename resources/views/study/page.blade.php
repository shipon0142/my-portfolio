@extends('study.layout')
@section('title', $page->meta_title ?: $page->title)

@push('head')
    @if ($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
@endpush

@section('body')
<main class="px-6 py-16">
    <div class="max-w-3xl mx-auto mb-8">
        <a href="{{ route('study.topic', $topic) }}" class="text-zinc-500 hover:text-cyan-400 text-sm">
            &larr; {{ $topic->title }}
        </a>
    </div>

    <article class="prose prose-invert max-w-none">
        {!! $page->html_content !!}
    </article>
</main>
@endsection
