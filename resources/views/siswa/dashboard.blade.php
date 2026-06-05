@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('subtitle', $siswa ? $siswa->nama.' - '.$siswa->kelas : 'Hubungkan akun ini dengan data siswa terlebih dahulu.')

@section('content')
    <div class="grid gap-4 md:grid-cols-3">
        <div class="panel p-5 animate-fade-in-up delay-1 hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-indigo-50 p-2 text-indigo-600">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                </div>
            </div>
            <div class="mt-4 text-3xl font-bold tracking-tight text-slate-800">{{ $nilais->count() }}</div>
            <div class="mt-1 text-sm font-medium text-slate-400">Jumlah Nilai</div>
        </div>
        <div class="panel p-5 animate-fade-in-up delay-2 hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-violet-50 p-2 text-violet-600">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                </div>
            </div>
            <div class="mt-4 text-3xl font-bold tracking-tight text-slate-800">{{ $rataRata ? number_format($rataRata, 2) : '-' }}</div>
            <div class="mt-1 text-sm font-medium text-slate-400">Rata-rata Nilai Akhir</div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-5 text-white shadow-lg shadow-indigo-200/40 animate-fade-in-up delay-3">
            <div class="flex items-center gap-2 text-sm font-medium text-indigo-100">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                Status Terbaru
            </div>
            <div class="mt-4 text-3xl font-bold tracking-tight">{{ $nilais->first()?->status_kelulusan ?? '-' }}</div>
        </div>
    </div>
@endsection
