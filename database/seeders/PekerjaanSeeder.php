<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Pelajar',
            'Mahasiswa',
            'PNS',
            'Karyawan Swasta',
            'Wiraswasta',
            'Petani',
            'Buruh',
            'Guru',
            'Dokter',
            'Perawat',
            'Polisi',
            'TNI',
            'Pedagang',
            'Sopir',
            'Tukang',
            'Nelayan',
            'Peternak',
            'Ibu Rumah Tangga',
            'Pensiunan',
            'Freelancer',
            'Teknisi',
        ];

        foreach ($items as $nama) {
            Pekerjaan::firstOrCreate(['nama' => $nama]);
        }
    }
}
