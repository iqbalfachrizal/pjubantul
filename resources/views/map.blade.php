@extends('layouts.app')

@section('title', 'Map')

@push('styles')
    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <h2>Map Page</h2>
    <div id="map"></div>
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([-7.891531320417377, 110.31748408931763], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([-7.891531320417377, 110.31748408931763])
            .addTo(map)
            .bindPopup('Hello from Leaflet + Laravel!')
            .openPopup();
    </script>
@endpush
