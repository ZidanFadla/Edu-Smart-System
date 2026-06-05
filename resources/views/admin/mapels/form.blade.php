<form method="POST" action="{{ $action }}" class="panel max-w-2xl overflow-hidden">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
        <h3 class="font-semibold text-slate-800">Informasi Mata Pelajaran</h3>
        <p class="text-sm text-slate-400">Lengkapi data mata pelajaran di bawah ini.</p>
    </div>
    <div class="grid gap-5 p-6">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Kode Mapel</label>
            <input name="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Nama Mapel</label>
            <input name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
    </div>
    <div class="flex gap-3 border-t border-slate-100 bg-slate-50/50 px-6 py-4">
        <button class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Simpan
        </button>
        <a href="{{ route('admin.mapels.index') }}" class="btn-secondary">Batal</a>
    </div>
</form>
