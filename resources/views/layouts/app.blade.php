<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <title>@yield('title', 'Laravel App')</title>

    {{-- Vite (Tailwind + JS + Leaflet) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    {{-- <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">
            <div class="flex justify-center align-center"><img class="h-10 w-auto" src="{{ asset('img/logo_kabupaten_bantul.png') }}" alt="">
            <span class="font-bold text-lg">My App</span></div>
            

            <div class="space-x-4">
                <a href="/" class="font-bold text-gray-600 hover:text-black">Home</a>
                <a href="/map" class="font-bold text-gray-600 hover:text-black">Map</a>
            </div>
        </div>
    </nav> --}}
    <nav class="bg-white shadow">
        <div class="max-w-8xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-x-3">
                <img class="h-10 w-auto" src="{{ asset('img/logo_kabupaten_bantul.png') }}" alt="Logo Kabupaten Bantul">
                <div class="flex flex-col">
                    <span class="font-bold text-xl leading-none text-gray-900">PJU BANTUL</span>
                    <span class="text-xs text-gray-500">Sistem Informasi Pemetaan</span>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-medium font-medium text-gray-600 hover:text-blue-600 transition-colors">Home</a>
                <a href="/map" class="text-medium font-medium text-gray-600 hover:text-blue-600 transition-colors">Map</a>
                <a href="#" class="rounded-3xl bg-blue-600 px-4 py-2 text-medium font-medium text-white shadow-sm hover:bg-blue-500">Login</a>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10">
        <div class=" text-center max-w-7xl mx-auto px-6 py-4 text-sm text-gray-600">
            © {{ date('Y') }} PJU Kabupaten Bantul
        </div>
    </footer>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>
