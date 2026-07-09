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
</main>
@endsection
