@extends('admin.layout')
@section('title', 'Topics')

@section('body')
<div class="flex items-center justify-between">
    <h1 class="text-3xl font-semibold">Topics</h1>
    <a href="{{ route('admin.study.topics.create') }}"
       class="bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg px-4 py-2">
        New topic
    </a>
</div>

<div class="mt-6 border border-zinc-800 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900 text-zinc-400">
            <tr>
                <th class="text-left px-4 py-3">Title</th>
                <th class="text-left px-4 py-3">Slug</th>
                <th class="text-left px-4 py-3">Pages</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($topics as $topic)
            <tr class="border-t border-zinc-800">
                <td class="px-4 py-3">{{ $topic->title }}</td>
                <td class="px-4 py-3 text-zinc-500">{{ $topic->slug }}</td>
                <td class="px-4 py-3">{{ $topic->pages_count }}</td>
                <td class="px-4 py-3 text-right space-x-3">
                    <a href="{{ url('/admin/study/topics/'.$topic->slug.'/pages') }}" class="text-cyan-400 hover:underline">Pages</a>
                    <a href="{{ route('admin.study.topics.edit', $topic) }}" class="text-cyan-400 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.study.topics.destroy', $topic) }}" class="inline"
                          onsubmit="return confirm('Delete this topic and all its pages?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="px-4 py-6 text-zinc-500">No topics yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
