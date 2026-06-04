<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'jumlahSiswa' => Siswa::count(),
            'jumlahGuru' => Guru::count(),
            'jumlahMapel' => Mapel::count(),
            'jumlahNilai' => Nilai::count(),
            'jumlahNilaiValid' => Nilai::where('status_validasi', 'valid')->count(),
        ]);
    }
}
