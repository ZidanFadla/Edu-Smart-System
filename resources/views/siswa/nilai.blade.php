@extends('layouts.app')

@section('title', 'Nilai Saya')
@section('subtitle', $siswa ? 'Daftar nilai pribadi '.$siswa->nama : 'Data siswa belum terhubung.')

@section('content')
    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Akhir</th>
                        <th>Status</th>
                        <th>Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nilais as $nilai)
                        <tr>
                            <td class="font-semibold text-slate-800">{{ $nilai->mapel?->nama_mapel ?? '-' }}</td>
                            <td>{{ $nilai->guru?->nama_guru }}</td>
                            <td>{{ $nilai->nilai_tugas }}</td>
                            <td>{{ $nilai->nilai_uts }}</td>
                            <td>{{ $nilai->nilai_uas }}</td>
                            <td class="font-bold text-slate-800">{{ $nilai->nilai_akhir }}</td>
                            <td>
                                <span class="badge {{ $nilai->status_kelulusan === 'Lulus' ? 'badge-success' : 'badge-danger' }}">{{ $nilai->status_kelulusan }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $nilai->status_validasi === 'valid' ? 'badge-info' : 'badge-warning' }}">{{ $nilai->status_validasi }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="!py-10 text-center text-slate-400">Belum ada nilai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if (method_exists($nilais, 'links'))
        <div class="mt-4">{{ $nilais->links() }}</div>
    @endif
@endsection
