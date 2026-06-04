@extends('layouts.app')

@section('title', 'Nilai Saya')
@section('subtitle', $siswa ? 'Daftar nilai pribadi '.$siswa->nama : 'Data siswa belum terhubung.')

@section('content')
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Mata Pelajaran</th>
                    <th class="px-4 py-3">Guru</th>
                    <th class="px-4 py-3">Tugas</th>
                    <th class="px-4 py-3">UTS</th>
                    <th class="px-4 py-3">UAS</th>
                    <th class="px-4 py-3">Akhir</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Validasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($nilais as $nilai)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $nilai->mapel?->nama_mapel ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $nilai->guru?->nama_guru }}</td>
                        <td class="px-4 py-3">{{ $nilai->nilai_tugas }}</td>
                        <td class="px-4 py-3">{{ $nilai->nilai_uts }}</td>
                        <td class="px-4 py-3">{{ $nilai->nilai_uas }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $nilai->nilai_akhir }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $nilai->status_kelulusan === 'Lulus' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $nilai->status_kelulusan }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $nilai->status_validasi }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-4 py-8 text-center text-slate-500">Belum ada nilai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if (method_exists($nilais, 'links'))
        <div class="mt-4">{{ $nilais->links() }}</div>
    @endif
@endsection
