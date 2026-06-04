@extends('layouts.app')

@section('title', 'Edit Guru')
@section('subtitle', 'Perbarui data guru.')

@section('content')
    @include('admin.gurus.form', ['action' => route('admin.gurus.update', $guru), 'method' => 'PUT'])
@endsection
