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

    @if ($siblings->count() > 1)
        @php
            $langQ    = $locale === 'bn' ? '?lang=bn' : '';
            $total    = $siblings->count();
            $current  = $currentIndex + 1; // 1-based position
            // Windowed page list: always show first & last, current ± 2, with null = ellipsis.
            $window = [];
            for ($i = 1; $i <= $total; $i++) {
                if ($i === 1 || $i === $total || abs($i - $current) <= 2) {
                    $window[] = $i;
                } elseif (end($window) !== null) {
                    $window[] = null;
                }
            }
        @endphp

        <nav class="max-w-3xl mx-auto mt-16 pt-8 border-t border-zinc-800">
            <div class="flex items-center justify-between mb-4">
                <p class="text-zinc-500 text-sm">
                    {{ $locale === 'bn' ? 'পৃষ্ঠা' : 'Page' }} {{ $current }} / {{ $total }}
                </p>
                <div class="flex gap-2">
                    @if ($prev)
                        <a href="{{ route('study.page', [$topic, $prev]) }}{{ $langQ }}"
                           class="px-3 py-1.5 text-sm rounded-lg border border-zinc-800 bg-zinc-900/60 text-zinc-300 hover:border-cyan-500/50 hover:text-cyan-400">
                            &larr; {{ $locale === 'bn' ? 'পূর্ববর্তী' : 'Prev' }}
                        </a>
                    @endif
                    @if ($next)
                        <a href="{{ route('study.page', [$topic, $next]) }}{{ $langQ }}"
                           class="px-3 py-1.5 text-sm rounded-lg border border-zinc-800 bg-zinc-900/60 text-zinc-300 hover:border-cyan-500/50 hover:text-cyan-400">
                            {{ $locale === 'bn' ? 'পরবর্তী' : 'Next' }} &rarr;
                        </a>
                    @endif
                </div>
            </div>

            <ul class="flex flex-wrap gap-2">
                @foreach ($window as $pos)
                    @if ($pos === null)
                        <li class="px-3 py-1.5 text-sm text-zinc-500">…</li>
                    @else
                        @php $sib = $siblings[$pos - 1]; @endphp
                        <li>
                            @if ($pos === $current)
                                <span aria-current="page"
                                      class="inline-block px-3 py-1.5 text-sm rounded-lg border border-cyan-500 bg-cyan-500 text-zinc-950 font-medium">
                                    {{ $pos }}
                                </span>
                            @else
                                <a href="{{ route('study.page', [$topic, $sib->slug]) }}{{ $langQ }}"
                                   title="{{ $locale === 'bn' ? ($sib->title_bn ?? $sib->title) : $sib->title }}"
                                   class="inline-block px-3 py-1.5 text-sm rounded-lg border border-zinc-800 bg-zinc-900/60 text-zinc-300 hover:border-cyan-500/50 hover:text-cyan-400">
                                    {{ $pos }}
                                </a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    @endif
</main>
@endsection
