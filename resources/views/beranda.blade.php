@extends('layouts.app')

@section('title', 'PJU Kabupaten Bantul')

@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">


        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>

    <body
        class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

        <div class="w-full">
            <main class="relative isolate h-160 flex items-center justify-center bg-gray-900">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=screen"
                    alt="" class="absolute inset-0 -z-10 size-full object-cover opacity-40" />
                <div class="mx-auto max-w-full px-6 py-20 text-center">

                    <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-white">
                        Penerangan Jalan Umum Kabupaten Bantul
                    </h2>

                    <p class="mt-6 text-xl leading-8 text-white max-w-xl mx-auto">
                        Sistem pemetaan terpadu yang menampilkan informasi Lampu PJU, Tiang, dan KWH di seluruh wilayah
                        Kabupaten Bantul. Akurat, terstruktur, dan dapat diakses publik.
                    </p>

                    <div class="mt-10 flex justify-center gap-x-6">
                        <a href="/map"
                            class="rounded-4xl text-lg bg-white px-8 py-4 text-black font-semibold shadow-sm hover:bg-gray-200">
                            Lihat Peta
                        </a>
                        <a href="/pengaduan"
                            class="rounded-4xl text-lg bg-blue-600 px-8 py-4 text-white font-semibold shadow-sm hover:bg-blue-500">
                            Kirim Aduan
                        </a>
                    </div>

                </div>
            </main>
            <article>
                <h3 class="mt-20 text-center md:text-4xl font-bold tracking-tight text-black">
                    Platform Manajemen Aset PJU Kabupaten Bantul
                </h3>

                <p class="mt-6 text-center text-lg leading-8 font-base leading-relaxed text-gray-600 max-w-2xl mx-auto">
                    Aplikasi WebGIS yang dirancang untuk membantu pemerintah dan masyarakat dalam memantau kondisi
                    Penerangan Jalan Umum secara menyeluruh. Informasi disajikan secara visual, terpusat, dan mudah diakses.
                </p>
                <div class=" py-24 sm:py-32">
                    <h3 class="mb-15 text-center md:text-4xl font-bold tracking-tight text-black">
                        Statistik aset tahun 2026
                    </h3>
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">

                        <dl class="grid grid-cols-2 gap-8 text-center lg:grid-cols-3">
                            <div
                                class="mmx-auto flex w-full max-w-md flex-col gap-y-6 bg-white p-12 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all">
                                <dt class="text-lg font-medium text-gray-600">Total Lampu</dt>
                                <dd class="order-first text-4xl font-bold tracking-tight text-green-900 sm:text-6xl">
                                    10.418
                                </dd>
                            </div>

                            <div
                                class="mx-auto flex w-full max-w-md flex-col gap-y-6 bg-white p-12 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all">
                                <dt class="text-lg font-medium text-gray-600">Total Tiang</dt>
                                <dd class="order-first text-4xl font-bold tracking-tight text-red-900 sm:text-6xl">
                                    10.131
                                </dd>
                            </div>

                            <div
                                class="mx-auto flex w-full max-w-md flex-col gap-y-6 bg-white p-12 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all">
                                <dt class="text-lg font-medium text-gray-600">Total Aset</dt>
                                <dd class="order-first text-4xl font-bold tracking-tight text-purple-900 sm:text-6xl">
                                    20.549
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <h3 class="mb-6 text-center md:text-3xl font-bold tracking-tight text-black">
                    Kendali Penuh atas Infrastruktur Penerangan Kota
                </h3>
                <p class="text-center text-lg leading-8 font-base leading-relaxed text-gray-600 max-w-2xl mx-auto">
                    Seluruh aset PJU dapat dipantau secara menyeluruh melalui sistem ini. Akses cepat ke identitas aset, kondisi, serta riwayat perawatan, memberikan efisiensi tinggi dalam pengelolaan infrastruktur kota.
                </p>

            </article>
        </div>

        </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>

    </html>
@endsection
