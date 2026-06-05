<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanFilterRequest;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(LaporanFilterRequest $request): View
    {
        $filters = $request->filters();
        $nilais = $this->filteredQuery($filters, $request->user())
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporan.index', array_merge(
            $this->filterOptions($filters, $request->user()),
            [
                'nilais' => $nilais,
                'filters' => $filters,
                'routePrefix' => $request->user()->role,
            ],
        ));
    }

    public function exportPdf(LaporanFilterRequest $request): Response
    {
        $filters = $request->filters();
        $nilais = $this->filteredQuery($filters, $request->user())->get();
        $raports = $this->buildRaports($nilais);

        return Pdf::loadView('laporan.pdf', [
            'raports' => $raports,
            'filters' => $filters,
            'mapel' => $filters['mapel_id'] ? Mapel::find($filters['mapel_id']) : null,
            'tahunPelajaran' => now()->month >= 7
                ? now()->year.'/'.(now()->year + 1)
                : (now()->year - 1).'/'.now()->year,
            'semester' => now()->month >= 7 ? 'Ganjil' : 'Genap',
        ])->setPaper('a4', 'portrait')->download($this->pdfFilename($filters));
    }

    /**
     * @param  array{siswa_id: int|null, kelas: string|null, mapel_id: int|null}  $filters
     */
    private function filteredQuery(array $filters, User $user): Builder
    {
        return Nilai::query()
            ->with(['siswa', 'guru', 'mapel'])
            ->when($user->role === 'guru', function (Builder $query) use ($user): void {
                $query->where('guru_id', $user->guru?->id ?? 0);
            })
            ->when($filters['siswa_id'], function (Builder $query, int $siswaId): void {
                $query->where('siswa_id', $siswaId);
            })
            ->when($filters['kelas'], function (Builder $query, string $kelas): void {
                $query->whereHas(
                    'siswa',
                    fn (Builder $siswa) => $siswa->whereRaw('TRIM(kelas) = ?', [$kelas]),
                );
            })
            ->when($filters['mapel_id'], function (Builder $query, int $mapelId): void {
                $query->where('mapel_id', $mapelId);
            })
            ->orderBy('siswa_id')
            ->orderBy('mapel_id');
    }

    /**
     * @param  array{siswa_id: int|null, kelas: string|null, mapel_id: int|null}  $filters
     * @return array<string, mixed>
     */
    private function filterOptions(array $filters, User $user): array
    {
        $guruMapelId = $user->role === 'guru'
            ? $user->guru?->mapel_id
            : null;

        return [
            'siswas' => Siswa::query()
                ->when($filters['kelas'], fn (Builder $query, string $kelas) => $query->whereRaw('TRIM(kelas) = ?', [$kelas]))
                ->orderBy('nama')
                ->get(),
            'kelasOptions' => Siswa::query()
                ->selectRaw('TRIM(kelas) as kelas')
                ->distinct()
                ->orderBy('kelas')
                ->pluck('kelas'),
            'mapels' => Mapel::query()
                ->when($guruMapelId, fn (Builder $query) => $query->whereKey($guruMapelId))
                ->orderBy('nama_mapel')
                ->get(),
        ];
    }

    /**
     * @param  Collection<int, Nilai>  $nilais
     * @return Collection<int, array<string, mixed>>
     */
    private function buildRaports(Collection $nilais): Collection
    {
        return $nilais
            ->groupBy('siswa_id')
            ->map(function (Collection $studentNilais): array {
                $rataRata = round((float) $studentNilais->avg('nilai_akhir'), 2);

                return [
                    'siswa' => $studentNilais->first()->siswa,
                    'nilais' => $studentNilais,
                    'rata_rata' => $rataRata,
                    'predikat' => $this->predikat($rataRata),
                    'status' => $studentNilais->every(fn (Nilai $nilai) => $nilai->status_kelulusan === 'Lulus')
                        ? 'Lulus'
                        : 'Perlu Perbaikan',
                ];
            })
            ->values();
    }

    private function predikat(float $nilai): string
    {
        return match (true) {
            $nilai >= 90 => 'A',
            $nilai >= 80 => 'B',
            $nilai >= 70 => 'C',
            default => 'D',
        };
    }

    /**
     * @param  array{siswa_id: int|null, kelas: string|null, mapel_id: int|null}  $filters
     */
    private function pdfFilename(array $filters): string
    {
        $scope = $filters['siswa_id']
            ? 'siswa-'.$filters['siswa_id']
            : ($filters['kelas'] ? 'kelas-'.str_replace(' ', '-', strtolower($filters['kelas'])) : 'semua-siswa');

        return 'raport-'.$scope.'-'.now()->format('Ymd-His').'.pdf';
    }
}
