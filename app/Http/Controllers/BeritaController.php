<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->with('author')->firstOrFail();
        $beritaTerkait = Berita::where('id', '!=', $berita->id)
                              ->where('kategori', $berita->kategori)
                              ->latest()
                              ->take(3)
                              ->get();
        
        if ($beritaTerkait->count() < 3) {
            $beritaTambahan = Berita::where('id', '!=', $berita->id)
                                   ->whereNotIn('id', $beritaTerkait->pluck('id'))
                                   ->latest()
                                   ->take(3 - $beritaTerkait->count())
                                   ->get();
            $beritaTerkait = $beritaTerkait->merge($beritaTambahan);
        }
        
        return view('berita.detail', compact('berita', 'beritaTerkait'));
    }
}
