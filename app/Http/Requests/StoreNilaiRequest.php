<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siswa_id' => ['required', 'exists:siswas,id'],
            'guru_id' => ['required', 'exists:gurus,id'],
            'nilai_tugas' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
