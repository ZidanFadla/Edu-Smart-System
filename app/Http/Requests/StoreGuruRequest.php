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
            'user_id' => ['nullable', 'exists:users,id'],
            'account_email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'account_password' => ['nullable', 'required_with:account_email', 'string', 'min:8'],
            'id_guru' => ['required', 'string', 'max:50', 'unique:gurus,id_guru'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'string', 'max:100'],
        ];
    }
}
