<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function index(): View
    {
        return view('admin.gurus.index', [
            'gurus' => Guru::with('user')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.gurus.create', [
            'guru' => new Guru(),
            'users' => User::where('role', 'guru')->orderBy('name')->get(),
        ]);
    }

    public function store(StoreGuruRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();
            $data['user_id'] = $this->resolveUserId($data, 'guru', $data['nama_guru']);

            Guru::create($this->onlyGuruData($data));
        });

        return redirect()->route('admin.gurus.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('admin.gurus.edit', [
            'guru' => $guru,
            'users' => User::where('role', 'guru')->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateGuruRequest $request, Guru $guru): RedirectResponse
    {
        DB::transaction(function () use ($request, $guru): void {
            $data = $request->validated();
            $data['user_id'] = $this->resolveUserId($data, 'guru', $data['nama_guru'], $guru->user);

            $guru->update($this->onlyGuruData($data));
        });

        return redirect()->route('admin.gurus.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        $guru->delete();

        return redirect()->route('admin.gurus.index')->with('success', 'Data guru berhasil dihapus.');
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
    private function onlyGuruData(array $data): array
    {
        return collect($data)->only(['user_id', 'id_guru', 'nama_guru', 'mata_pelajaran'])->all();
    }
}
