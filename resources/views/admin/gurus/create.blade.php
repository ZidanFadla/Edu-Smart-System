@extends('layouts.app')

@section('title', 'Tambah Guru')
@section('subtitle', 'Isi data guru baru.')

@section('content')
    @include('admin.gurus.form', ['action' => route('admin.gurus.store'), 'method' => 'POST'])
@endsection
