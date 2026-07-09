@extends('admin.layout')
@section('title', 'Create topic')

@section('body')
<h1 class="text-3xl font-semibold">Create topic</h1>
<form method="POST" action="{{ route('admin.study.topics.store') }}" class="mt-6">
    @include('admin.study.topics._form')
</form>
@endsection
