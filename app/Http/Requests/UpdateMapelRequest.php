<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMapelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mapelId = $this->route('mapel')?->id;

        return [
            'kode_mapel' => ['required', 'string', 'max:50', Rule::unique('mapels', 'kode_mapel')->ignore($mapelId)],
            'nama_mapel' => ['required', 'string', 'max:255'],
        ];
    }
}
