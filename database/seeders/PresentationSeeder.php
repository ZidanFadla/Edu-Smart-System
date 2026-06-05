<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use App\Services\NilaiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PresentationSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $mapels = $this->seedMapels();
            $gurus = $this->seedGurus($mapels);
            $siswas = $this->seedSiswas();
            $this->seedNilais($siswas, $gurus);
        });
    }

    /**
     * @return array<string, Mapel>
     */
    private function seedMapels(): array
    {
        $data = [
            'MTK' => 'Matematika',
            'BIN' => 'Bahasa Indonesia',
            'BIG' => 'Bahasa Inggris',
            'PBO' => 'Pemrograman Berorientasi Objek',
            'BD' => 'Basis Data',
        ];

        $mapels = [];

        foreach ($data as $kode => $nama) {
            $mapels[$kode] = Mapel::updateOrCreate(
                ['kode_mapel' => $kode],
                ['nama_mapel' => $nama],
            );
        }

        return $mapels;
    }

    /**
     * @param  array<string, Mapel>  $mapels
     * @return array<string, Guru>
     */
    private function seedGurus(array $mapels): array
    {
        $data = [
            ['id' => 'GR001', 'nama' => 'Budi Santoso', 'email' => 'budi.guru@example.com', 'mapel' => 'MTK'],
            ['id' => 'GR002', 'nama' => 'Siti Rahmawati', 'email' => 'siti.guru@example.com', 'mapel' => 'BIN'],
            ['id' => 'GR003', 'nama' => 'Rina Kurnia', 'email' => 'rina.guru@example.com', 'mapel' => 'BIG'],
            ['id' => 'GR004', 'nama' => 'Andi Pratama', 'email' => 'andi.guru@example.com', 'mapel' => 'PBO'],
            ['id' => 'GR005', 'nama' => 'Dewi Lestari', 'email' => 'dewi.guru@example.com', 'mapel' => 'BD'],
        ];

        $gurus = [];

        foreach ($data as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'guru',
                ],
            );

            $gurus[$item['mapel']] = Guru::updateOrCreate(
                ['id_guru' => $item['id']],
                [
                    'user_id' => $user->id,
                    'mapel_id' => $mapels[$item['mapel']]->id,
                    'nama_guru' => $item['nama'],
                ],
            );
        }

        return $gurus;
    }

    /**
     * @return array<int, Siswa>
     */
    private function seedSiswas(): array
    {
        $data = [
            ['nis' => '24001', 'nama' => 'Ahmad Fauzan', 'kelas' => 'XII RPL 1'],
            ['nis' => '24002', 'nama' => 'Alya Maharani', 'kelas' => 'XII RPL 1'],
            ['nis' => '24003', 'nama' => 'Dimas Saputra', 'kelas' => 'XII RPL 1'],
            ['nis' => '24004', 'nama' => 'Nabila Putri', 'kelas' => 'XII RPL 1'],
            ['nis' => '24005', 'nama' => 'Rizky Ramadhan', 'kelas' => 'XII RPL 2'],
            ['nis' => '24006', 'nama' => 'Salsa Aulia', 'kelas' => 'XII RPL 2'],
            ['nis' => '24007', 'nama' => 'Fajar Nugraha', 'kelas' => 'XII RPL 2'],
            ['nis' => '24008', 'nama' => 'Intan Permata', 'kelas' => 'XII RPL 2'],
            ['nis' => '24009', 'nama' => 'Galang Maulana', 'kelas' => 'XI RPL 1'],
            ['nis' => '24010', 'nama' => 'Citra Amelia', 'kelas' => 'XI RPL 1'],
            ['nis' => '24011', 'nama' => 'Bagas Setiawan', 'kelas' => 'XI RPL 1'],
            ['nis' => '24012', 'nama' => 'Zahra Anindya', 'kelas' => 'XI RPL 1'],
        ];

        $siswas = [];

        foreach ($data as $item) {
            $emailName = strtolower(str_replace(' ', '.', $item['nama']));
            $user = User::updateOrCreate(
                ['email' => $emailName.'@example.com'],
                [
                    'name' => $item['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ],
            );

            $siswas[] = Siswa::updateOrCreate(
                ['nis' => $item['nis']],
                [
                    'user_id' => $user->id,
                    'nama' => $item['nama'],
                    'kelas' => $item['kelas'],
                ],
            );
        }

        return $siswas;
    }

    /**
     * @param  array<int, Siswa>  $siswas
     * @param  array<string, Guru>  $gurus
     */
    private function seedNilais(array $siswas, array $gurus): void
    {
        $nilaiService = app(NilaiService::class);
        $mapelCodes = array_keys($gurus);

        foreach ($siswas as $siswaIndex => $siswa) {
            foreach ($mapelCodes as $mapelIndex => $kodeMapel) {
                $guru = $gurus[$kodeMapel];
                $base = 62 + (($siswaIndex * 7 + $mapelIndex * 5) % 34);
                $data = $nilaiService->lengkapiDataNilai([
                    'nilai_tugas' => min(100, $base + 4),
                    'nilai_uts' => min(100, $base + (($mapelIndex % 3) - 1) * 3),
                    'nilai_uas' => min(100, $base + (($siswaIndex % 4) - 1) * 2),
                ]);

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'guru_id' => $guru->id,
                        'mapel_id' => $guru->mapel_id,
                    ],
                    [
                        ...$data,
                        'status_validasi' => ($siswaIndex + $mapelIndex) % 4 === 0 ? 'pending' : 'valid',
                    ],
                );
            }
        }
    }
}
