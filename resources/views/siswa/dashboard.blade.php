@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('subtitle', $siswa ? $siswa->nama.' - '.$siswa->kelas : 'Hubungkan akun ini dengan data siswa terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        <div class="panel p-5">
            <div class="text-sm font-bold text-slate-500">Jumlah Nilai</div>
            <div class="mt-5 text-4xl font-black tracking-tight text-slate-950">{{ $nilais->count() }}</div>
        </div>
        <div class="panel p-5">
            <div class="text-sm font-bold text-slate-500">Rata-rata Nilai Akhir</div>
            <div class="mt-5 text-4xl font-black tracking-tight text-slate-950">{{ $rataRata ? number_format($rataRata, 2) : '-' }}</div>
        </div>
        <div class="rounded-3xl bg-slate-950 p-5 text-white shadow-xl shadow-slate-300">
            <div class="text-sm font-bold text-slate-300">Status Terbaru</div>
            <div class="mt-5 text-3xl font-black tracking-tight">{{ $nilais->first()?->status_kelulusan ?? '-' }}</div>
        </div>
    </div>
@endsection
