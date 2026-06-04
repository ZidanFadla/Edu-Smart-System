@extends('layouts.app')

@section('title', 'Tambah Nilai')
@section('subtitle', 'Nilai akhir dan status kelulusan dihitung otomatis.')

@section('content')
    @include('admin.nilais.form', ['action' => auth()->user()->role === 'guru' ? route('guru.nilais.store') : route('admin.nilais.store'), 'method' => 'POST'])
@endsection
