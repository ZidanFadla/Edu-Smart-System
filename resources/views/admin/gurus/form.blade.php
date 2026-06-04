<form method="POST" action="{{ $action }}" class="panel max-w-2xl p-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="grid gap-5">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Akun Guru</label>
            <select name="user_id" class="soft-input w-full px-3 py-2.5 text-sm">
                <option value="">Tidak dihubungkan</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $guru->user_id) == $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
        </div>
        <div class="rounded-2xl border border-indigo-100 bg-indigo-50/80 p-4">
            <div class="mb-3 text-sm font-semibold text-indigo-900">Buat atau perbarui akun login guru</div>
            <div class="grid gap-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Email Login Guru</label>
                    <input name="account_email" type="email" value="{{ old('account_email', $guru->user?->email) }}" placeholder="contoh: nama.guru@example.com" class="soft-input w-full px-3 py-2.5 text-sm">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Password Awal</label>
                    <input name="account_password" type="password" placeholder="{{ $method === 'POST' ? 'Minimal 8 karakter' : 'Kosongkan jika tidak diganti' }}" class="soft-input w-full px-3 py-2.5 text-sm">
                </div>
            </div>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">ID Guru</label>
            <input name="id_guru" value="{{ old('id_guru', $guru->id_guru) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Guru</label>
            <input name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" class="soft-input w-full px-3 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Mata Pelajaran</label>
            <select name="mapel_id" class="soft-input w-full px-3 py-2.5 text-sm" required>
                <option value="">Pilih mapel</option>
                @foreach ($mapels as $mapel)
                    <option value="{{ $mapel->id }}" @selected(old('mapel_id', $guru->mapel_id) == $mapel->id)>{{ $mapel->kode_mapel }} - {{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-6 flex gap-3">
        <button class="rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-slate-300 hover:bg-indigo-700">Simpan</button>
        <a href="{{ route('admin.gurus.index') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50">Batal</a>
    </div>
</form>
