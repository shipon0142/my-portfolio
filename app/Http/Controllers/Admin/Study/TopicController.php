<?php

namespace App\Http\Controllers\Admin\Study;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Study\StoreTopicRequest;
use App\Http\Requests\Admin\Study\UpdateTopicRequest;
use App\Models\Study\Topic;
use Illuminate\Http\RedirectResponse;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('pages')->orderBy('sort_order')->orderBy('title')->get();
        return view('admin.study.topics.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.study.topics.create', ['topic' => new Topic()]);
    }

    public function store(StoreTopicRequest $request): RedirectResponse
    {
        Topic::create($request->validated());

        return redirect()
            ->route('admin.study.topics.index')
            ->with('status', 'Topic created.');
    }

    public function edit(Topic $topic)
    {
        return view('admin.study.topics.edit', compact('topic'));
    }

    public function update(UpdateTopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->update($request->validated());

        return redirect()
            ->route('admin.study.topics.index')
            ->with('status', 'Topic updated.');
    }

    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();

        return redirect()
            ->route('admin.study.topics.index')
            ->with('status', 'Topic deleted.');
    }
}
