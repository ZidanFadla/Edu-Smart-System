<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $siswa = $request->user()->siswa;
        $nilais = $siswa?->nilais()->with('guru')->latest()->get() ?? collect();

        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'nilais' => $nilais,
            'rataRata' => $nilais->avg('nilai_akhir'),
        ]);
    }

    public function nilai(Request $request): View
    {
        $siswa = $request->user()->siswa;
        $nilais = $siswa?->nilais()->with('guru')->latest()->paginate(10) ?? collect();

        return view('siswa.nilai', [
            'siswa' => $siswa,
            'nilais' => $nilais,
        ]);
    }
}
