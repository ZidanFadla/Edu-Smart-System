@extends('layouts.app')

@section('title', 'Tambah Siswa')
@section('subtitle', 'Isi data siswa baru.')

@section('content')
    @include('admin.siswas.form', ['action' => route('admin.siswas.store'), 'method' => 'POST'])
@endsection
