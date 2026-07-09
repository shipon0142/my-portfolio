@extends('admin.layout')
@section('title', 'Edit topic')

@section('body')
<h1 class="text-3xl font-semibold">Edit topic</h1>
<form method="POST" action="{{ route('admin.study.topics.update', $topic) }}" class="mt-6">
    @method('PUT')
    @include('admin.study.topics._form')
</form>
@endsection
