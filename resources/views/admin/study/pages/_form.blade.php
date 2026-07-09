@csrf
<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 space-y-4">
        <div>
            <label class="block text-sm text-zinc-400 mb-1">Title</label>
            <input name="title" value="{{ old('title', $page->title) }}" required
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
            @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-zinc-400 mb-1">HTML content</label>
            <textarea id="html_content" name="html_content" rows="20"
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 font-mono text-sm outline-none">{{ old('html_content', $page->html_content) }}</textarea>
            @error('html_content') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <aside class="space-y-4">
        <div>
            <label class="block text-sm text-zinc-400 mb-1">Slug (auto if blank)</label>
            <input name="slug" value="{{ old('slug', $page->slug) }}"
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
            @error('slug') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-zinc-400 mb-1">Template</label>
            <select name="template" id="template"
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
                @foreach (config('study.templates') as $key => $meta)
                    <option value="{{ $key }}" @selected(old('template', $page->template) === $key)>{{ $meta['label'] }}</option>
                @endforeach
            </select>
            @error('template') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-zinc-400 mb-1">Status</label>
            <select name="status" class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
                <option value="draft"     @selected(old('status', $page->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $page->status) === 'published')>Published</option>
            </select>
        </div>

        <div>
            <label class="block text-sm text-zinc-400 mb-1">Meta title</label>
            <input name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
        </div>

        <div>
            <label class="block text-sm text-zinc-400 mb-1">Meta description</label>
            <textarea name="meta_description" rows="3"
                class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>

        <div class="pt-2">
            <button class="w-full bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg py-2">Save</button>
            <a href="{{ route('admin.study.topics.pages.index', $topic) }}" class="block text-center mt-2 text-zinc-400 hover:text-zinc-200">Cancel</a>
        </div>
    </aside>
</div>

@push('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
@endpush

@push('scripts')
    <script src="{{ asset('js/study-editor.js') }}" defer></script>
@endpush
