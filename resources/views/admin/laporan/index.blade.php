@extends('layouts.app')

@section('title', 'Laporan Nilai')
@section('subtitle', 'Filter laporan berdasarkan nama siswa, kelas, atau mata pelajaran.')

@section('content')
    <form method="GET" class="panel mb-5 grid gap-3 p-4 md:grid-cols-4">
        <input name="nama" value="{{ $filters['nama'] ?? '' }}" placeholder="Nama siswa" class="soft-input px-3 py-2.5 text-sm">
        <input name="kelas" value="{{ $filters['kelas'] ?? '' }}" placeholder="Kelas" class="soft-input px-3 py-2.5 text-sm">
        <input name="mata_pelajaran" value="{{ $filters['mata_pelajaran'] ?? '' }}" placeholder="Mata pelajaran" class="soft-input px-3 py-2.5 text-sm">
        <button class="rounded-xl bg-slate-950 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Filter</button>
    </form>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
