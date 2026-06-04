@extends('layouts.app')

@section('title', 'Rekap Nilai')
@section('subtitle', 'Input, edit sebelum validasi, dan validasi nilai mata pelajaran Anda.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('guru.nilais.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Input Nilai</a>
    </div>
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'guru'])
@endsection
