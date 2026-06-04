@extends('layouts.app')

@section('title', 'Data Nilai')
@section('subtitle', 'Kelola nilai tugas, UTS, UAS, nilai akhir, dan validasi.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.nilais.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Tambah Nilai</a>
    </div>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
