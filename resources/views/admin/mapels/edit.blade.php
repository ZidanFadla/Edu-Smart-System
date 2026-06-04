@extends('layouts.app')

@section('title', 'Edit Mapel')
@section('subtitle', 'Perbarui data mata pelajaran.')

@section('content')
    @include('admin.mapels.form', ['action' => route('admin.mapels.update', $mapel), 'method' => 'PUT'])
@endsection
