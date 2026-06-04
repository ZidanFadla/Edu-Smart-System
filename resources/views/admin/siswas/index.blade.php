@extends('layouts.app')

@section('title', 'Data Siswa')
@section('subtitle', 'Kelola identitas siswa dan akun pengguna terkait.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.siswas.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Tambah Siswa</a>
    </div>
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">NIS</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kelas</th>
                    <th class="px-4 py-3">Akun</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($siswas as $siswa)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $siswa->nis }}</td>
                        <td class="px-4 py-3">{{ $siswa->nama }}</td>
                        <td class="px-4 py-3">{{ $siswa->kelas }}</td>
                        <td class="px-4 py-3">{{ $siswa->user?->email ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.siswas.edit', $siswa) }}" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-amber-600">Edit</a>
                                <form method="POST" action="{{ route('admin.siswas.destroy', $siswa) }}" onsubmit="return confirm('Hapus data siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-rose-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data siswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $siswas->links() }}</div>
@endsection
