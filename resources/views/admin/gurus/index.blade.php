@extends('layouts.app')

@section('title', 'Data Guru')
@section('subtitle', 'Kelola data guru dan mata pelajaran.')

@section('content')
    <div class="mb-4 flex flex-wrap justify-end gap-2">
        <a href="{{ route('admin.gurus.pdf') }}" class="btn-danger">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5A3.375 3.375 0 0 0 10.125 2.25H8.25m5.25 12.75-3 3m0 0-3-3m3 3V10.5M6.75 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.625a9 9 0 0 0-9-9Z"/>
            </svg>
            Export PDF
        </a>
        <a href="{{ route('admin.gurus.create') }}" class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Guru
        </a>
    </div>
    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID Guru</th>
                        <th>Nama</th>
                        <th>Mata Pelajaran</th>
                        <th>Akun</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gurus as $guru)
                        <tr>
                            <td class="font-semibold text-slate-800">{{ $guru->id_guru }}</td>
                            <td>{{ $guru->nama_guru }}</td>
                            <td><span class="badge badge-info">{{ $guru->mapel?->nama_mapel ?? '-' }}</span></td>
                            <td class="text-slate-400">{{ $guru->user?->email ?? '-' }}</td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.gurus.edit', $guru) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.gurus.destroy', $guru) }}" onsubmit="return confirm('Hapus data guru ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="!py-10 text-center text-slate-400">Belum ada data guru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $gurus->links() }}</div>
@endsection
