<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
            'nis' => ['required', 'string', 'max:50', 'unique:siswas,nis'],
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
        ];
    }
}
