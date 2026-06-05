<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\Mapel;
use App\Services\UserAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function __construct(private readonly UserAccountService $userAccountService)
    {
    }

    public function index(): View
    {
        return view('admin.gurus.index', [
            'gurus' => Guru::with(['user', 'mapel'])->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.gurus.create', [
            'guru' => new Guru(),
            'mapels' => Mapel::orderBy('nama_mapel')->get(),
        ]);
    }

    public function store(StoreGuruRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();
            $data['user_id'] = $this->userAccountService->resolveUserId($data, 'guru', $data['nama_guru']);

            Guru::create($this->guruData($data));
        });

        return redirect()->route('admin.gurus.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('admin.gurus.edit', [
            'guru' => $guru,
            'mapels' => Mapel::orderBy('nama_mapel')->get(),
        ]);
    }

    public function update(UpdateGuruRequest $request, Guru $guru): RedirectResponse
    {
        DB::transaction(function () use ($request, $guru): void {
            $data = $request->validated();
            $data['user_id'] = $this->userAccountService->resolveUserId($data, 'guru', $data['nama_guru'], $guru->user);

            $guru->update($this->guruData($data));
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
     * @return array<string, mixed>
     */
    private function guruData(array $data): array
    {
        return collect($data)->only(['user_id', 'mapel_id', 'id_guru', 'nama_guru'])->all();
    }
}
