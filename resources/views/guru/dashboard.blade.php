@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('subtitle', $guru ? 'Mata pelajaran: '.$guru->mata_pelajaran : 'Hubungkan akun ini dengan data guru terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ([['Total Nilai', $jumlahNilai], ['Pending', $jumlahPending], ['Valid', $jumlahValid]] as [$label, $value])
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-sm font-medium text-slate-500">{{ $label }}</div>
                <div class="mt-3 text-3xl font-bold text-slate-950">{{ $value }}</div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        <a href="{{ route('guru.nilais.create') }}" class="inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Input Nilai</a>
    </div>
@endsection
