<?php

namespace Database\Seeders;

use App\Models\BannerSetting;
use Illuminate\Database\Seeder;

class BannerSettingSeeder extends Seeder
{
    public function run(): void
    {
        BannerSetting::create([
            'gambar' => 'banner-images/banner1.jpg',
            'aktif' => true,
            'urutan' => 1,
        ]);

        BannerSetting::create([
            'gambar' => 'banner-images/banner2.jpg',
            'aktif' => true,
            'urutan' => 2,
        ]);

        BannerSetting::create([
            'gambar' => 'banner-images/banner3.jpg',
            'aktif' => true,
            'urutan' => 3,
        ]);
    }
}
