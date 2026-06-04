<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Services\NilaiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NilaiController extends Controller
{
    public function __construct(private readonly NilaiService $nilaiService)
    {
    }

    public function index(Request $request): View
    {
        $query = Nilai::with(['siswa', 'guru'])->latest();

        if ($request->user()->role === 'guru') {
            $guru = $request->user()->guru;
            $query->where('guru_id', $guru?->id ?? 0);
        }

        $view = $request->user()->role === 'guru' ? 'guru.nilais.index' : 'admin.nilais.index';

        return view($view, [
            'nilais' => $query->paginate(10),
        ]);
    }

    public function create(Request $request): View
    {
        $guru = $request->user()->role === 'guru' ? $request->user()->guru : null;

        return view('admin.nilais.create', [
            'nilai' => new Nilai(['guru_id' => $guru?->id, 'mata_pelajaran' => $guru?->mata_pelajaran]),
            'siswas' => Siswa::orderBy('nama')->get(),
            'gurus' => $guru ? collect([$guru]) : Guru::orderBy('nama_guru')->get(),
        ]);
    }

    public function store(StoreNilaiRequest $request): RedirectResponse
    {
        $data = $this->nilaiService->lengkapiDataNilai($request->validated());
        $data['status_validasi'] = 'pending';

        Nilai::create($data);

        return $this->redirectAfterAction($request, 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Request $request, Nilai $nilai): View
    {
        $this->authorizeGuruNilai($request, $nilai);

        abort_if($request->user()->role === 'guru' && $nilai->status_validasi === 'valid', 403, 'Nilai yang sudah valid tidak dapat diedit guru.');

        $guru = $request->user()->role === 'guru' ? $request->user()->guru : null;

        return view('admin.nilais.edit', [
            'nilai' => $nilai,
            'siswas' => Siswa::orderBy('nama')->get(),
            'gurus' => $guru ? collect([$guru]) : Guru::orderBy('nama_guru')->get(),
        ]);
    }

    public function update(UpdateNilaiRequest $request, Nilai $nilai): RedirectResponse
    {
        $this->authorizeGuruNilai($request, $nilai);

        abort_if($request->user()->role === 'guru' && $nilai->status_validasi === 'valid', 403, 'Nilai yang sudah valid tidak dapat diedit guru.');

        $data = $this->nilaiService->lengkapiDataNilai($request->validated());
        $data['status_validasi'] = $request->user()->role === 'guru' ? 'pending' : $nilai->status_validasi;

        $nilai->update($data);

        return $this->redirectAfterAction($request, 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('admin.nilais.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    public function validateNilai(Request $request, Nilai $nilai): RedirectResponse
    {
        $this->authorizeGuruNilai($request, $nilai);

        $nilai->update(['status_validasi' => 'valid']);

        return $this->redirectAfterAction($request, 'Nilai siswa berhasil divalidasi.');
    }

    private function authorizeGuruNilai(Request $request, Nilai $nilai): void
    {
        if ($request->user()->role !== 'guru') {
            return;
        }

        abort_if($nilai->guru_id !== $request->user()->guru?->id, 403, 'Anda hanya dapat mengelola nilai mata pelajaran sendiri.');
    }

    private function redirectAfterAction(Request $request, string $message): RedirectResponse
    {
        $route = $request->user()->role === 'guru' ? 'guru.nilais.index' : 'admin.nilais.index';

        return redirect()->route($route)->with('success', $message);
    }
}
