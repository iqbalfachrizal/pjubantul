<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                <a href="/" class="text-gray-600 hover:text-black">Home</a>
                <a href="/map" class="text-gray-600 hover:text-black">Map</a>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-500">
            © {{ date('Y') }} My App
        </div>
    </footer>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>
