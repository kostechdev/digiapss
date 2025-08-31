<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PendudukSeeder extends Seeder
{
    public function run(): void
    {
        $rwNomors = ['004', '001', '002', '003'];
        $rws = [];
        foreach ($rwNomors as $nomor) {
            $rws[] = Rw::firstOrCreate(
                ['nomor_rw' => $nomor],
                ['nama_ketua' => fake()->name()]
            );
        }
        $rtMap = [];
        $rtKetuaByNomorRw = [
            '004' => 'Masud',
            '001' => 'Kojal',
            '002' => 'jamak',
            '003' => 'Samsudin',
        ];
        foreach ($rws as $rw) {
            $rt = Rt::firstOrCreate(
                ['rw_id' => $rw->id, 'nomor_rt' => '001'],
                ['nama_ketua' => $rtKetuaByNomorRw[$rw->nomor_rw] ?? fake()->name()]
            );
            $rtMap[$rw->id] = $rt->id;
        }
        $rwIds = array_map(fn($rw) => $rw->id, $rws);

        $namaLakiLaki = [
            'Ahmad', 'Muhammad', 'Abdul', 'Budi', 'Slamet', 'Agus', 'Bambang', 'Dedi', 'Eko', 'Fajar',
            'Gunawan', 'Hadi', 'Indra', 'Joko', 'Kurniawan', 'Lukman', 'Made', 'Nur', 'Oki', 'Putra',
            'Rudi', 'Suryanto', 'Tono', 'Udin', 'Vino', 'Wahyu', 'Yanto', 'Zaki', 'Andi', 'Bayu',
            'Candra', 'Dwi', 'Edi', 'Firman', 'Gilang', 'Hendra', 'Imam', 'Jaka', 'Krisna', 'Luthfi'
        ];

        $namaPerempuan = [
            'Siti', 'Sri', 'Dewi', 'Ani', 'Rina', 'Maya', 'Lestari', 'Indah', 'Wati', 'Fitri',
            'Ratna', 'Sari', 'Yuni', 'Diah', 'Eka', 'Farah', 'Gita', 'Hani', 'Ika', 'Jihan',
            'Kartika', 'Linda', 'Mila', 'Nita', 'Ovi', 'Putri', 'Qori', 'Rini', 'Sinta', 'Tari',
            'Umi', 'Vera', 'Winda', 'Yesi', 'Zahra', 'Ayu', 'Bella', 'Citra', 'Diana', 'Elsa'
        ];

        $namaBelakang = [
            'Pratama', 'Utama', 'Santoso', 'Wijaya', 'Kusuma', 'Permana', 'Saputra', 'Saputri', 'Rahayu',
            'Sari', 'Wati', 'Dewi', 'Putra', 'Putri', 'Maharani', 'Purnama', 'Cahaya', 'Indah',
            'Lestari', 'Mulia', 'Agung', 'Besar', 'Jaya', 'Sukma', 'Bahagia', 'Sejahtera', 'Makmur',
            'Subur', 'Gemilang', 'Cemerlang', 'Bersih', 'Suci', 'Murni', 'Asri', 'Elok', 'Cantik',
            'Tampan', 'Gagah', 'Perkasa', 'Tangguh'
        ];

        $tempatLahir = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Palembang', 'Tangerang',
            'Depok', 'Bekasi', 'Bogor', 'Batam', 'Pekanbaru', 'Bandar Lampung', 'Malang', 'Padang',
            'Denpasar', 'Samarinda', 'Tasikmalaya', 'Pontianak', 'Cimahi', 'Balikpapan', 'Jambi',
            'Surakarta', 'Manado', 'Yogyakarta', 'Cilegon', 'Mataram', 'Kupang', 'Jayapura'
        ];

        $pekerjaanList = Pekerjaan::query()->pluck('id', 'nama')->toArray();
        $namaPekerjaanAll = array_keys($pekerjaanList);

        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $statusPerkawinan = ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'];

        $batchSize = 1000;
        $totalRecords = 120000;
        
        for ($batch = 0; $batch < $totalRecords / $batchSize; $batch++) {
            $data = [];
            
            for ($i = 0; $i < $batchSize; $i++) {
                $jenisKelamin = fake()->randomElement(['Laki-laki', 'Perempuan']);
                
                if ($jenisKelamin === 'Laki-laki') {
                    $namaDepan = fake()->randomElement($namaLakiLaki);
                } else {
                    $namaDepan = fake()->randomElement($namaPerempuan);
                }
                
                $namaBelakangPilihan = fake()->randomElement($namaBelakang);
                $namaLengkap = $namaDepan . ' ' . $namaBelakangPilihan;
                
                $umur = fake()->numberBetween(1, 80);
                $tanggalLahir = Carbon::now()->subYears($umur)->subDays(fake()->numberBetween(0, 365));
                
                $nik = '';
                for ($j = 0; $j < 16; $j++) {
                    $nik .= fake()->numberBetween(0, 9);
                }
                
                $rwPick = $rwIds[array_rand($rwIds)];
                $rtPick = $rtMap[$rwPick];

                $namaPekerjaan = null;
                if ($umur <= 18 && in_array('Pelajar', $namaPekerjaanAll)) {
                    $namaPekerjaan = 'Pelajar';
                } elseif ($umur >= 19 && $umur <= 24 && in_array('Mahasiswa', $namaPekerjaanAll)) {
                    $namaPekerjaan = 'Mahasiswa';
                } else {
                    $pilihan = array_values(array_diff($namaPekerjaanAll, ['Pelajar', 'Mahasiswa']));
                    if (empty($pilihan)) {
                        $pilihan = $namaPekerjaanAll;
                    }
                    $namaPekerjaan = $pilihan[array_rand($pilihan)];
                }

                $data[] = [
                    'nik' => $nik,
                    'nama' => $namaLengkap,
                    'tempat_lahir' => fake()->randomElement($tempatLahir),
                    'tanggal_lahir' => $tanggalLahir,
                    'jenis_kelamin' => $jenisKelamin,
                    'agama' => fake()->randomElement($agama),
                    'pekerjaan_id' => $pekerjaanList[$namaPekerjaan] ?? null,
                    'pekerjaan' => $namaPekerjaan,
                    'alamat' => fake()->address(),
                    'no_hp' => '08' . fake()->numerify('##########'),
                    'status_perkawinan' => fake()->randomElement($statusPerkawinan),
                    'rw_id' => $rwPick,
                    'rt_id' => $rtPick,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            Penduduk::insert($data);
            
            if ($batch % 100 === 0) {
                echo "Progress: " . (($batch + 1) * $batchSize) . " / $totalRecords records\n";
            }
        }
    }
}
