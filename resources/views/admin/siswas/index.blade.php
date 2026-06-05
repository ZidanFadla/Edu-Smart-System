@extends('layouts.app')

@section('title', 'Data Siswa')
@section('subtitle', 'Kelola identitas siswa dan akun pengguna terkait.')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.siswas.create') }}" class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Siswa
        </a>
    </div>
    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Akun</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td class="font-semibold text-slate-800">{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td><span class="badge badge-info">{{ $siswa->kelas }}</span></td>
                            <td class="text-slate-400">{{ $siswa->user?->email ?? '-' }}</td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.siswas.edit', $siswa) }}" class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.siswas.destroy', $siswa) }}" onsubmit="return confirm('Hapus data siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="!py-10 text-center text-slate-400">Belum ada data siswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $siswas->links() }}</div>
@endsection
