@extends('layouts.app')

@section('title', 'Laporan Nilai')
@section('subtitle', 'Filter laporan berdasarkan nama siswa, kelas, atau mata pelajaran.')

@section('content')
    <div class="panel mb-5 p-5">
        <form method="GET" class="grid gap-3 md:grid-cols-4">
            <input name="nama" value="{{ $filters['nama'] ?? '' }}" placeholder="Nama siswa" class="soft-input px-3.5 py-2.5 text-sm">
            <input name="kelas" value="{{ $filters['kelas'] ?? '' }}" placeholder="Kelas" class="soft-input px-3.5 py-2.5 text-sm">
            <input name="mata_pelajaran" value="{{ $filters['mata_pelajaran'] ?? '' }}" placeholder="Mata pelajaran" class="soft-input px-3.5 py-2.5 text-sm">
            <button class="btn-primary justify-center">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                Filter
            </button>
        </form>
    </div>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
