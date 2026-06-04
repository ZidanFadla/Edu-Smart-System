@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('subtitle', $siswa ? $siswa->nama.' - '.$siswa->kelas : 'Hubungkan akun ini dengan data siswa terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="text-sm font-medium text-slate-500">Jumlah Nilai</div>
            <div class="mt-3 text-3xl font-bold text-slate-950">{{ $nilais->count() }}</div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="text-sm font-medium text-slate-500">Rata-rata Nilai Akhir</div>
            <div class="mt-3 text-3xl font-bold text-slate-950">{{ $rataRata ? number_format($rataRata, 2) : '-' }}</div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="text-sm font-medium text-slate-500">Status Terbaru</div>
            <div class="mt-3 text-2xl font-bold text-slate-950">{{ $nilais->first()?->status_kelulusan ?? '-' }}</div>
        </div>
    </div>
@endsection
