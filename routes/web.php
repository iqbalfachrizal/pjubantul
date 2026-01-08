<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});
Route::get('/map', function () {
    return view('map');
});

use App\Http\Controllers\PengaduanController;

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');

Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
