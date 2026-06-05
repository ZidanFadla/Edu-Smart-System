@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan data utama Smart Edu System.')

@section('content')
    {{-- Stat Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            ['Siswa', $jumlahSiswa, 'from-indigo-500 to-indigo-600', 'bg-indigo-50 text-indigo-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>'],
            ['Guru', $jumlahGuru, 'from-cyan-500 to-teal-500', 'bg-cyan-50 text-cyan-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>'],
            ['Mapel', $jumlahMapel, 'from-violet-500 to-purple-500', 'bg-violet-50 text-violet-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>'],
            ['Data Nilai', $jumlahNilai, 'from-amber-500 to-orange-500', 'bg-amber-50 text-amber-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>'],
            ['Nilai Valid', $jumlahNilaiValid, 'from-emerald-500 to-green-500', 'bg-emerald-50 text-emerald-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
        ] as $i => [$label, $value, $gradient, $iconBg, $iconPath])
            <div class="panel p-5 animate-fade-in-up delay-{{ $i + 1 }} hover:-translate-y-0.5">
                <div class="flex items-center justify-between">
                    <div class="rounded-xl p-2 {{ $iconBg }}">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $iconPath !!}</svg>
                    </div>
                </div>
                <div class="mt-4 text-3xl font-bold tracking-tight text-slate-800">{{ $value }}</div>
                <div class="mt-1 text-sm font-medium text-slate-400">{{ $label }}</div>
                <div class="mt-3 h-1 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full w-2/3 rounded-full bg-gradient-to-r {{ $gradient }}"></div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Quick Actions + System Status --}}
    <div class="mt-6 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="panel p-6 animate-fade-in-up delay-3">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Aksi cepat</h2>
                    <p class="mt-1 text-sm text-slate-400">Mulai kelola data akademik dari menu utama.</p>
                </div>
            </div>
            <div class="mt-5 grid gap-3 sm:grid-cols-4">
                @foreach ([
                    ['Tambah Siswa', route('admin.siswas.create'), '<path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>'],
                    ['Tambah Mapel', route('admin.mapels.create'), '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>'],
                    ['Tambah Guru', route('admin.gurus.create'), '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>'],
                    ['Validasi Nilai', route('admin.nilais.index'), '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
                ] as [$actionLabel, $actionRoute, $actionIcon])
                    <a href="{{ $actionRoute }}" class="group flex flex-col items-center gap-2 rounded-xl border border-slate-100 bg-slate-50/50 p-4 text-center transition-all hover:-translate-y-0.5 hover:border-indigo-100 hover:bg-indigo-50/50 hover:shadow-sm">
                        <div class="rounded-lg bg-white p-2 shadow-sm transition-colors group-hover:bg-indigo-100">
                            <svg class="size-5 text-slate-400 transition-colors group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $actionIcon !!}</svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-indigo-700">{{ $actionLabel }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-6 text-white shadow-lg shadow-indigo-200/40 animate-fade-in-up delay-4">
            <div class="flex items-center gap-2 text-sm font-medium text-indigo-100">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                Status sistem
            </div>
            <div class="mt-3 text-2xl font-bold">Siap digunakan</div>
            <p class="mt-2 text-sm leading-relaxed text-indigo-100">Kelola data utama, tinjau nilai dari guru, lalu validasi sebelum laporan digunakan.</p>
        </div>
    </div>
@endsection
