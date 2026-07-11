<?php

namespace App\Http\Controllers\Admin\Study;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Study\StorePageRequest;
use App\Http\Requests\Admin\Study\UpdatePageRequest;
use App\Models\Study\Page;
use App\Models\Study\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index(Topic $topic)
    {
        $pages = $topic->pages()->orderBy('page_number')->orderBy('id')->get();
        return view('admin.study.pages.index', compact('topic', 'pages'));
    }

    public function create(Topic $topic)
    {
        $templates = $this->loadTemplateContents();

        $page = new Page([
            'template'     => 'article',
            'status'       => 'draft',
            'html_content' => $templates['article'],
        ]);

        return view('admin.study.pages.create', compact('topic', 'page', 'templates'));
    }

    public function store(StorePageRequest $request, Topic $topic): RedirectResponse
    {
        $data                 = $request->validated();
        $data['topic_id']     = $topic->id;
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        Page::create($data);

        return redirect()
            ->route('admin.study.topics.pages.index', $topic)
            ->with('status', 'Page created.');
    }

    public function edit(Topic $topic, Page $page)
    {
        $templates = $this->loadTemplateContents();
        return view('admin.study.pages.edit', compact('topic', 'page', 'templates'));
    }

    public function update(UpdatePageRequest $request, Topic $topic, Page $page): RedirectResponse
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && $page->published_at === null) {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        $page->update($data);

        return redirect()
            ->route('admin.study.topics.pages.index', $topic)
            ->with('status', 'Page updated.');
    }

    public function destroy(Topic $topic, Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()
            ->route('admin.study.topics.pages.index', $topic)
            ->with('status', 'Page deleted.');
    }

    public function publish(Page $page): RedirectResponse
    {
        $page->update([
            'status'       => 'published',
            'published_at' => $page->published_at ?? now(),
        ]);

        return back()->with('status', 'Page published.');
    }

    public function unpublish(Page $page): RedirectResponse
    {
        $page->update([
            'status'       => 'draft',
            'published_at' => null,
        ]);

        return back()->with('status', 'Page unpublished.');
    }

    private function loadTemplateContents(): array
    {
        $out = [];
        foreach (array_keys(config('study.templates')) as $key) {
            $path = resource_path("views/study/templates/{$key}.blade.php");
            $out[$key] = File::exists($path) ? File::get($path) : '';
        }
        return $out;
    }
}
