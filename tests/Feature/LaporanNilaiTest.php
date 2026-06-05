<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LaporanNilaiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_does_not_have_routes_to_create_edit_or_delete_nilai(): void
    {
        $this->assertFalse(Route::has('admin.nilais.create'));
        $this->assertFalse(Route::has('admin.nilais.store'));
        $this->assertFalse(Route::has('admin.nilais.edit'));
        $this->assertFalse(Route::has('admin.nilais.update'));
        $this->assertFalse(Route::has('admin.nilais.destroy'));
        $this->assertTrue(Route::has('admin.nilais.validasi'));
    }

    public function test_laporan_can_be_filtered_by_class(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $mapel = Mapel::create(['kode_mapel' => 'MTK', 'nama_mapel' => 'Matematika']);
        $guru = Guru::create([
            'mapel_id' => $mapel->id,
            'id_guru' => 'GR001',
            'nama_guru' => 'Guru Matematika',
        ]);

        $siswaRpl = Siswa::create(['nis' => '001', 'nama' => 'Siswa RPL', 'kelas' => 'XII RPL 1']);
        $siswaTkj = Siswa::create(['nis' => '002', 'nama' => 'Siswa TKJ', 'kelas' => 'XII TKJ 1']);

        $this->createNilai($siswaRpl, $guru, $mapel);
        $this->createNilai($siswaTkj, $guru, $mapel);

        $response = $this->actingAs($admin)->get(route('admin.laporan.index', [
            'kelas' => 'XII RPL 1',
        ]));

        $response->assertOk();
        $response->assertViewHas('nilais', function ($nilais): bool {
            return $nilais->count() === 1
                && $nilais->first()->siswa->kelas === 'XII RPL 1';
        });

        $pdfResponse = $this->actingAs($admin)->get(route('admin.laporan.pdf', [
            'kelas' => 'XII RPL 1',
        ]));

        $pdfResponse->assertOk();
        $pdfResponse->assertHeader('content-type', 'application/pdf');
    }

    public function test_class_filter_ignores_accidental_whitespace_in_stored_class(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $mapel = Mapel::create(['kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia']);
        $guru = Guru::create([
            'mapel_id' => $mapel->id,
            'id_guru' => 'GR002',
            'nama_guru' => 'Guru Bahasa',
        ]);
        $siswa = Siswa::create(['nis' => '003', 'nama' => 'Siswa Spasi', 'kelas' => 'XII RPL 2 ']);
        $this->createNilai($siswa, $guru, $mapel);

        $response = $this->actingAs($admin)->get(route('admin.laporan.index', [
            'kelas' => 'XII RPL 2',
        ]));

        $response->assertOk();
        $response->assertViewHas('nilais', fn ($nilais) => $nilais->count() === 1);
    }

    public function test_report_can_combine_student_class_and_subject_filters(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $matematika = Mapel::create(['kode_mapel' => 'MTK', 'nama_mapel' => 'Matematika']);
        $bahasa = Mapel::create(['kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia']);
        $guruMatematika = Guru::create([
            'mapel_id' => $matematika->id,
            'id_guru' => 'GR003',
            'nama_guru' => 'Guru Matematika',
        ]);
        $guruBahasa = Guru::create([
            'mapel_id' => $bahasa->id,
            'id_guru' => 'GR004',
            'nama_guru' => 'Guru Bahasa',
        ]);
        $siswa = Siswa::create(['nis' => '004', 'nama' => 'Siswa Kombinasi', 'kelas' => 'XI RPL 1']);
        $this->createNilai($siswa, $guruMatematika, $matematika);
        $this->createNilai($siswa, $guruBahasa, $bahasa);

        $response = $this->actingAs($admin)->get(route('admin.laporan.index', [
            'siswa_id' => $siswa->id,
            'kelas' => 'XI RPL 1',
            'mapel_id' => $matematika->id,
        ]));

        $response->assertOk();
        $response->assertViewHas('nilais', function ($nilais) use ($matematika): bool {
            return $nilais->count() === 1
                && $nilais->first()->mapel_id === $matematika->id;
        });
    }

    public function test_guru_report_only_contains_their_own_subject_scores(): void
    {
        $mapelA = Mapel::create(['kode_mapel' => 'PBO', 'nama_mapel' => 'PBO']);
        $mapelB = Mapel::create(['kode_mapel' => 'BD', 'nama_mapel' => 'Basis Data']);
        $guruUserA = User::factory()->create(['role' => 'guru']);
        $guruA = Guru::create([
            'user_id' => $guruUserA->id,
            'mapel_id' => $mapelA->id,
            'id_guru' => 'GR005',
            'nama_guru' => 'Guru PBO',
        ]);
        $guruB = Guru::create([
            'mapel_id' => $mapelB->id,
            'id_guru' => 'GR006',
            'nama_guru' => 'Guru Basis Data',
        ]);
        $siswa = Siswa::create(['nis' => '005', 'nama' => 'Siswa Guru', 'kelas' => 'XI RPL 2']);
        $this->createNilai($siswa, $guruA, $mapelA);
        $this->createNilai($siswa, $guruB, $mapelB);

        $response = $this->actingAs($guruUserA)->get(route('guru.laporan.index'));

        $response->assertOk();
        $response->assertViewHas('nilais', function ($nilais) use ($guruA): bool {
            return $nilais->count() === 1
                && $nilais->first()->guru_id === $guruA->id;
        });
    }

    private function createNilai(Siswa $siswa, Guru $guru, Mapel $mapel): void
    {
        Nilai::create([
            'siswa_id' => $siswa->id,
            'guru_id' => $guru->id,
            'mapel_id' => $mapel->id,
            'nilai_tugas' => 80,
            'nilai_uts' => 80,
            'nilai_uas' => 80,
            'nilai_akhir' => 80,
            'status_kelulusan' => 'Lulus',
            'status_validasi' => 'valid',
        ]);
    }
}
