<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $siswaId = $this->route('siswa')?->id;
        $userId = $this->route('siswa')?->user_id;

        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'account_email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'account_password' => ['nullable', 'string', 'min:8'],
            'nis' => ['required', 'string', 'max:50', Rule::unique('siswas', 'nis')->ignore($siswaId)],
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
        ];
    }
}
