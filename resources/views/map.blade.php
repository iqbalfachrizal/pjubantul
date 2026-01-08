@extends('layouts.app')

@section('title', 'Peta Sebaran PJU')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    /* Pastikan map punya z-index lebih rendah dari navbar jika ada */
    #map { z-index: 1; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto p-4 lg:p-8">
    
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Peta Sebaran PJU</h2>
        <p class="text-gray-600">Memantau kondisi lampu jalan di Kabupaten Bantul secara Real-time.</p>
    </div>

    <div class="bg-white p-2 rounded-2xl shadow-lg border border-gray-100">
        <div id="map" class="w-full h-[600px] rounded-xl z-0"></div>
    </div>
    
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
  // Data Dummy Lampu (Sesuai kode Anda)
  const streetLights = [
    { id: 1, name: "Street Light 1", status: "on", lat: -7.89610, lng: 110.33843, power: "LED" },
    { id: 2, name: "Street Light 2", status: "off", lat: -7.89582, lng: 110.33801, power: "Halogen" },
    { id: 3, name: "Street Light 3", status: "fault", lat: -7.89645, lng: 110.33902, power: "Solar" },
    { id: 4, name: "Street Light 4", status: "on", lat: -7.89701, lng: 110.33789, power: "LED" },
    { id: 5, name: "Street Light 5", status: "off", lat: -7.89554, lng: 110.33745, power: "Halogen" },
    { id: 6, name: "Street Light 6", status: "on", lat: -7.89672, lng: 110.33888, power: "Solar" },
    { id: 7, name: "Street Light 7", status: "on", lat: -7.89591, lng: 110.33931, power: "LED" },
    { id: 8, name: "Street Light 8", status: "fault", lat: -7.89633, lng: 110.33771, power: "Halogen" },
    { id: 9, name: "Street Light 9", status: "off", lat: -7.89724, lng: 110.33815, power: "Solar" },
    { id: 10, name: "Street Light 10", status: "on", lat: -7.89566, lng: 110.33954, power: "LED" },
    // ... Data lainnya
  ];

  document.addEventListener('DOMContentLoaded', () => {
    
    // Inisialisasi Peta
    const map = L.map('map').setView([-7.8961, 110.3384], 16); // Zoom saya perbesar dikit agar titik terlihat jelas

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const streetLightLayer = L.layerGroup().addTo(map);

    streetLights.forEach(light => {
        
        // Tentukan Warna berdasarkan status
        const color = 
            light.status === 'on' ? '#fde047' :   // Kuning (Nyala)
            light.status === 'fault' ? '#ef4444' : // Merah (Rusak)
            '#6b7280';                             // Abu (Mati)

        // Efek Cahaya (Glow)
        if(light.status === 'on') {
            L.circle([light.lat, light.lng], {
                radius: 20,
                color: color,
                fillColor: color,
                fillOpacity: 0.2,
                weight: 0,
                interactive: false,
            }).addTo(streetLightLayer);
        }

        // Marker Titik Lampu
        const marker = L.circleMarker([light.lat, light.lng], {
            radius: 6,
            color: '#333',
            weight: 1,
            fillColor: color,
            fillOpacity: 1,
            interactive: true,
        });

        // Tooltip
        marker.bindTooltip(`
            <div class="text-sm">
                <strong>${light.name}</strong><br>
                Status: <span class="uppercase font-bold">${light.status}</span><br>
                Type: ${light.power}
            </div>
        `, {
            direction: 'top',
            offset: [0, -5],
            opacity: 1
        });

        // Hover Effects
        marker.on('mouseover', function () {
            this.setStyle({ radius: 10, color: 'black', weight: 2 });
        });
        marker.on('mouseout', function () {
            this.setStyle({ radius: 6, color: '#333', weight: 1 });
        });

        marker.addTo(streetLightLayer);
    });
  });
</script>
@endpush