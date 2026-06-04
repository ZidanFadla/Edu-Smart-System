<div class="panel overflow-hidden">
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-950 text-left text-xs font-bold uppercase tracking-wide text-white">
            <tr>
                <th class="px-5 py-4">Siswa</th>
                <th class="px-5 py-4">Guru</th>
                <th class="px-5 py-4">Mapel</th>
                <th class="px-5 py-4">Tugas</th>
                <th class="px-5 py-4">UTS</th>
                <th class="px-5 py-4">UAS</th>
                <th class="px-5 py-4">Akhir</th>
                <th class="px-5 py-4">Kelulusan</th>
                <th class="px-5 py-4">Validasi</th>
                <th class="px-5 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse ($nilais as $nilai)
                <tr class="transition hover:bg-slate-50">
                    <td class="px-5 py-4 font-bold text-slate-900">{{ $nilai->siswa?->nama }}</td>
                    <td class="px-5 py-4 text-slate-600">{{ $nilai->guru?->nama_guru }}</td>
                    <td class="px-5 py-4 text-slate-600">{{ $nilai->mapel?->nama_mapel ?? '-' }}</td>
                    <td class="px-5 py-4">{{ $nilai->nilai_tugas }}</td>
                    <td class="px-5 py-4">{{ $nilai->nilai_uts }}</td>
                    <td class="px-5 py-4">{{ $nilai->nilai_uas }}</td>
                    <td class="px-5 py-4 font-black text-slate-950">{{ $nilai->nilai_akhir }}</td>
                    <td class="px-5 py-4">
                        <span class="rounded-full px-3 py-1.5 text-xs font-black {{ $nilai->status_kelulusan === 'Lulus' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100' : 'bg-rose-50 text-rose-700 ring-1 ring-rose-100' }}">{{ $nilai->status_kelulusan }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full px-3 py-1.5 text-xs font-black {{ $nilai->status_validasi === 'valid' ? 'bg-indigo-50 text-indigo-700 ring-1 ring-indigo-100' : 'bg-amber-50 text-amber-700 ring-1 ring-amber-100' }}">{{ $nilai->status_validasi }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-2">
                            @php
                                $prefix = $mode === 'guru' ? 'guru' : 'admin';
                                $canEdit = $mode === 'admin' || $nilai->status_validasi !== 'valid';
                            @endphp
                            @if ($canEdit)
                                <a href="{{ route($prefix.'.nilais.edit', $nilai) }}" class="rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-amber-600">Edit</a>
                            @endif
                            @if ($nilai->status_validasi !== 'valid')
                                <form method="POST" action="{{ route($prefix.'.nilais.validasi', $nilai) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-emerald-700">Validasi</button>
                                </form>
                            @endif
                            @if ($mode === 'admin')
                                <form method="POST" action="{{ route('admin.nilais.destroy', $nilai) }}" onsubmit="return confirm('Hapus data nilai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-rose-700">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10" class="px-5 py-10 text-center text-slate-500">Belum ada data nilai.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="mt-4">{{ $nilais->links() }}</div>
