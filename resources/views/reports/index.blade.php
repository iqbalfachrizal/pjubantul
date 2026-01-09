@extends('layouts.app')

@section('title', 'Daftar Laporan Masuk')

@section('content')
<div class="py-10 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Daftar Laporan Warga</h1>
            <a href="{{ url('/') }}" class="text-blue-600 font-medium hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reports as $report)
            <a href="{{ route('pengaduan.show', $report->id) }}" class="group block">
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 h-full flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $report->foto) }}" alt="Bukti" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                            {{ $report->status }}
                        </div>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="text-xs text-gray-500 mb-2 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $report->created_at->diffForHumans() }}
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-blue-600 transition">{{ $report->judul }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 flex-1">{{ $report->isi_laporan }}</p>
                        
                        <div class="pt-4 border-t border-gray-100 flex items-center text-gray-500 text-xs">
                            <svg class="w-3 h-3 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            <span class="truncate">{{Str::limit($report->lokasi, 40)}}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($reports->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg">Belum ada laporan yang masuk.</p>
            </div>
        @endif
    </div>
</div>
@endsection