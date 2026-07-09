@csrf
<div class="space-y-4 max-w-xl">
    <div>
        <label class="block text-sm text-zinc-400 mb-1">Title</label>
        <input name="title" value="{{ old('title', $topic->title) }}" required
            class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
        @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-zinc-400 mb-1">Slug (auto if blank)</label>
        <input name="slug" value="{{ old('slug', $topic->slug) }}"
            class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
        @error('slug') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-zinc-400 mb-1">Description</label>
        <textarea name="description" rows="3"
            class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">{{ old('description', $topic->description) }}</textarea>
        @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-zinc-400 mb-1">Sort order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $topic->sort_order ?? 0) }}"
            class="w-32 rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
    </div>

    <div class="pt-2">
        <button class="bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg px-4 py-2">Save</button>
        <a href="{{ route('admin.study.topics.index') }}" class="ml-2 text-zinc-400 hover:text-zinc-200">Cancel</a>
    </div>
</div>
