@extends('study.layout')
@section('title', 'Sign in')

@section('body')
<main class="min-h-full flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-sm bg-zinc-900/60 border border-zinc-800 rounded-2xl p-8">
        <h1 class="text-2xl font-semibold text-cyan-400 mb-6">Sign in</h1>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm text-zinc-400 mb-1">Email</label>
                <input id="email" name="email" type="email" required autofocus
                    value="{{ old('email') }}"
                    class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm text-zinc-400 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-lg bg-zinc-950 border border-zinc-800 px-3 py-2 focus:border-cyan-500 outline-none">
                @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-zinc-400">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit"
                class="w-full bg-cyan-500 hover:bg-cyan-400 text-zinc-950 font-medium rounded-lg py-2 transition">
                Sign in
            </button>
        </form>
    </div>
</main>
@endsection
