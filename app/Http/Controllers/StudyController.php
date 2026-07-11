<?php

namespace App\Http\Controllers;

use App\Models\Study\Page;
use App\Models\Study\Topic;

class StudyController extends Controller
{
    public function index()
    {
        $topics = Topic::whereHas('pages', fn ($q) => $q->published())
            ->withCount(['pages as published_pages_count' => fn ($q) => $q->published()])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('study.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        $pages = $topic->pages()->published()
            ->orderBy('page_number')->orderBy('id')
            ->get();

        if ($pages->isEmpty()) {
            abort(404);
        }

        return view('study.topic', compact('topic', 'pages'));
    }

    public function page(Topic $topic, Page $page, \Illuminate\Http\Request $request)
    {
        if ($page->topic_id !== $topic->id) {
            abort(404);
        }
        if ($page->status !== 'published' || $page->published_at === null || $page->published_at->isFuture()) {
            abort(404);
        }

        $locale = $request->query('lang') === 'bn' && $page->hasBangla() ? 'bn' : 'en';

        // Full ordered list drives both prev/next and the numbered pagination bar.
        $siblings = $topic->pages()->published()
            ->orderBy('page_number')->orderBy('id')
            ->get(['id', 'slug', 'title', 'title_bn', 'page_number']);

        $currentIndex = $siblings->search(fn ($p) => $p->id === $page->id);
        $prev = $currentIndex > 0 ? $siblings[$currentIndex - 1] : null;
        $next = $currentIndex !== false && $currentIndex < $siblings->count() - 1
            ? $siblings[$currentIndex + 1]
            : null;

        return view('study.page', compact('topic', 'page', 'locale', 'prev', 'next', 'siblings', 'currentIndex'));
    }
}
