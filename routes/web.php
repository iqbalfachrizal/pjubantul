<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Halaman Depan (Beranda)
Route::get('/', [ReportController::class, 'index'])->name('home');

// Halaman Form Pengaduan
Route::get('/pengaduan', [ReportController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [ReportController::class, 'store'])->name('pengaduan.store');

// Halaman Daftar Pengaduan (List)
Route::get('/laporan', [ReportController::class, 'list'])->name('pengaduan.list');

// Halaman Detail Pengaduan
Route::get('/laporan/{id}', [ReportController::class, 'show'])->name('pengaduan.show');

// Route Map (Sesuai tombol 'Lihat Peta' di beranda)
Route::get('/map', function () {
    return view('map'); // Ini akan memanggil file resources/views/map.blade.php
});