<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan Halaman Beranda (Landing Page).
     * File view: resources/views/beranda.blade.php
     */
    public function index()
    {
        return view('beranda');
    }

    /**
     * Menampilkan Form Pengaduan.
     * File view: resources/views/pengaduan.blade.php
     */
    public function create()
    {
        return view('pengaduan');
    }

    /**
     * Menyimpan data pengaduan ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul' => 'required|max:255',
            'isi_laporan' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
        ]);

        // 2. Proses Upload Gambar
        // Gambar akan disimpan di folder: storage/app/public/reports
        $path = $request->file('foto')->store('reports', 'public');

        // 3. Simpan ke Database
        Report::create([
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            // Jika lokasi kosong (user tidak klik peta/geocoding gagal), beri nilai default
            'lokasi' => $request->lokasi ?? 'Lokasi via Koordinat',
            'lat' => $request->lat,
            'lng' => $request->lng,
            'foto' => $path,
            'status' => 'Menunggu', // Default status
        ]);

        // 4. Redirect ke Halaman Daftar Laporan (Sesuai permintaan)
        return redirect()->route('pengaduan.list')->with('success', 'Laporan Anda berhasil dikirim dan sedang ditinjau!');
    }

    /**
     * Menampilkan Daftar Semua Laporan (Halaman Pantau Aduan).
     * File view: resources/views/reports/index.blade.php
     */
    public function list()
    {
        // Mengambil data urut dari yang terbaru
        $reports = Report::latest()->get();
        return view('reports.index', compact('reports'));
    }

    /**
     * Menampilkan Detail Satu Laporan.
     * File view: resources/views/reports/show.blade.php
     */
    public function show($id)
    {
        // Cari laporan berdasarkan ID, jika tidak ketemu tampilkan 404
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }
}