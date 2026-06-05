<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa;
use App\Services\UserAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function __construct(private readonly UserAccountService $userAccountService)
    {
    }

    public function index(): View
    {
        return view('admin.siswas.index', [
            'siswas' => Siswa::with('user')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.siswas.create', [
            'siswa' => new Siswa(),
        ]);
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();
            $data['user_id'] = $this->userAccountService->resolveUserId($data, 'siswa', $data['nama']);

            Siswa::create($this->siswaData($data));
        });

        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa): View
    {
        return view('admin.siswas.edit', [
            'siswa' => $siswa,
        ]);
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        DB::transaction(function () use ($request, $siswa): void {
            $data = $request->validated();
            $data['user_id'] = $this->userAccountService->resolveUserId($data, 'siswa', $data['nama'], $siswa->user);

            $siswa->update($this->siswaData($data));
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
     * @return array<string, mixed>
     */
    private function siswaData(array $data): array
    {
        return collect($data)->only(['user_id', 'nis', 'nama', 'kelas'])->all();
    }
}
