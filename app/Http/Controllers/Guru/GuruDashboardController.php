<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuruDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $guru = $request->user()->guru;
        $query = Nilai::query();

        if ($guru) {
            $query->where('guru_id', $guru->id);
        } else {
            $query->whereRaw('1 = 0');
        }

        return view('guru.dashboard', [
            'guru' => $guru?->load('mapel'),
            'jumlahNilai' => (clone $query)->count(),
            'jumlahPending' => (clone $query)->where('status_validasi', 'pending')->count(),
            'jumlahValid' => (clone $query)->where('status_validasi', 'valid')->count(),
        ]);
    }
}
