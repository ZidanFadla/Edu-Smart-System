@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan data utama Smart Edu System.')

@section('content')
    <div class="grid gap-4 md:grid-cols-4">
        @foreach ([['Siswa', $jumlahSiswa, 'bg-indigo-50 text-indigo-700'], ['Guru', $jumlahGuru, 'bg-cyan-50 text-cyan-700'], ['Mapel', $jumlahMapel, 'bg-sky-50 text-sky-700'], ['Data Nilai', $jumlahNilai, 'bg-amber-50 text-amber-700'], ['Nilai Valid', $jumlahNilaiValid, 'bg-emerald-50 text-emerald-700']] as [$label, $value, $tone])
            <div class="panel p-5 transition hover:-translate-y-0.5 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-bold text-slate-500">{{ $label }}</div>
                    <div class="rounded-xl px-3 py-1 text-xs font-black {{ $tone }}">Aktif</div>
                </div>
                <div class="mt-5 text-4xl font-black tracking-tight text-slate-950">{{ $value }}</div>
                <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full w-2/3 rounded-full bg-slate-950"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="panel p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-black text-slate-950">Aksi cepat</h2>
                    <p class="mt-1 text-sm text-slate-500">Mulai kelola data akademik dari menu utama.</p>
                </div>
            </div>
            <div class="mt-5 grid gap-3 sm:grid-cols-4">
                <a href="{{ route('admin.siswas.create') }}" class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 hover:bg-white hover:shadow-sm">Tambah Siswa</a>
                <a href="{{ route('admin.mapels.create') }}" class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 hover:bg-white hover:shadow-sm">Tambah Mapel</a>
                <a href="{{ route('admin.gurus.create') }}" class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 hover:bg-white hover:shadow-sm">Tambah Guru</a>
                <a href="{{ route('admin.nilais.create') }}" class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold text-slate-800 hover:bg-white hover:shadow-sm">Input Nilai</a>
            </div>
        </div>
        <div class="rounded-3xl bg-slate-950 p-6 text-white shadow-xl shadow-slate-300">
            <div class="text-sm font-bold text-slate-300">Status sistem</div>
            <div class="mt-3 text-2xl font-black">Siap digunakan</div>
            <p class="mt-2 text-sm leading-6 text-slate-300">Data kosong tetap aman. Tambahkan siswa, guru, lalu input nilai sesuai mata pelajaran.</p>
        </div>
    </div>
@endsection
