@extends('layouts.app')

@section('title', $report->judul)

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map-detail { height: 300px; width: 100%; border-radius: 12px; z-index: 1; }
</style>
@endpush

@section('content')
<div class="py-10 px-4">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Laporan</h1>
            <a href="{{ route('pengaduan.list') }}" class="text-blue-600 font-medium hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    <img src="{{ asset('storage/' . $report->foto) }}" alt="Bukti Foto" class="w-full rounded-xl object-cover shadow-sm">
                </div>
                
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-700 mb-3 text-sm">Lokasi Kejadian</h3>
                    <div id="map-detail"></div>
                    <p class="mt-3 text-xs text-gray-500 bg-gray-50 p-2 rounded border border-gray-200">
                        {{ $report->lokasi }}
                    </p>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Laporan Publik</span>
                            <span class="text-gray-400 text-sm">• {{ $report->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $report->judul }}</h2>
                        
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            <p class="whitespace-pre-line">{{ $report->isi_laporan }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-sm text-gray-500">Status Laporan:</div>
                        <div class="flex items-center text-yellow-600 font-bold bg-yellow-100 px-4 py-1.5 rounded-full text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $report->status }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var lat = {{ $report->lat }};
    var lng = {{ $report->lng }};
    
    var mapDetail = L.map('map-detail').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(mapDetail);

    L.marker([lat, lng]).addTo(mapDetail)
        .bindPopup("<b>Lokasi Laporan</b>").openPopup();
</script>
@endpush