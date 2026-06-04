@extends('layouts.app')

@section('content')
    <div class="grid min-h-screen place-items-center px-4 py-10">
        <div class="grid w-full max-w-5xl overflow-hidden rounded-3xl border border-white/70 bg-white shadow-2xl shadow-slate-300/50 md:grid-cols-[1fr_0.9fr]">
            <div class="hidden bg-slate-950 p-10 text-white md:flex md:flex-col md:justify-between">
                <div>
                    <div class="mb-8 grid size-14 place-items-center rounded-2xl bg-white text-lg font-black text-slate-950">SE</div>
                    <h1 class="max-w-sm text-4xl font-black leading-tight tracking-tight">Kelola nilai sekolah dengan lebih rapi.</h1>
                    <p class="mt-4 max-w-md text-sm leading-6 text-slate-300">Dashboard untuk admin, guru, dan siswa dengan data akademik yang mudah dipantau.</p>
                </div>
                <div class="grid grid-cols-3 gap-3 text-sm">
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-2xl font-black">3</div>
                        <div class="text-slate-300">Role</div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-2xl font-black">100</div>
                        <div class="text-slate-300">Skala nilai</div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-2xl font-black">70</div>
                        <div class="text-slate-300">KKM</div>
                    </div>
                </div>
            </div>
            <div class="p-7 sm:p-10">
                <div class="mb-8">
                    <div class="mb-3 inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-indigo-700">Smart Edu System</div>
                    <div class="text-3xl font-black tracking-tight text-slate-950">Selamat datang</div>
                    <p class="mt-2 text-sm text-slate-500">Login untuk masuk ke dashboard sesuai role akun.</p>
                </div>

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="soft-input w-full px-4 py-3 text-sm">
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required class="soft-input w-full px-4 py-3 text-sm">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600">
                    Ingat saya
                </label>
                <button class="w-full rounded-xl bg-slate-950 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-slate-300 transition hover:bg-indigo-700">
                    Login
                </button>
            </form>
            </div>
        </div>
    </div>
@endsection
