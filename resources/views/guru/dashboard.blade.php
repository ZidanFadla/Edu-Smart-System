@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('subtitle', $guru ? 'Mata pelajaran: '.$guru->mapel?->nama_mapel : 'Hubungkan akun ini dengan data guru terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        @foreach ([
            ['Total Nilai', $jumlahNilai, 'bg-indigo-50 text-indigo-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>'],
            ['Pending', $jumlahPending, 'bg-amber-50 text-amber-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
            ['Valid', $jumlahValid, 'bg-emerald-50 text-emerald-600', '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
        ] as $i => [$label, $value, $iconBg, $iconPath])
            <div class="panel p-5 animate-fade-in-up delay-{{ $i + 1 }} hover:-translate-y-0.5">
                <div class="flex items-center justify-between">
                    <div class="rounded-xl p-2 {{ $iconBg }}">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $iconPath !!}</svg>
                    </div>
                    <span class="badge badge-info">Rekap</span>
                </div>
                <div class="mt-4 text-3xl font-bold tracking-tight text-slate-800">{{ $value }}</div>
                <div class="mt-1 text-sm font-medium text-slate-400">{{ $label }}</div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        <a href="{{ route('guru.nilais.create') }}" class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
            Input Nilai
        </a>
    </div>
@endsection
