<?php

namespace App\Models;

use App\Services\DualStorageUploadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan');
    }

    public static function getAktifBanners()
    {
        return self::aktif()->urutan()->get();
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getGambarPrivateUrlAttribute()
    {
        return $this->gambar ? storage_path('app/' . $this->gambar) : null;
    }

    protected static function booted()
    {
        static::deleting(function ($banner) {
            if ($banner->gambar) {
                DualStorageUploadService::delete($banner->gambar);
            }
        });
    }
}
