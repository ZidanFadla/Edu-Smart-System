<?php

namespace App\Services;

class NilaiService
{
    public function hitungNilaiAkhir(float $nilaiTugas, float $nilaiUts, float $nilaiUas): float
    {
        return round(($nilaiTugas * 0.30) + ($nilaiUts * 0.30) + ($nilaiUas * 0.40), 2);
    }

    public function tentukanStatusKelulusan(float $nilaiAkhir): string
    {
        return $nilaiAkhir >= 70 ? 'Lulus' : 'Tidak Lulus';
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function lengkapiDataNilai(array $data): array
    {
        $nilaiAkhir = $this->hitungNilaiAkhir(
            (float) $data['nilai_tugas'],
            (float) $data['nilai_uts'],
            (float) $data['nilai_uas'],
        );

        $data['nilai_akhir'] = $nilaiAkhir;
        $data['status_kelulusan'] = $this->tentukanStatusKelulusan($nilaiAkhir);

        return $data;
    }
}
