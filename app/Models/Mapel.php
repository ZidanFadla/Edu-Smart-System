<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
    ];

    public function gurus(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }
}
