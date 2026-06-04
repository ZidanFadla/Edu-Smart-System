<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
            <tr>
                <th class="px-4 py-3">Siswa</th>
                <th class="px-4 py-3">Guru</th>
                <th class="px-4 py-3">Mapel</th>
                <th class="px-4 py-3">Tugas</th>
                <th class="px-4 py-3">UTS</th>
                <th class="px-4 py-3">UAS</th>
                <th class="px-4 py-3">Akhir</th>
                <th class="px-4 py-3">Kelulusan</th>
                <th class="px-4 py-3">Validasi</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($nilais as $nilai)
                <tr>
                    <td class="px-4 py-3 font-medium text-slate-900">{{ $nilai->siswa?->nama }}</td>
                    <td class="px-4 py-3">{{ $nilai->guru?->nama_guru }}</td>
                    <td class="px-4 py-3">{{ $nilai->mata_pelajaran }}</td>
                    <td class="px-4 py-3">{{ $nilai->nilai_tugas }}</td>
                    <td class="px-4 py-3">{{ $nilai->nilai_uts }}</td>
                    <td class="px-4 py-3">{{ $nilai->nilai_uas }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $nilai->nilai_akhir }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $nilai->status_kelulusan === 'Lulus' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $nilai->status_kelulusan }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $nilai->status_validasi === 'valid' ? 'bg-indigo-50 text-indigo-700' : 'bg-amber-50 text-amber-700' }}">{{ $nilai->status_validasi }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            @php
                                $prefix = $mode === 'guru' ? 'guru' : 'admin';
                                $canEdit = $mode === 'admin' || $nilai->status_validasi !== 'valid';
                            @endphp
                            @if ($canEdit)
                                <a href="{{ route($prefix.'.nilais.edit', $nilai) }}" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-amber-600">Edit</a>
                            @endif
                            @if ($nilai->status_validasi !== 'valid')
                                <form method="POST" action="{{ route($prefix.'.nilais.validasi', $nilai) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700">Validasi</button>
                                </form>
                            @endif
                            @if ($mode === 'admin')
                                <form method="POST" action="{{ route('admin.nilais.destroy', $nilai) }}" onsubmit="return confirm('Hapus data nilai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-rose-700">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10" class="px-4 py-8 text-center text-slate-500">Belum ada data nilai.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $nilais->links() }}</div>
