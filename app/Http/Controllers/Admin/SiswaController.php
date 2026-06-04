<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        return view('admin.siswas.index', [
            'siswas' => Siswa::with('user')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.siswas.create', [
            'users' => User::where('role', 'siswa')->orderBy('name')->get(),
            'siswa' => new Siswa(),
        ]);
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();
            $data['user_id'] = $this->resolveUserId($data, 'siswa', $data['nama']);

            Siswa::create($this->onlySiswaData($data));
        });

        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa): View
    {
        return view('admin.siswas.edit', [
            'siswa' => $siswa,
            'users' => User::where('role', 'siswa')->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        DB::transaction(function () use ($request, $siswa): void {
            $data = $request->validated();
            $data['user_id'] = $this->resolveUserId($data, 'siswa', $data['nama'], $siswa->user);

            $siswa->update($this->onlySiswaData($data));
        });

        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $siswa->delete();

        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolveUserId(array $data, string $role, string $name, ?User $currentUser = null): ?int
    {
        if (! empty($data['account_email'])) {
            $user = $currentUser ?? new User(['role' => $role]);
            $user->name = $name;
            $user->email = $data['account_email'];
            $user->role = $role;

            if (! empty($data['account_password'])) {
                $user->password = Hash::make($data['account_password']);
            }

            $user->save();

            return $user->id;
        }

        return $data['user_id'] ?? $currentUser?->id;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function onlySiswaData(array $data): array
    {
        return collect($data)->only(['user_id', 'nis', 'nama', 'kelas'])->all();
    }
}
