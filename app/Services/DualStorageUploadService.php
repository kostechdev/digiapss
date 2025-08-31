<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DualStorageUploadService
{
    public static function store(UploadedFile $file, string $directory): string
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;
        
        Storage::disk('public')->putFileAs($directory, $file, $filename);
        Storage::disk('local')->putFileAs($directory, $file, $filename);
        
        return $path;
    }
    
    public static function update(?string $oldPath, UploadedFile $file, string $directory): string
    {
        if ($oldPath) {
            self::delete($oldPath);
        }
        
        return self::store($file, $directory);
    }
    
    public static function delete(?string $path): void
    {
        if (!$path) return;
        
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        
        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
        }
    }
}
