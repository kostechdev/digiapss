<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PendudukExportController;

Route::get('/', [LandingController::class, 'index']);
Route::get('/galeri/{id}', [App\Http\Controllers\GaleriController::class, 'show'])->name('galeri.show');
Route::get('/berita/{slug}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

Route::get('/exports/penduduks', PendudukExportController::class)->name('penduduks.export');
