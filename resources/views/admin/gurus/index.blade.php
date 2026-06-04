@extends('layouts.app')

@section('title', 'Data Guru')
@section('subtitle', 'Kelola data guru dan mata pelajaran.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.gurus.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Tambah Guru</a>
    </div>
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">ID Guru</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Mata Pelajaran</th>
                    <th class="px-4 py-3">Akun</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($gurus as $guru)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $guru->id_guru }}</td>
                        <td class="px-4 py-3">{{ $guru->nama_guru }}</td>
                        <td class="px-4 py-3">{{ $guru->mapel?->nama_mapel ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $guru->user?->email ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.gurus.edit', $guru) }}" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-amber-600">Edit</a>
                                <form method="POST" action="{{ route('admin.gurus.destroy', $guru) }}" onsubmit="return confirm('Hapus data guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-rose-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data guru.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $gurus->links() }}</div>
@endsection
