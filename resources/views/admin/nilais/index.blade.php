@extends('layouts.app')

@section('title', 'Validasi Nilai')
@section('subtitle', 'Tinjau nilai yang diinput guru dan lakukan validasi.')

@section('content')
    @include('admin.nilais.table', ['nilais' => $nilais, 'mode' => 'admin'])
@endsection
