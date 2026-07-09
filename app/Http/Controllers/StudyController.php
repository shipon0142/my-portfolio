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
        $pages = $topic->pages()->published()->orderByDesc('published_at')->get();

        if ($pages->isEmpty()) {
            abort(404);
        }

        return view('study.topic', compact('topic', 'pages'));
    }

    public function page(Topic $topic, Page $page)
    {
        \Log::info('study.page hit', [
            'topic_id'          => $topic->id,
            'topic_slug'        => $topic->slug,
            'page_id'           => $page->id,
            'page_slug'         => $page->slug,
            'page_topic_id'     => $page->topic_id,
            'page_status'       => $page->status,
            'page_published_at' => (string) $page->published_at,
            'now'               => (string) now(),
            'is_future'         => $page->published_at?->isFuture(),
        ]);

        if ($page->topic_id !== $topic->id) {
            abort(404, 'topic mismatch');
        }
        if ($page->status !== 'published' || $page->published_at === null || $page->published_at->isFuture()) {
            abort(404, 'not published or future');
        }

        return view('study.page', compact('topic', 'page'));
    }
}
