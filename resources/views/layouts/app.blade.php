<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Edu System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased">
    @auth
        <div class="min-h-screen lg:flex">
            <aside class="border-b border-slate-200 bg-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
                <div class="flex items-center justify-between px-6 py-5 lg:block">
                    <div>
                        <div class="text-lg font-bold text-slate-950">Smart Edu System</div>
                        <div class="mt-1 text-sm capitalize text-slate-500">{{ auth()->user()->role }} Panel</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                        @csrf
                        <button class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-semibold text-white">Logout</button>
                    </form>
                </div>
                <nav class="grid gap-1 px-4 pb-5 text-sm font-medium">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                        <a href="{{ route('admin.siswas.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('admin.siswas.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Data Siswa</a>
                        <a href="{{ route('admin.gurus.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('admin.gurus.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Data Guru</a>
                        <a href="{{ route('admin.nilais.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('admin.nilais.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Data Nilai</a>
                        <a href="{{ route('admin.laporan.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('admin.laporan.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Laporan</a>
                    @elseif (auth()->user()->role === 'guru')
                        <a href="{{ route('guru.dashboard') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('guru.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                        <a href="{{ route('guru.nilais.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('guru.nilais.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Rekap Nilai</a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('siswa.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                        <a href="{{ route('siswa.nilai.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('siswa.nilai.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Nilai Saya</a>
                    @endif
                </nav>
                <div class="hidden border-t border-slate-200 p-4 lg:block">
                    <div class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</div>
                    <div class="mb-3 text-xs text-slate-500">{{ auth()->user()->email }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full rounded-lg bg-slate-900 px-3 py-2 text-sm font-semibold text-white hover:bg-slate-700">Logout</button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 px-5 py-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-slate-950">@yield('title')</h1>
                        @hasSection('subtitle')
                            <p class="mt-1 text-sm text-slate-500">@yield('subtitle')</p>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    @else
        @yield('content')
    @endauth
</body>
</html>
