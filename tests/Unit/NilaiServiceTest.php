<?php

namespace Tests\Unit;

use App\Services\NilaiService;
use PHPUnit\Framework\TestCase;

class NilaiServiceTest extends TestCase
{
    private NilaiService $nilaiService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nilaiService = new NilaiService();
    }

    /**
     * Test the final score formula calculation:
     * Nilai Akhir = (30% * Tugas) + (30% * UTS) + (40% * UAS)
     */
    public function test_hitung_nilai_akhir_is_accurate(): void
    {
        // Case 1: Tugas=90, UTS=88, UAS=87 -> (90*0.3) + (88*0.3) + (87*0.4) = 27 + 26.4 + 34.8 = 88.20
        $score1 = $this->nilaiService->hitungNilaiAkhir(90, 88, 87);
        $this->assertEquals(88.20, $score1);

        // Case 2: Tugas=45, UTS=66, UAS=78 -> (45*0.3) + (66*0.3) + (78*0.4) = 13.5 + 19.8 + 31.2 = 64.50
        $score2 = $this->nilaiService->hitungNilaiAkhir(45, 66, 78);
        $this->assertEquals(64.50, $score2);

        // Case 3: Tugas=70, UTS=70, UAS=70 -> 70.00
        $score3 = $this->nilaiService->hitungNilaiAkhir(70, 70, 70);
        $this->assertEquals(70.00, $score3);
    }

    /**
     * Test status determination based on KKM (70.00)
     */
    public function test_tentukan_status_kelulusan(): void
    {
        // Nilai Akhir >= 70 -> Lulus
        $this->assertEquals('Lulus', $this->nilaiService->tentukanStatusKelulusan(88.20));
        $this->assertEquals('Lulus', $this->nilaiService->tentukanStatusKelulusan(70.00));

        // Nilai Akhir < 70 -> Tidak Lulus
        $this->assertEquals('Tidak Lulus', $this->nilaiService->tentukanStatusKelulusan(69.90));
        $this->assertEquals('Tidak Lulus', $this->nilaiService->tentukanStatusKelulusan(64.50));
    }

    /**
     * Test mapping calculation to full data array
     */
    public function test_lengkapi_data_nilai(): void
    {
        $inputData = [
            'nilai_tugas' => 90,
            'nilai_uts' => 88,
            'nilai_uas' => 87,
        ];

        $outputData = $this->nilaiService->lengkapiDataNilai($inputData);

        $this->assertArrayHasKey('nilai_akhir', $outputData);
        $this->assertArrayHasKey('status_kelulusan', $outputData);
        $this->assertEquals(88.20, $outputData['nilai_akhir']);
        $this->assertEquals('Lulus', $outputData['status_kelulusan']);
    }
}
