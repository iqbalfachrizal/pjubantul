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
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">
            <span class="font-bold text-lg">My App</span>

            <div class="space-x-4">
                <a href="/" class="font-bold text-gray-600 hover:text-black">Home</a>
                <a href="/map" class="font-bold text-gray-600 hover:text-black">Map</a>
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
