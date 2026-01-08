@extends('layouts.app')

@section('title', 'Map')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Leaflet Map</h2>

    <div
        id="map"
        class="w-full h-[500px] rounded-lg shadow"
    ></div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map').setView([-7.891531320417377, 110.31748408931763], 13)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map)

        L.marker([-7.891531320417377, 110.31748408931763])
            .addTo(map)
            .bindPopup('Styled with Tailwind!')
            .openPopup()
    })
</script>
@endpush
