@extends('admin.layout')
@section('title', 'Pages — '.$topic->title)

@section('body')
<div class="flex items-center justify-between">
    <div>
        <p class="text-zinc-500 text-sm">{{ $topic->title }}</p>
        <h1 class="text-3xl font-semibold">Pages</h1>
    </div>
    <a href="{{ route('admin.study.topics.pages.create', $topic) }}"
       class="bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg px-4 py-2">
        Add page
    </a>
</div>

<div class="mt-6 border border-zinc-800 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900 text-zinc-400">
            <tr>
                <th class="text-left px-4 py-3 w-16">#</th>
                <th class="text-left px-4 py-3">Title</th>
                <th class="text-left px-4 py-3">Template</th>
                <th class="text-left px-4 py-3">Status</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($pages as $page)
            <tr class="border-t border-zinc-800">
                <td class="px-4 py-3 text-zinc-500">{{ $page->page_number }}</td>
                <td class="px-4 py-3">{{ $page->title }}</td>
                <td class="px-4 py-3 text-zinc-500">{{ $page->template }}</td>
                <td class="px-4 py-3 uppercase text-xs tracking-widest {{ $page->status === 'published' ? 'text-cyan-400' : 'text-zinc-500' }}">
                    {{ $page->status }}
                </td>
                <td class="px-4 py-3 text-right space-x-3">
                    @if ($page->status === 'draft')
                        <form method="POST" action="{{ route('admin.study.pages.publish', $page) }}" class="inline">
                            @csrf
                            <button class="text-cyan-400 hover:underline">Publish</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.study.pages.unpublish', $page) }}" class="inline">
                            @csrf
                            <button class="text-zinc-400 hover:underline">Unpublish</button>
                        </form>
                    @endif
                    <a href="{{ route('admin.study.topics.pages.edit', [$topic, $page]) }}" class="text-cyan-400 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.study.topics.pages.destroy', [$topic, $page]) }}" class="inline"
                          onsubmit="return confirm('Delete this page?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-6 text-zinc-500">No pages yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
