<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function show($id)
    {
        $galeri = Galeri::with('images')->findOrFail($id);
        
        return view('galeri.detail', compact('galeri'));
    }
}
