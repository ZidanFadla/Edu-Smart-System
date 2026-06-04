@extends('layouts.app')

@section('title', 'Laporan Nilai')
@section('subtitle', 'Filter laporan berdasarkan nama siswa, kelas, atau mata pelajaran.')

@section('content')
    <form method="GET" class="mb-5 grid gap-3 rounded-xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-4">
        <input name="nama" value="{{ $filters['nama'] ?? '' }}" placeholder="Nama siswa" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <input name="kelas" value="{{ $filters['kelas'] ?? '' }}" placeholder="Kelas" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <input name="mata_pelajaran" value="{{ $filters['mata_pelajaran'] ?? '' }}" placeholder="Mata pelajaran" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Filter</button>
    </form>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
