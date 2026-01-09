<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'lokasi' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        // Logika simpan data dan upload file akan di proses di sini
        
        return back()->with('success', 'Aduan berhasil dikirim dan sedang dalam proses verifikasi.');
    }
}