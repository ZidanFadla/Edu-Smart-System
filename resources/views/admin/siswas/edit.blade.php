@extends('layouts.app')

@section('title', 'Edit Siswa')
@section('subtitle', 'Perbarui data siswa.')

@section('content')
    @include('admin.siswas.form', ['action' => route('admin.siswas.update', $siswa), 'method' => 'PUT'])
@endsection
