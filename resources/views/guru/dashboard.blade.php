@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('subtitle', $guru ? 'Mata pelajaran: '.$guru->mata_pelajaran : 'Hubungkan akun ini dengan data guru terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ([['Total Nilai', $jumlahNilai, 'bg-indigo-50 text-indigo-700'], ['Pending', $jumlahPending, 'bg-amber-50 text-amber-700'], ['Valid', $jumlahValid, 'bg-emerald-50 text-emerald-700']] as [$label, $value, $tone])
            <div class="panel p-5">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-bold text-slate-500">{{ $label }}</div>
                    <div class="rounded-xl px-3 py-1 text-xs font-black {{ $tone }}">Rekap</div>
                </div>
                <div class="mt-5 text-4xl font-black tracking-tight text-slate-950">{{ $value }}</div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        <a href="{{ route('guru.nilais.create') }}" class="inline-flex rounded-xl bg-slate-950 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Input Nilai</a>
    </div>
@endsection
