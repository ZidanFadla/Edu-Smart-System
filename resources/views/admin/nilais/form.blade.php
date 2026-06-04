<form method="POST" action="{{ $action }}" class="panel max-w-3xl p-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Siswa</label>
            <select name="siswa_id" class="soft-input w-full px-3 py-2.5 text-sm" required>
                <option value="">Pilih siswa</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}" @selected(old('siswa_id', $nilai->siswa_id) == $siswa->id)>{{ $siswa->nama }} - {{ $siswa->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Guru</label>
            <select name="guru_id" class="soft-input w-full px-3 py-2.5 text-sm" required>
                <option value="">Pilih guru</option>
                @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}" @selected(old('guru_id', $nilai->guru_id) == $guru->id)>{{ $guru->nama_guru }} - {{ $guru->mata_pelajaran }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Mata Pelajaran</label>
            <input name="mata_pelajaran" value="{{ old('mata_pelajaran', $nilai->mata_pelajaran) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nilai Tugas</label>
            <input name="nilai_tugas" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nilai UTS</label>
            <input name="nilai_uts" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_uts', $nilai->nilai_uts) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nilai UAS</label>
            <input name="nilai_uas" type="number" min="0" max="100" step="0.01" value="{{ old('nilai_uas', $nilai->nilai_uas) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
    </div>
    <div class="mt-6 flex gap-3">
        <button class="rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Simpan</button>
        <a href="{{ auth()->user()->role === 'guru' ? route('guru.nilais.index') : route('admin.nilais.index') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50">Batal</a>
    </div>
</form>
