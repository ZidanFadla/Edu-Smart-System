<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Mapel;
use App\Services\GuruIdService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuruIdServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_the_next_sequential_guru_id(): void
    {
        $mapel = Mapel::create([
            'kode_mapel' => 'MTK',
            'nama_mapel' => 'Matematika',
        ]);

        Guru::create([
            'mapel_id' => $mapel->id,
            'id_guru' => 'GR001',
            'nama_guru' => 'Guru Pertama',
        ]);

        Guru::create([
            'mapel_id' => $mapel->id,
            'id_guru' => 'GR009',
            'nama_guru' => 'Guru Kesembilan',
        ]);

        Guru::create([
            'mapel_id' => $mapel->id,
            'id_guru' => 'LEGACY',
            'nama_guru' => 'Guru Lama',
        ]);

        $nextId = app(GuruIdService::class)->generateNextId();

        $this->assertSame('GR010', $nextId);
    }
}
