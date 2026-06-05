@extends('layouts.app')

@section('title', 'Data Mapel')
@section('subtitle', 'Kelola master mata pelajaran yang digunakan guru dan nilai.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.mapels.create') }}" class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Mapel
        </a>
    </div>
    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mapel</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapels as $mapel)
                        <tr>
                            <td class="font-bold text-slate-800">{{ $mapel->kode_mapel }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.mapels.edit', $mapel) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.mapels.destroy', $mapel) }}" onsubmit="return confirm('Hapus mapel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="!py-10 text-center text-slate-400">Belum ada data mapel.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $mapels->links() }}</div>
@endsection
