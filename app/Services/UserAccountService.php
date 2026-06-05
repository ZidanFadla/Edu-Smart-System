<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAccountService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function resolveUserId(array $data, string $role, string $name, ?User $currentUser = null): ?int
    {
        if (empty($data['account_email'])) {
            return $data['user_id'] ?? $currentUser?->id;
        }

        $user = $currentUser ?? new User(['role' => $role]);
        $user->name = $name;
        $user->email = $data['account_email'];
        $user->role = $role;

        if (! empty($data['account_password'])) {
            $user->password = Hash::make($data['account_password']);
        }

        $user->save();

        return $user->id;
    }
}
