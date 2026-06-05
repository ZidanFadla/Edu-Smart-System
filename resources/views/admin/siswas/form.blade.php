<form method="POST" action="{{ $action }}" class="panel max-w-2xl overflow-hidden">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
        <h3 class="font-semibold text-slate-800">Informasi Siswa</h3>
        <p class="text-sm text-slate-400">Lengkapi data siswa di bawah ini.</p>
    </div>
    <div class="grid gap-5 p-6">
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Akun Siswa</label>
            <select name="user_id" class="soft-input w-full px-3.5 py-2.5 text-sm">
                <option value="">Tidak dihubungkan</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $siswa->user_id) == $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
        </div>
        <div class="rounded-xl border border-indigo-100 bg-indigo-50/50 p-4">
            <div class="mb-3 flex items-center gap-2 text-sm font-semibold text-indigo-700">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/></svg>
                Buat atau perbarui akun login siswa
            </div>
            <div class="grid gap-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-600">Email Login Siswa</label>
                    <input name="account_email" type="email" value="{{ old('account_email', $siswa->user?->email) }}" placeholder="contoh: nama.siswa@example.com" class="soft-input w-full px-3.5 py-2.5 text-sm">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-600">Password Awal</label>
                    <input name="account_password" type="password" placeholder="{{ $method === 'POST' ? 'Minimal 8 karakter' : 'Kosongkan jika tidak diganti' }}" class="soft-input w-full px-3.5 py-2.5 text-sm">
                </div>
            </div>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">NIS</label>
            <input name="nis" value="{{ old('nis', $siswa->nis) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Nama Siswa</label>
            <input name="nama" value="{{ old('nama', $siswa->nama) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-600">Kelas</label>
            <input name="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="soft-input w-full px-3.5 py-2.5 text-sm" required>
        </div>
    </div>
    <div class="flex gap-3 border-t border-slate-100 bg-slate-50/50 px-6 py-4">
        <button class="btn-primary">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Simpan
        </button>
        <a href="{{ route('admin.siswas.index') }}" class="btn-secondary">Batal</a>
    </div>
</form>
