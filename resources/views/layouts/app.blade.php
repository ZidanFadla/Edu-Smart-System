<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Edu System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 antialiased">
    @auth
        @php
            $navItem = 'group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-all duration-200';
            $navActive = 'bg-gradient-to-r from-indigo-50 to-violet-50 text-indigo-700 shadow-sm shadow-indigo-100/50';
            $navIdle = 'text-slate-500 hover:bg-slate-50 hover:text-slate-800';
        @endphp
        <div class="min-h-screen lg:flex">
            {{-- ─── Sidebar ─── --}}
            <aside class="border-b border-slate-200/60 bg-white lg:sticky lg:top-0 lg:min-h-screen lg:w-[17.5rem] lg:border-b-0 lg:border-r lg:border-slate-200/60">
                {{-- Gradient accent strip --}}
                <div class="hidden h-1 rounded-b-full bg-gradient-to-r from-indigo-500 via-violet-500 to-purple-500 lg:block"></div>

                <div class="flex items-center justify-between px-5 py-5 lg:block lg:px-5 lg:pt-6">
                    <div class="flex items-center gap-3">
                        <div class="grid size-10 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-200">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>
                        </div>
                        <div>
                            <div class="text-base font-bold tracking-tight text-slate-800">Smart Edu</div>
                            <div class="text-xs font-medium capitalize text-indigo-500">{{ auth()->user()->role }} Panel</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                        @csrf
                        <button class="btn-primary text-xs">Logout</button>
                    </form>
                </div>

                {{-- Navigation --}}
                <nav class="grid gap-1 px-3.5 pb-4">
                    <div class="mb-2 px-3.5 text-[0.65rem] font-semibold uppercase tracking-widest text-slate-400">Menu</div>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('admin.dashboard') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                            </span>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.siswas.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.siswas.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.siswas.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                            </span>
                            Data Siswa
                        </a>
                        <a href="{{ route('admin.mapels.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.mapels.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.mapels.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                            </span>
                            Data Mapel
                        </a>
                        <a href="{{ route('admin.gurus.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.gurus.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.gurus.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>
                            </span>
                            Data Guru
                        </a>
                        <a href="{{ route('admin.nilais.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.nilais.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.nilais.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                            </span>
                            Data Nilai
                        </a>
                        <a href="{{ route('admin.laporan.index') }}" class="{{ $navItem }} {{ request()->routeIs('admin.laporan.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('admin.laporan.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                            </span>
                            Laporan
                        </a>
                    @elseif (auth()->user()->role === 'guru')
                        <a href="{{ route('guru.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('guru.dashboard') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('guru.dashboard') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                            </span>
                            Dashboard
                        </a>
                        <a href="{{ route('guru.nilais.index') }}" class="{{ $navItem }} {{ request()->routeIs('guru.nilais.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('guru.nilais.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                            </span>
                            Rekap Nilai
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="{{ $navItem }} {{ request()->routeIs('siswa.dashboard') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('siswa.dashboard') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                            </span>
                            Dashboard
                        </a>
                        <a href="{{ route('siswa.nilai.index') }}" class="{{ $navItem }} {{ request()->routeIs('siswa.nilai.*') ? $navActive : $navIdle }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ request()->routeIs('siswa.nilai.*') ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 group-hover:text-slate-600' }} transition-colors">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                            </span>
                            Nilai Saya
                        </a>
                    @endif
                </nav>

                {{-- User Card --}}
                <div class="mx-3.5 mb-4 hidden rounded-2xl border border-slate-100 bg-gradient-to-br from-slate-50 to-white p-4 lg:block">
                    <div class="mb-3 flex items-center gap-3">
                        <div class="grid size-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-400 to-violet-500 text-xs font-bold text-white shadow-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                            <div class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-600 transition-all hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            {{-- ─── Main Content ─── --}}
            <main class="flex-1 px-5 py-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    {{-- Page Header --}}
                    <div class="mb-6 flex flex-col justify-between gap-4 animate-fade-in md:flex-row md:items-center">
                        <div>
                            <div class="mb-2 inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-600">
                                <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                {{ now()->format('d M Y') }}
                            </div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-800 md:text-3xl">@yield('title')</h1>
                        @hasSection('subtitle')
                                <p class="mt-1 max-w-2xl text-sm leading-relaxed text-slate-400">@yield('subtitle')</p>
                        @endif
                        </div>
                        <div class="hidden items-center gap-3 md:flex">
                            <div class="rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-4 py-2.5 text-right text-white shadow-md shadow-indigo-200/50">
                                <div class="text-[0.65rem] font-medium text-indigo-100">Masuk sebagai</div>
                                <div class="text-sm font-bold capitalize">{{ auth()->user()->role }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Alerts --}}
                    @if (session('success'))
                        <div class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 animate-fade-in-up">
                            <svg class="size-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-5 flex items-center gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 animate-fade-in-up">
                            <svg class="size-5 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="animate-fade-in-up">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    @else
        @yield('content')
    @endauth
</body>
</html>
