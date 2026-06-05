@extends('layouts.app')

@section('title', 'Data Nilai')
@section('subtitle', 'Kelola nilai tugas, UTS, UAS, nilai akhir, dan validasi.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.nilais.create') }}" class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Nilai
        </a>
    </div>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
