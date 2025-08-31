<?php

namespace App\Models;

use App\Services\DualStorageUploadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'kategori',
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis');
    }

    protected static function booted()
    {
        static::deleting(function ($berita) {
            if ($berita->gambar) {
                DualStorageUploadService::delete($berita->gambar);
            }
        });
    }
}
