<?php

namespace App\Models;

use App\Enums\Agama;
use App\Enums\JenisKelamin;
use App\Enums\StatusPerkawinan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan_id',
        'pekerjaan',
        'alamat',
        'no_hp',
        'status_perkawinan',
        'rt_id',
        'rw_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'nik' => 'string',
            // 'jenis_kelamin' => JenisKelamin::class,
            // 'agama' => Agama::class,
            // 'status_perkawinan' => StatusPerkawinan::class,
        ];
    }

    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class);
    }

    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class);
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
