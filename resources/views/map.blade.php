@extends('layouts.app')

@section('title', 'Map')

@section('content')
<div class="py-6">
   
    <div class=" bg-gray-100 rounded-lg shadow-md w-[60vw] mx-auto my-[2vh]">
    <div class="flex">
        <input
            id="addressSearch"
            type="text"
            placeholder="Search address or place..."
            class="flex-1 px-3 py-2 border-r outline-none rounded-l-lg text-sm"
        />
        <button
            id="searchBtn"
            class="px-4 text-sm font-medium bg-blue-600 text-white rounded-r-lg hover:bg-blue-700"
        >
            Search
        </button>
    </div>
    <div id="searchStatus" class="text-xs text-gray-500 px-3 py-1 hidden"></div>
</div>
    <div
        id="map"
        class=" max-w-screen  w-screen h-[80vh] border-4 border-gray-300 rounded-lg "
    ></div>
    
    <!-- Overlay -->
<div
    id="panelOverlay"
    class="fixed inset-0 bg-black/10 hidden z-2000"
></div>

<!-- Side Panel -->
<div
    id="lampPanel"
    class="fixed top-0 right-0 h-full w-96 bg-white shadow-xl
           transform translate-x-full transition-duration-300
           z-2100 overflow-y-auto"
>
    <div class=" border-b flex justify-between items-center sticky top-0 bg-white z-10">
        <h3 class="text-lg font-bold">Street Light Detail</h3>
        <button id="closePanel" class="text-xl text-gray-500 hover:text-gray-800">
            &times;
        </button>
    </div>

    <div id="lampContent" class="p-4 space-y-4">
        <!-- Filled by JS -->
    </div>
</div>

    
</div>
@endsection
@push('scripts')
<script>
    
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

    { id: 11, name: "Street Light 11", status: "on", lat: -7.89681, lng: 110.33792, power: "LED" },
    { id: 12, name: "Street Light 12", status: "off", lat: -7.89538, lng: 110.33866, power: "Solar" },
    { id: 13, name: "Street Light 13", status: "fault", lat: -7.89659, lng: 110.33919, power: "Halogen" },
    { id: 14, name: "Street Light 14", status: "on", lat: -7.89712, lng: 110.33764, power: "LED" },
    { id: 15, name: "Street Light 15", status: "off", lat: -7.89577, lng: 110.33894, power: "Solar" },
    { id: 16, name: "Street Light 16", status: "on", lat: -7.89604, lng: 110.33973, power: "Halogen" },
    { id: 17, name: "Street Light 17", status: "on", lat: -7.89731, lng: 110.33841, power: "LED" },
    { id: 18, name: "Street Light 18", status: "fault", lat: -7.89548, lng: 110.33783, power: "Solar" },
    { id: 19, name: "Street Light 19", status: "off", lat: -7.89668, lng: 110.33822, power: "Halogen" },
    { id: 20, name: "Street Light 20", status: "on", lat: -7.89593, lng: 110.33907, power: "LED" },

    { id: 21, name: "Street Light 21", status: "on", lat: -7.89621, lng: 110.33752, power: "Solar" },
    { id: 22, name: "Street Light 22", status: "off", lat: -7.89708, lng: 110.33876, power: "Halogen" },
    { id: 23, name: "Street Light 23", status: "fault", lat: -7.89562, lng: 110.33938, power: "LED" },
    { id: 24, name: "Street Light 24", status: "on", lat: -7.89694, lng: 110.33791, power: "Solar" },
    { id: 25, name: "Street Light 25", status: "off", lat: -7.89529, lng: 110.33853, power: "Halogen" },
    { id: 26, name: "Street Light 26", status: "on", lat: -7.89647, lng: 110.33962, power: "LED" },
    { id: 27, name: "Street Light 27", status: "on", lat: -7.89719, lng: 110.33805, power: "Solar" },
    { id: 28, name: "Street Light 28", status: "fault", lat: -7.89583, lng: 110.33766, power: "Halogen" },
    { id: 29, name: "Street Light 29", status: "off", lat: -7.89656, lng: 110.33889, power: "LED" },
    { id: 30, name: "Street Light 30", status: "on", lat: -7.89597, lng: 110.33921, power: "Solar" },

    { id: 31, name: "Street Light 31", status: "on", lat: -7.89612, lng: 110.33784, power: "LED" },
    { id: 32, name: "Street Light 32", status: "off", lat: -7.89703, lng: 110.33847, power: "Solar" },
    { id: 33, name: "Street Light 33", status: "fault", lat: -7.89571, lng: 110.33911, power: "Halogen" },
    { id: 34, name: "Street Light 34", status: "on", lat: -7.89685, lng: 110.33758, power: "LED" },
    { id: 35, name: "Street Light 35", status: "off", lat: -7.89544, lng: 110.33892, power: "Solar" },
    { id: 36, name: "Street Light 36", status: "on", lat: -7.89663, lng: 110.33948, power: "Halogen" },
    { id: 37, name: "Street Light 37", status: "on", lat: -7.89727, lng: 110.33819, power: "LED" },
    { id: 38, name: "Street Light 38", status: "fault", lat: -7.89588, lng: 110.33774, power: "Solar" },
    { id: 39, name: "Street Light 39", status: "off", lat: -7.89654, lng: 110.33861, power: "Halogen" },
    { id: 40, name: "Street Light 40", status: "on", lat: -7.89599, lng: 110.33932, power: "LED" },

    { id: 41, name: "Street Light 41", status: "on", lat: -7.89618, lng: 110.33795, power: "Solar" },
    { id: 42, name: "Street Light 42", status: "off", lat: -7.89706, lng: 110.33888, power: "Halogen" },
    { id: 43, name: "Street Light 43", status: "fault", lat: -7.89569, lng: 110.33955, power: "LED" },
    { id: 44, name: "Street Light 44", status: "on", lat: -7.89692, lng: 110.33771, power: "Solar" },
    { id: 45, name: "Street Light 45", status: "off", lat: -7.89533, lng: 110.33834, power: "Halogen" },
    { id: 46, name: "Street Light 46", status: "on", lat: -7.89651, lng: 110.33966, power: "LED" },
    { id: 47, name: "Street Light 47", status: "on", lat: -7.89722, lng: 110.33827, power: "Solar" },
    { id: 48, name: "Street Light 48", status: "fault", lat: -7.89586, lng: 110.33782, power: "Halogen" },
    { id: 49, name: "Street Light 49", status: "off", lat: -7.89661, lng: 110.33873, power: "LED" },
    { id: 50, name: "Street Light 50", status: "on", lat: -7.89595, lng: 110.33944, power: "Solar" },
];

