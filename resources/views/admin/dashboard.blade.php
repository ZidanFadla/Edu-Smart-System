@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan data utama Smart Edu System.')

@section('content')
    <div class="grid gap-4 md:grid-cols-4">
        @foreach ([['Siswa', $jumlahSiswa], ['Guru', $jumlahGuru], ['Data Nilai', $jumlahNilai], ['Nilai Valid', $jumlahNilaiValid]] as [$label, $value])
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-sm font-medium text-slate-500">{{ $label }}</div>
                <div class="mt-3 text-3xl font-bold text-slate-950">{{ $value }}</div>
            </div>
        @endforeach
    </div>
@endsection
