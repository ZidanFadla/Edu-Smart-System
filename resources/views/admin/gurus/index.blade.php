@extends('layouts.app')

@section('title', 'Data Guru')
@section('subtitle', 'Kelola data guru dan mata pelajaran.')

@section('content')
    <div class="mb-4 flex justify-end">
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
