<form method="POST" action="{{ $action }}" class="max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="grid gap-5">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Akun Siswa</label>
            <select name="user_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <option value="">Tidak dihubungkan</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $siswa->user_id) == $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
        </div>
        <div class="rounded-lg border border-indigo-100 bg-indigo-50 p-4">
            <div class="mb-3 text-sm font-semibold text-indigo-900">Buat atau perbarui akun login siswa</div>
            <div class="grid gap-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Email Login Siswa</label>
                    <input name="account_email" type="email" value="{{ old('account_email', $siswa->user?->email) }}" placeholder="contoh: nama.siswa@example.com" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Password Awal</label>
                    <input name="account_password" type="password" placeholder="{{ $method === 'POST' ? 'Minimal 8 karakter' : 'Kosongkan jika tidak diganti' }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
            </div>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">NIS</label>
            <input name="nis" value="{{ old('nis', $siswa->nis) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Siswa</label>
            <input name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Kelas</label>
            <input name="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
    </div>
    <div class="mt-6 flex gap-3">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Simpan</button>
        <a href="{{ route('admin.siswas.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
    </div>
</form>
