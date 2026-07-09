<?php

namespace App\Http\Controllers\Admin\Study;

use App\Http\Controllers\Admin\Controller;
use App\Models\Study\Page;
use App\Models\Study\Topic;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.study.dashboard', [
            'topicCount'      => Topic::count(),
            'pageCount'       => Page::count(),
            'publishedCount'  => Page::published()->count(),
            'recentPages'     => Page::with('topic')->latest()->limit(5)->get(),
            'publishedTopics' => Topic::whereHas('pages', fn ($q) => $q->published())
                ->withCount(['pages as published_pages_count' => fn ($q) => $q->published()])
                ->orderBy('title')
                ->get(),
        ]);
    }
}
