@extends('admin.layout')
@section('title', 'Edit page')

@section('body')
<h1 class="text-3xl font-semibold">Edit page</h1>
<form method="POST" action="{{ route('admin.study.topics.pages.update', [$topic, $page]) }}" class="mt-6">
    @method('PUT')
    @include('admin.study.pages._form', ['templates' => $templates])
</form>
@push('scripts')
<script>
    window.STUDY_TEMPLATES = @json($templates);
</script>
@endpush
@endsection
