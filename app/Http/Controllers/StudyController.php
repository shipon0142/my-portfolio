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

        // Neighbors follow the same order as the topic index: page_number asc, id as tiebreaker.
        $prev = $topic->pages()->published()
            ->where(fn ($q) => $q
                ->where('page_number', '<', $page->page_number)
                ->orWhere(fn ($q) => $q->where('page_number', $page->page_number)->where('id', '<', $page->id)))
            ->orderByDesc('page_number')->orderByDesc('id')
            ->first();

        $next = $topic->pages()->published()
            ->where(fn ($q) => $q
                ->where('page_number', '>', $page->page_number)
                ->orWhere(fn ($q) => $q->where('page_number', $page->page_number)->where('id', '>', $page->id)))
            ->orderBy('page_number')->orderBy('id')
            ->first();

        return view('study.page', compact('topic', 'page', 'locale', 'prev', 'next'));
    }
}
