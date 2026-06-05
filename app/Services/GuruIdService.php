<?php

namespace App\Services;

use App\Models\Guru;

class GuruIdService
{
    public function generateNextId(): string
    {
        $lastNumber = Guru::query()
            ->lockForUpdate()
            ->pluck('id_guru')
            ->map(function (string $idGuru): int {
                return preg_match('/^GR(\d+)$/i', $idGuru, $matches)
                    ? (int) $matches[1]
                    : 0;
            })
            ->max() ?? 0;

        return 'GR'.str_pad((string) ($lastNumber + 1), 3, '0', STR_PAD_LEFT);
    }
}
