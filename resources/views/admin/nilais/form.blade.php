<form method="POST" action="{{ $action }}" class="panel max-w-3xl overflow-hidden">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
        <h3 class="font-semibold text-slate-800">Input Nilai</h3>
        <p class="text-sm text-slate-400">Nilai akhir dan status kelulusan dihitung otomatis.</p>
    </div>
    <div class="grid gap-5 p-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Siswa</label>
            <select name="siswa_id" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
                <option value="">Pilih siswa</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}" @selected(old('siswa_id', $nilai->siswa_id) == $siswa->id)>{{ $siswa->nama }} - {{ $siswa->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Guru</label>
            <select name="guru_id" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
                <option value="">Pilih guru</option>
                @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}" @selected(old('guru_id', $nilai->guru_id) == $guru->id)>{{ $guru->nama_guru }} - {{ $guru->mapel?->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Mata Pelajaran</label>
            <select name="mapel_id" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
                <option value="">Pilih mapel</option>
                @foreach ($mapels as $mapel)
                    <option value="{{ $mapel->id }}" @selected(old('mapel_id', $nilai->mapel_id) == $mapel->id)>{{ $mapel->kode_mapel }} - {{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Nilai Tugas</label>
            <input name="nilai_tugas" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Nilai UTS</label>
            <input name="nilai_uts" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_uts', $nilai->nilai_uts) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Nilai UAS</label>
            <input name="nilai_uas" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_uas', $nilai->nilai_uas) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
    </div>
    <div class="flex gap-3 border-t border-slate-100 bg-slate-50/50 px-6 py-4">
        <button class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Simpan
        </button>
        <a href="{{ auth()->user()->role === 'guru' ? route('guru.nilais.index') : route('admin.nilais.index') }}" class="btn-secondary">Batal</a>
    </div>
</form>
