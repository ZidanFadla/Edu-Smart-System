<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $guruId = $this->route('guru')?->id;
        $userId = $this->route('guru')?->user_id;

        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'account_email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'account_password' => ['nullable', 'string', 'min:8'],
            'id_guru' => ['required', 'string', 'max:50', Rule::unique('gurus', 'id_guru')->ignore($guruId)],
            'nama_guru' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'string', 'max:100'],
        ];
    }
}
