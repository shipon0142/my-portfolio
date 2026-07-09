@extends('study.layout')
@section('title', 'Not found')

@section('body')
<main class="max-w-xl mx-auto px-6 py-24 text-center">
    <p class="text-cyan-400 uppercase tracking-widest">404</p>
    <h1 class="text-4xl font-bold mt-2">Page not found</h1>
    <p class="text-zinc-400 mt-3">The page you're looking for doesn't exist or is still a draft.</p>
    <a href="{{ route('study.index') }}" class="inline-block mt-6 text-cyan-400 hover:underline">Back to study</a>
</main>
@endsection
