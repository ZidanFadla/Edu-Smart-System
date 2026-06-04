@extends('layouts.app')

@section('title', 'Tambah Mapel')
@section('subtitle', 'Tambahkan master mata pelajaran.')

@section('content')
    @include('admin.mapels.form', ['action' => route('admin.mapels.store'), 'method' => 'POST'])
@endsection
