<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()?->role, ['admin', 'guru'], true);
    }

    public function rules(): array
    {
        return [
            'siswa_id' => ['nullable', 'integer', 'exists:siswas,id'],
            'kelas' => ['nullable', 'string', 'max:50'],
            'mapel_id' => ['nullable', 'integer', 'exists:mapels,id'],
        ];
    }

    /**
     * @return array{siswa_id: int|null, kelas: string|null, mapel_id: int|null}
     */
    public function filters(): array
    {
        return [
            'siswa_id' => $this->filled('siswa_id') ? $this->integer('siswa_id') : null,
            'kelas' => $this->filled('kelas') ? trim((string) $this->input('kelas')) : null,
            'mapel_id' => $this->filled('mapel_id') ? $this->integer('mapel_id') : null,
        ];
    }
}
