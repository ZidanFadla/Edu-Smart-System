@extends('layouts.app')

@section('content')
    <div class="grid min-h-screen place-items-center bg-gradient-to-br from-slate-50 via-indigo-50/30 to-violet-50/30 px-4 py-10">
        <div class="grid w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 md:grid-cols-[1fr_0.9fr]">
            {{-- Left Panel --}}
            <div class="hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-10 text-white md:flex md:flex-col md:justify-between">
                <div>
                    <div class="mb-8 grid size-12 place-items-center rounded-xl bg-white/15 backdrop-blur-sm">
                        <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>
                    </div>
                    <h1 class="max-w-sm text-3xl font-bold leading-tight tracking-tight">Kelola nilai sekolah dengan lebih rapi.</h1>
                    <p class="mt-4 max-w-md text-sm leading-relaxed text-indigo-100">Dashboard untuk admin, guru, dan siswa dengan data akademik yang mudah dipantau.</p>
                </div>
                <div class="grid grid-cols-3 gap-3 text-sm">
                    <div class="rounded-xl bg-white/10 p-4 backdrop-blur-sm">
                        <div class="text-2xl font-bold">3</div>
                        <div class="text-indigo-200">Role</div>
                    </div>
                    <div class="rounded-xl bg-white/10 p-4 backdrop-blur-sm">
                        <div class="text-2xl font-bold">100</div>
                        <div class="text-indigo-200">Skala nilai</div>
                    </div>
                    <div class="rounded-xl bg-white/10 p-4 backdrop-blur-sm">
                        <div class="text-2xl font-bold">70</div>
                        <div class="text-indigo-200">KKM</div>
                    </div>
                </div>
            </div>

            {{-- Right Panel (Form) --}}
            <div class="p-7 sm:p-10">
                <div class="mb-8">
                    <div class="mb-3 inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                        <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                        Smart Edu System
                    </div>
                    <div class="text-2xl font-bold tracking-tight text-slate-800">Selamat datang</div>
                    <p class="mt-2 text-sm text-slate-400">Login untuk masuk ke dashboard sesuai role akun.</p>
                </div>

            @if ($errors->any())
                <div class="mb-5 flex items-center gap-2.5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <svg class="size-4 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-600">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="soft-input w-full px-4 py-3 text-sm">
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-600">Password</label>
                    <input id="password" name="password" type="password" required class="soft-input w-full px-4 py-3 text-sm">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-500">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    Ingat saya
                </label>
                <button class="btn-primary w-full justify-center py-3">
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                    Login
                </button>
            </form>
            </div>
        </div>
    </div>
@endsection
