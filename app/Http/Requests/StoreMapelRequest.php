<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_mapel' => ['required', 'string', 'max:50', 'unique:mapels,kode_mapel'],
            'nama_mapel' => ['required', 'string', 'max:255'],
        ];
    }
}
