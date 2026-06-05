@extends('layouts.app')

@section('title', 'Laporan Nilai')
@section('subtitle', 'Pilih siswa, kelas, atau mata pelajaran lalu cetak dalam format raport.')

@section('content')
    <div class="panel mb-5 p-5">
        <form method="GET" action="{{ route($routePrefix.'.laporan.index') }}" class="grid gap-3 md:grid-cols-4">
            <select id="siswa-filter" name="siswa_id" class="soft-input px-3.5 py-2.5 text-sm">
                <option value="">Semua siswa</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}" data-kelas="{{ trim($siswa->kelas) }}" @selected(($filters['siswa_id'] ?? '') == $siswa->id)>{{ $siswa->nama }} - {{ trim($siswa->kelas) }}</option>
                @endforeach
            </select>
            <select id="kelas-filter" name="kelas" class="soft-input px-3.5 py-2.5 text-sm">
                <option value="">Semua kelas</option>
                @foreach ($kelasOptions as $kelas)
                    <option value="{{ $kelas }}" @selected(($filters['kelas'] ?? '') === $kelas)>{{ $kelas }}</option>
                @endforeach
            </select>
            <select name="mapel_id" class="soft-input px-3.5 py-2.5 text-sm">
                <option value="">Semua mata pelajaran</option>
                @foreach ($mapels as $mapel)
                    <option value="{{ $mapel->id }}" @selected(($filters['mapel_id'] ?? '') == $mapel->id)>{{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
            <button class="btn-primary justify-center">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                Filter
            </button>
        </form>
        <div class="mt-3 flex flex-wrap justify-end gap-2">
            <a href="{{ route($routePrefix.'.laporan.index') }}" class="btn-secondary">Reset</a>
            <a href="{{ route($routePrefix.'.laporan.pdf', array_filter($filters)) }}" class="btn-danger">
                Cetak Raport PDF
            </a>
        </div>
    </div>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'laporan'])

    <script>
        const kelasFilter = document.getElementById('kelas-filter');
        const siswaFilter = document.getElementById('siswa-filter');

        kelasFilter?.addEventListener('change', () => {
            const selectedStudent = siswaFilter?.selectedOptions[0];

            if (selectedStudent?.dataset.kelas && selectedStudent.dataset.kelas !== kelasFilter.value) {
                siswaFilter.value = '';
            }
        });
    </script>
@endsection
