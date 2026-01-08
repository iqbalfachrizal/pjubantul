<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->string('judul');           // Sesuai name="judul"
        $table->text('isi_laporan');       // Sesuai name="isi_laporan"
        $table->string('lokasi')->nullable(); // Sesuai name="lokasi"
        $table->string('lat');             // Sesuai name="lat"
        $table->string('lng');             // Sesuai name="lng"
        $table->string('foto');            // Sesuai name="foto"
        $table->string('status')->default('Menunggu'); // Tambahan untuk filter
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
