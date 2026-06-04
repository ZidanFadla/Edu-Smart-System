<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $nilais = Nilai::with(['siswa', 'guru'])
            ->when($request->filled('nama'), function ($query) use ($request) {
                $query->whereHas('siswa', fn ($siswa) => $siswa->where('nama', 'like', '%'.$request->nama.'%'));
            })
            ->when($request->filled('kelas'), function ($query) use ($request) {
                $query->whereHas('siswa', fn ($siswa) => $siswa->where('kelas', 'like', '%'.$request->kelas.'%'));
            })
            ->when($request->filled('mata_pelajaran'), function ($query) use ($request) {
                $query->where('mata_pelajaran', 'like', '%'.$request->mata_pelajaran.'%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporan.index', [
            'nilais' => $nilais,
            'filters' => $request->only(['nama', 'kelas', 'mata_pelajaran']),
        ]);
    }
}