// Cache for addresses to avoid repeated API calls
const addressCache = new Map();

async function getAddress(lat, lng) {
    const cacheKey = `${lat},${lng}`;
    
    // Check cache first
    if (addressCache.has(cacheKey)) {
        return addressCache.get(cacheKey);
    }
    
    try {
        const response = await fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`,
            {
                headers: {
                    'User-Agent': 'StreetLightMap/1.0'
                }
            }
        );
        
        if (!response.ok) {
            throw new Error('Failed to fetch address');
        }
        
        const data = await response.json();
        const address = {
            full: data.display_name || 'Address not available',
            road: data.address?.road || 'Unknown road',
            suburb: data.address?.suburb || data.address?.neighbourhood || '',
            city: data.address?.city || data.address?.town || data.address?.village || '',
            postcode: data.address?.postcode || ''
        };
        
        // Cache the result
        addressCache.set(cacheKey, address);
        return address;
        
    } catch (error) {
        console.error('Error fetching address:', error);
        return {
            full: 'Unable to fetch address',
            road: 'Unknown',
            suburb: '',
            city: '',
            postcode: ''
        };
    }
}

document.addEventListener('DOMContentLoaded', () => {
    
    const map = L.map('map').setView([-7.89609761095989, 110.33842648696569], 14)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map)

    const streetLightLayer = L.layerGroup().addTo(map)

    const lampPanel = document.getElementById('lampPanel')
    const lampContent = document.getElementById('lampContent')
    const panelOverlay = document.getElementById('panelOverlay')
    const closePanel = document.getElementById('closePanel')
    // =======================
// Address → Point Search
// =======================

let searchMarker = null;

const searchInput = document.getElementById('addressSearch');
const searchBtn = document.getElementById('searchBtn');
const searchStatus = document.getElementById('searchStatus');

async function searchAddress(query) {
    if (!query.trim()) return;

    searchStatus.textContent = 'Searching...';
    searchStatus.classList.remove('hidden');

    try {
        const response = await fetch(
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`,
            {
                headers: {
                    'User-Agent': 'StreetLightMap/1.0'
                }
            }
        );

        const results = await response.json();

        if (!results.length) {
            searchStatus.textContent = 'No results found';
            return;
        }

        const result = results[0];
        const lat = parseFloat(result.lat);
        const lng = parseFloat(result.lon);

        // Remove old marker
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        // Add marker
        searchMarker = L.marker([lat, lng], {
            draggable: false
        }).addTo(map);

        searchMarker.bindPopup(`
            <strong>Search Result</strong><br>
            ${result.display_name}
        `).openPopup();

        // Move map
        map.setView([lat, lng], 17, { animate: true });

        searchStatus.textContent = result.display_name;

    } catch (error) {
        console.error(error);
        searchStatus.textContent = 'Search failed';
    }
}

// Button click
searchBtn.addEventListener('click', () => {
    searchAddress(searchInput.value);
});

// Enter key
searchInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        searchAddress(searchInput.value);
    }
});


