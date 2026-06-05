<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'account_password' => ['required', 'string', 'min:8'],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'id_guru' => ['required', 'string', 'max:50', 'unique:gurus,id_guru'],
            'nama_guru' => ['required', 'string', 'max:255'],
        ];
    }
}
