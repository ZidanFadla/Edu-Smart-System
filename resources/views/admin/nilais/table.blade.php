<div class="panel overflow-hidden">
    <div class="overflow-x-auto">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Guru</th>
                <th>Mapel</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Akhir</th>
                <th>Kelulusan</th>
                <th>Validasi</th>
                @if ($mode !== 'laporan')
                    <th class="text-right">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($nilais as $nilai)
                <tr>
                    <td class="font-semibold text-slate-800">{{ $nilai->siswa?->nama }}</td>
                    <td>{{ $nilai->siswa?->kelas }}</td>
                    <td>{{ $nilai->guru?->nama_guru }}</td>
                    <td>{{ $nilai->mapel?->nama_mapel ?? '-' }}</td>
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
                    @if ($mode !== 'laporan')
                    <td>
                        <div class="flex justify-end gap-2">
                            @php
                                $prefix = $mode === 'guru' ? 'guru' : 'admin';
                                $canEdit = $mode === 'guru' && $nilai->status_validasi !== 'valid';
                            @endphp
                            @if ($canEdit)
                                <a href="{{ route($prefix.'.nilais.edit', $nilai) }}" class="btn-edit">Edit</a>
                            @endif
                            @if ($nilai->status_validasi !== 'valid')
                                <form method="POST" action="{{ route($prefix.'.nilais.validasi', $nilai) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn-success">Validasi</button>
                                </form>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="{{ $mode === 'laporan' ? 10 : 11 }}" class="!py-10 text-center text-slate-400">Belum ada data nilai.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="mt-4">{{ $nilais->links() }}</div>
