@extends('layouts.app')

@section('title', 'Edit Nilai')
@section('subtitle', 'Perbarui komponen nilai siswa.')

@section('content')
    @include('admin.nilais.form', ['action' => auth()->user()->role === 'guru' ? route('guru.nilais.update', $nilai) : route('admin.nilais.update', $nilai), 'method' => 'PUT'])
@endsection
