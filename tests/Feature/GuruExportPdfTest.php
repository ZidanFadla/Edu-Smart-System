<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuruExportPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_export_teacher_data_as_pdf(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $guruUser = User::factory()->create([
            'name' => 'Guru Matematika',
            'email' => 'guru.matematika@example.com',
            'role' => 'guru',
        ]);
        $mapel = Mapel::create([
            'kode_mapel' => 'MTK',
            'nama_mapel' => 'Matematika',
        ]);

        Guru::create([
            'user_id' => $guruUser->id,
            'mapel_id' => $mapel->id,
            'id_guru' => 'GR001',
            'nama_guru' => 'Guru Matematika',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.gurus.pdf'));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
        $response->assertDownload();
    }

    public function test_non_admin_cannot_export_teacher_data(): void
    {
        $guru = User::factory()->create(['role' => 'guru']);

        $this->actingAs($guru)
            ->get('/admin/gurus/pdf')
            ->assertForbidden();
    }
}
