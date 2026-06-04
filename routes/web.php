<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru' => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403),
    };
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::resource('siswas', SiswaController::class)->except(['show']);
        Route::resource('gurus', GuruController::class)->except(['show']);
        Route::patch('nilais/{nilai}/validasi', [NilaiController::class, 'validateNilai'])->name('nilais.validasi');
        Route::resource('nilais', NilaiController::class)->except(['show']);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', GuruDashboardController::class)->name('dashboard');
        Route::get('nilais', [NilaiController::class, 'index'])->name('nilais.index');
        Route::get('nilais/create', [NilaiController::class, 'create'])->name('nilais.create');
        Route::post('nilais', [NilaiController::class, 'store'])->name('nilais.store');
        Route::get('nilais/{nilai}/edit', [NilaiController::class, 'edit'])->name('nilais.edit');
        Route::put('nilais/{nilai}', [NilaiController::class, 'update'])->name('nilais.update');
        Route::patch('nilais/{nilai}/validasi', [NilaiController::class, 'validateNilai'])->name('nilais.validasi');
    });

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', SiswaDashboardController::class)->name('dashboard');
        Route::get('/nilai', [SiswaDashboardController::class, 'nilai'])->name('nilai.index');
    });
