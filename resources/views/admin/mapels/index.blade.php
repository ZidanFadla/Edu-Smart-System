@extends('layouts.app')

@section('title', 'Data Mapel')
@section('subtitle', 'Kelola master mata pelajaran yang digunakan guru dan nilai.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.mapels.create') }}" class="rounded-xl bg-slate-950 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Tambah Mapel</a>
    </div>
    <div class="panel overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-950 text-left text-xs font-bold uppercase tracking-wide text-white">
                <tr>
                    <th class="px-5 py-4">Kode</th>
                    <th class="px-5 py-4">Nama Mapel</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($mapels as $mapel)
                    <tr class="transition hover:bg-slate-50">
                        <td class="px-5 py-4 font-black text-slate-950">{{ $mapel->kode_mapel }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $mapel->nama_mapel }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.mapels.edit', $mapel) }}" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-amber-600">Edit</a>
                                <form method="POST" action="{{ route('admin.mapels.destroy', $mapel) }}" onsubmit="return confirm('Hapus mapel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-rose-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-10 text-center text-slate-500">Belum ada data mapel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $mapels->links() }}</div>
@endsection