async function openLampPanel(light) {
    // Show loading state
    lampContent.innerHTML = `
        <div>
            <h4 class="text-xl font-semibold">${light.name}</h4>
            <p class="text-sm text-gray-500">ID: ${light.id}</p>
        </div>

        <div class="space-y-2">
            <div>
                <span class="font-medium">Status:</span>
                <span class="ml-2 px-2 py-1 rounded text-white text-sm
                    ${light.status === 'on' ? 'bg-yellow-500' :
                      light.status === 'fault' ? 'bg-red-500' :
                      'bg-gray-500'}">
                    ${light.status}
                </span>
            </div>

            <div>
                <span class="font-medium">Power:</span>
                ${light.power}
            </div>

            <div>
                <span class="font-medium">Coordinates:</span>
                <div class="text-sm text-gray-600">
                    ${light.lat}, ${light.lng}
                </div>
            </div>

            <div class="border-t pt-2">
                <span class="font-medium">Address:</span>
                <div class="text-sm text-gray-600 mt-1">
                    <div class="flex items-center space-x-2">
                        <svg class="animate-spin h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Loading address...</span>
                    </div>
                </div>
            </div>

            <div>
                <a href="https://www.google.com/maps/search/?api=1&query=${light.lat},${light.lng}" 
                   target="_blank"
                   class="text-blue-600 hover:underline">
                    View Location on Google Maps
                </a>
            </div>
        </div>
    `;

    lampPanel.classList.remove('translate-x-full');
    panelOverlay.classList.remove('hidden');

    // Fetch address asynchronously
    const address = await getAddress(light.lat, light.lng);

    // Update with address information
    lampContent.innerHTML = `
        <div>
            <h4 class="text-xl font-semibold">${light.name}</h4>
            <p class="text-sm text-gray-500">ID: ${light.id}</p>
        </div>

        <div class="space-y-3">
            <div>
                <span class="font-medium">Status:</span>
                <span class="ml-2 px-2 py-1 rounded text-white text-sm
                    ${light.status === 'on' ? 'bg-yellow-500' :
                      light.status === 'fault' ? 'bg-red-500' :
                      'bg-gray-500'}">
                    ${light.status}
                </span>
            </div>

            <div>
                <span class="font-medium">Power Type:</span>
                <span class="ml-2">${light.power}</span>
            </div>

            <div class="border-t pt-3">
                <div class="font-medium mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Location Address
                </div>
                <div class="text-sm text-gray-700 space-y-1 bg-gray-50 p-3 rounded">
                    ${address.road !== 'Unknown' ? `
                        <div><span class="font-medium">Street:</span> ${address.road}</div>
                    ` : ''}
                    ${address.suburb ? `
                        <div><span class="font-medium">Area:</span> ${address.suburb}</div>
                    ` : ''}
                    ${address.city ? `
                        <div><span class="font-medium">City:</span> ${address.city}</div>
                    ` : ''}
                    ${address.postcode ? `
                        <div><span class="font-medium">Postcode:</span> ${address.postcode}</div>
                    ` : ''}
                    <div class="text-xs text-gray-500 mt-2 pt-2 border-t">
                        ${address.full}
                    </div>
                </div>
            </div>

            <div class="border-t pt-3">
                <span class="font-medium">Coordinates:</span>
                <div class="text-sm text-gray-600 font-mono bg-gray-50 p-2 rounded mt-1">
                    ${light.lat.toFixed(6)}, ${light.lng.toFixed(6)}
                </div>
            </div>

            <div class="border-t pt-3">
                <a href="https://www.google.com/maps/search/?api=1&query=${light.lat},${light.lng}" 
                   target="_blank"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View on Google Maps
                </a>
            </div>
        </div>
    `;
}

function closeLampPanel() {
    lampPanel.classList.add('translate-x-full')
    panelOverlay.classList.add('hidden')
}

closePanel.addEventListener('click', closeLampPanel)
panelOverlay.addEventListener('click', closeLampPanel)

    streetLights.forEach(light => {

        const color =
    light.status === 'on' ? '#fde047' :
    light.status === 'fault' ? '#ef4444' :
    '#6b7280';

        const marker = L.circleMarker([light.lat, light.lng], {
            radius: 4,
            color: '#000000',
            fillColor: color,
            fillOpacity: 0.9,
            weight: 1,
            interactive: true,
        })

        // Hover effect
        marker.on('mouseover', function () {
            this.setStyle({
                radius: 10,
                fillOpacity: 1,
            })
        })

        marker.on('mouseout', function () {
            this.setStyle({
                radius: 6,
                fillOpacity: 0.9,
            })
        })
        
        marker.on('click', () => {
            openLampPanel(light)
        })

        marker.bindTooltip(`
            <strong>${light.name}</strong><br>
            Status: ${light.status}<br>
            Type: ${light.power}
        `, {
            direction: 'top',
            opacity: 0.9,
            sticky: true,
        })       

        const glow = L.circle([light.lat, light.lng], {
            radius: 25,
            color: color,
            fillColor: color,
            fillOpacity: 0.35,
            weight: 0,
            interactive: false,
        })
    
        glow.addTo(streetLightLayer)
        marker.addTo(streetLightLayer)
    })

})
</script>
@endpush