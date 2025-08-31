<?php

namespace App\Models;

use App\Services\DualStorageUploadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriImage extends Model
{
    use HasFactory;

    protected $table = 'galeri_images';

    protected $fillable = [
        'galeri_id',
        'path',
        'position',
    ];

    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class);
    }

    protected static function booted()
    {
        static::deleting(function ($galeriImage) {
            if ($galeriImage->path) {
                DualStorageUploadService::delete($galeriImage->path);
            }
        });
    }
}
