@extends('study.layout')
@section('title', $locale === 'bn'
    ? ($page->meta_title_bn ?? $page->meta_title ?? $page->title_bn ?? $page->title)
    : ($page->meta_title ?? $page->title))

@push('head')
    @php
        $metaDesc = $locale === 'bn'
            ? ($page->meta_description_bn ?? $page->meta_description)
            : $page->meta_description;
    @endphp
    @if ($metaDesc)
        <meta name="description" content="{{ $metaDesc }}">
    @endif
@endpush

@if ($locale === 'bn')
@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        html[lang="bn"] body,
        html[lang="bn"] .prose,
        html[lang="bn"] h1,
        html[lang="bn"] h2,
        html[lang="bn"] h3 {
            font-family: 'Noto Sans Bengali', 'Geist', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
@endpush
@endif

@section('body')
@php
    // Title falls back to English if title_bn is empty — even when serving Bangla —
    // so admins who translate only the body don't render a blank heading.
    $title = $locale === 'bn' ? ($page->title_bn ?? $page->title) : $page->title;
    $body  = $locale === 'bn' ? $page->html_content_bn : $page->html_content;
@endphp

<main class="px-6 py-16">
    <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
        <a href="{{ route('study.topic', $topic) }}" class="text-zinc-500 hover:text-cyan-400 text-sm">
            &larr; {{ $topic->title }}
        </a>
        @if ($page->hasBangla())
            @if ($locale === 'en')
                <a href="{{ route('study.page', [$topic, $page]) }}?lang=bn"
                   class="text-cyan-400 text-sm hover:underline">বাংলা</a>
            @else
                <a href="{{ route('study.page', [$topic, $page]) }}"
                   class="text-cyan-400 text-sm hover:underline">English</a>
            @endif
        @endif
    </div>

    <article class="prose prose-invert max-w-none">
        {!! $body !!}
    </article>

    @if ($prev || $next)
        @php $langQ = $locale === 'bn' ? '?lang=bn' : ''; @endphp
        <nav class="max-w-3xl mx-auto mt-16 pt-8 border-t border-zinc-800 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @if ($prev)
                <a href="{{ route('study.page', [$topic, $prev]) }}{{ $langQ }}"
                   class="group block bg-zinc-900/60 border border-zinc-800 rounded-xl px-5 py-4 hover:border-cyan-500/50 transition">
                    <div class="text-zinc-500 text-xs mb-1">&larr; {{ $locale === 'bn' ? 'পূর্ববর্তী' : 'Previous' }}</div>
                    <div class="text-zinc-200 group-hover:text-cyan-400">{{ $locale === 'bn' ? ($prev->title_bn ?? $prev->title) : $prev->title }}</div>
                </a>
            @else
                <span></span>
            @endif

            @if ($next)
                <a href="{{ route('study.page', [$topic, $next]) }}{{ $langQ }}"
                   class="group block bg-zinc-900/60 border border-zinc-800 rounded-xl px-5 py-4 hover:border-cyan-500/50 transition sm:text-right">
                    <div class="text-zinc-500 text-xs mb-1">{{ $locale === 'bn' ? 'পরবর্তী' : 'Next' }} &rarr;</div>
                    <div class="text-zinc-200 group-hover:text-cyan-400">{{ $locale === 'bn' ? ($next->title_bn ?? $next->title) : $next->title }}</div>
                </a>
            @endif
        </nav>
    @endif
</main>
@endsection
