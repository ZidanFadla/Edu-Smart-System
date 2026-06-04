<form method="POST" action="{{ $action }}" class="panel max-w-2xl p-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="grid gap-5">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Kode Mapel</label>
            <input name="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Mapel</label>
            <input name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
    </div>
    <div class="mt-6 flex gap-3">
        <button class="rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Simpan</button>
        <a href="{{ route('admin.mapels.index') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50">Batal</a>
    </div>
</form>
