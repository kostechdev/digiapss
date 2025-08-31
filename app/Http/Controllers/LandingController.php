<?php

namespace App\Http\Controllers;

use App\Models\BannerSetting;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $banners = BannerSetting::aktif()->urutan()->take(3)->get();
        $totalPenduduk = Penduduk::count();
        
        $usia0_17 = Penduduk::whereRaw('DATE("now") - DATE(tanggal_lahir) < 18')->count();
        $usia18_30 = Penduduk::whereRaw('DATE("now") - DATE(tanggal_lahir) BETWEEN 18 AND 30')->count();
        $usia31_50 = Penduduk::whereRaw('DATE("now") - DATE(tanggal_lahir) BETWEEN 31 AND 50')->count();
        $usia51_65 = Penduduk::whereRaw('DATE("now") - DATE(tanggal_lahir) BETWEEN 51 AND 65')->count();
        $usia65Plus = Penduduk::whereRaw('DATE("now") - DATE(tanggal_lahir) > 65')->count();
        
        $distribusiUsia = [
            'anak' => $usia0_17,
            'dewasa_muda' => $usia18_30,
            'dewasa' => $usia31_50,
            'lansia_awal' => $usia51_65,
            'lansia' => $usia65Plus
        ];
        $beritaTerbaru = Berita::latest()->take(6)->get();
        $galeriTerbaru = Galeri::with('images')->latest()->take(6)->get();

        return view('landing', compact(
            'banners',
            'totalPenduduk',
            'distribusiUsia',
            'beritaTerbaru',
            'galeriTerbaru'
        ));
    }
}
