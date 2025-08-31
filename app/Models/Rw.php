<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rw extends Model
{
    protected $fillable = [
        'nomor_rw',
        'nama_ketua',
    ];

    public function rts(): HasMany
    {
        return $this->hasMany(Rt::class);
    }

    public function penduduks(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }

    public function getJumlahRtAttribute(): int
    {
        return $this->rts()->count();
    }

    public function getJumlahPendudukAttribute(): int
    {
        return $this->penduduks()->count();
    }
}
