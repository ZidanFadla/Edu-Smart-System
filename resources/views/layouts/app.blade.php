<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Edu System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-800 antialiased">
    @auth
        @php
            $navItem = 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition';
            $navActive = 'bg-slate-950 text-white shadow-sm shadow-slate-300';
            $navIdle = 'text-slate-600 hover:bg-slate-100 hover:text-slate-950';
        @endphp
        <div class="min-h-screen lg:flex">
            <aside class="border-b border-slate-200/80 bg-white/90 backdrop-blur lg:sticky lg:top-0 lg:min-h-screen lg:w-[19rem] lg:border-b-0 lg:border-r">
                <div class="flex items-center justify-between px-5 py-5 lg:block lg:px-6">
                    <div class="flex items-center gap-3">
                        <div class="grid size-11 place-items-center rounded-2xl bg-slate-950 text-base font-black text-white shadow-lg shadow-slate-300">SE</div>
                        <div>
                            <div class="text-lg font-black tracking-tight text-slate-950">Smart Edu</div>
                            <div class="text-xs font-semibold uppercase tracking-wide text-indigo-600">{{ auth()->user()->role }} Workspace</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                        @csrf
                        <button class="rounded-xl bg-slate-950 px-3 py-2 text-sm font-semibold text-white">Logout</button>
                    </form>
                </div>
                <nav class="grid gap-1.5 px-4 pb-5">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('admin.dashboard') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">D</span>Dashboard</a>
                        <a href="{{ route('admin.siswas.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.siswas.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">S</span>Data Siswa</a>
                        <a href="{{ route('admin.gurus.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.gurus.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">G</span>Data Guru</a>
                        <a href="{{ route('admin.nilais.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.nilais.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">N</span>Data Nilai</a>
                        <a href="{{ route('admin.laporan.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.laporan.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">L</span>Laporan</a>
                    @elseif (auth()->user()->role === 'guru')
                        <a href="{{ route('guru.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('guru.dashboard') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">D</span>Dashboard</a>
                        <a href="{{ route('guru.nilais.index') }}" class="{{ $navItem }} {{ request()->routeIs('guru.nilais.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">R</span>Rekap Nilai</a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('siswa.dashboard') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">D</span>Dashboard</a>
                        <a href="{{ route('siswa.nilai.index') }}" class="{{ $navItem }} {{ request()->routeIs('siswa.nilai.*') ? $navActive : $navIdle }}"><span class="grid size-8 place-items-center rounded-lg bg-white/10">N</span>Nilai Saya</a>
                    @endif
                </nav>
                <div class="mx-4 hidden rounded-2xl border border-slate-200 bg-slate-50 p-4 lg:block">
                    <div class="mb-3 flex items-center gap-3">
                        <div class="grid size-10 place-items-center rounded-xl bg-white text-sm font-bold text-slate-800 shadow-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="min-w-0">
                            <div class="truncate text-sm font-bold text-slate-900">{{ auth()->user()->name }}</div>
                            <div class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full rounded-xl bg-white px-3 py-2 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-slate-200 hover:bg-slate-950 hover:text-white">Logout</button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 px-5 py-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-7 flex flex-col justify-between gap-4 rounded-3xl border border-white/70 bg-white/70 px-5 py-5 shadow-sm backdrop-blur md:flex-row md:items-center">
                        <div>
                            <div class="mb-2 inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-indigo-700">{{ now()->format('d M Y') }}</div>
                            <h1 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">@yield('title')</h1>
                        @hasSection('subtitle')
                                <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-500">@yield('subtitle')</p>
                        @endif
                        </div>
                        <div class="hidden rounded-2xl bg-slate-950 px-4 py-3 text-right text-white shadow-lg shadow-slate-300 md:block">
                            <div class="text-xs font-medium text-slate-300">Masuk sebagai</div>
                            <div class="text-sm font-bold capitalize">{{ auth()->user()->role }}</div>
                        </div>
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
