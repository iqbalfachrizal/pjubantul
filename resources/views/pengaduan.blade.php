@extends('layouts.app')

@section('title', 'Kirim Pengaduan Baru')

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>

    #map-input { height: 400px; width: 100%; border-radius: 12px; z-index: 10; border: 2px solid #e5e7eb; }
    .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
    .locate-button {
        background-color: white;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        cursor: pointer;
        border: 2px solid rgba(0,0,0,0.2);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 5px rgba(0,0,0,0.4);
    }
    .locate-button:hover {
        background-color: #f4f4f4;
    }
    .locate-button svg {
        width: 20px;
        height: 20px;
        fill: #333;
    }
</style>
@endpush

@section('content')
<div class="py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Pengaduan</h1>
            <a href="{{ url('/') }}" class="text-blue-600 font-medium hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-md rounded-r-lg">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul / Topik Pengaduan</label>
                            <input type="text" name="judul" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: Lampu Jalan Rusak">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Detail</label>
                            <textarea name="isi_laporan" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" placeholder="Jelaskan masalah secara detail..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Lampiran Foto Bukti</label>
                            <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700">Tentukan Lokasi (Klik/Cari/GPS)</label>
                        <div id="map-input"></div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="lat" id="lat" placeholder="Latitude" readonly class="bg-gray-50 px-3 py-2 text-xs border rounded-lg text-gray-500 focus:outline-none">
                            <input type="text" name="lng" id="lng" placeholder="Longitude" readonly class="bg-gray-50 px-3 py-2 text-xs border rounded-lg text-gray-500 focus:outline-none">
                        </div>
                        <input type="text" name="lokasi" id="alamat_lengkap" placeholder="Detail alamat akan muncul otomatis..." class="w-full px-4 py-2 text-sm border rounded-xl bg-gray-50">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-xl transition shadow-lg transform hover:-translate-y-1">
                        Kirim Laporan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // 1. Inisialisasi Map
    var map = L.map('map-input').setView([-7.7956, 110.3695], 13);
    var marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // 2. Tambahkan Kontrol Pencarian
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: "Cari daerah/jalan...",
        position: 'topright'
    })
    .on('markgeocode', function(e) {
        var center = e.geocode.center;
        updateMarker(center.lat, center.lng, e.geocode.name);
        map.setView(center, 16);
    })
    .addTo(map);

    // 3. Tambahkan TOMBOL CUSTOM (Locate Me)
    var customControl = L.Control.extend({
        options: { position: 'topleft' },
        onAdd: function (map) {
            var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            container.innerHTML = `
                <div class="locate-button" title="Ke Lokasi Saya">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm8.94 3c-.46-4.17-3.77-7.48-7.94-7.94V1h-2v2.06C6.83 3.52 3.52 6.83 3.06 11H1v2h2.06c.46 4.17 3.77 7.48 7.94 7.94V23h2v-2.06c4.17-.46 7.48-3.77 7.94-7.94H23v-2h-2.06zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/>
                    </svg>
                </div>
            `;
            container.onclick = function() {
                map.locate({setView: true, maxZoom: 16});
            }
            return container;
        }
    });
    map.addControl(new customControl());

    // 4. Fungsi Update Marker
    function updateMarker(lat, lng, address = '') {
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
        if(address) document.getElementById('alamat_lengkap').value = address;

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function(e) {
                var pos = marker.getLatLng();
                updateMarker(pos.lat, pos.lng);
                reverseGeocode(pos.lat, pos.lng);
            });
        }
    }

    // Event saat lokasi ditemukan
    map.on('locationfound', function(e) {
        updateMarker(e.latlng.lat, e.latlng.lng);
        reverseGeocode(e.latlng.lat, e.latlng.lng);
    });

    map.on('locationerror', function() {
        console.warn("Akses lokasi ditolak.");
    });

    // Klik manual pada peta
    map.on('click', function(e) {
        updateMarker(e.latlng.lat, e.latlng.lng);
        reverseGeocode(e.latlng.lat, e.latlng.lng);
    });

    // Fungsi Reverse Geocode (Koordinat -> Alamat)
    function reverseGeocode(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if(data.display_name) {
                    document.getElementById('alamat_lengkap').value = data.display_name;
                }
            });
    }

    // Jalankan deteksi lokasi otomatis saat pertama kali buka
    map.locate({setView: true, maxZoom: 16});
</script>
@endpush