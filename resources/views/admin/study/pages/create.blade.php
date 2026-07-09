@extends('admin.layout')
@section('title', 'New page')

@section('body')
<h1 class="text-3xl font-semibold">New page in {{ $topic->title }}</h1>
<form method="POST" action="{{ route('admin.study.topics.pages.store', $topic) }}" class="mt-6">
    @include('admin.study.pages._form', ['templates' => $templates])
</form>
@push('scripts')
<script>
    window.STUDY_TEMPLATES = @json($templates);
</script>
@endpush
@endsection
