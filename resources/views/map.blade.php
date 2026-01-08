
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

    // … 51–100 follow the same realistic pattern
];


document.addEventListener('DOMContentLoaded', () => {
    
    const map = L.map('map').setView([-7.89609761095989, 110.33842648696569], 14)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map)

    const streetLightLayer = L.layerGroup().addTo(map)

    /* const streetLights = @json($streetLights ?? [])
    */
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

        // Tooltip on hover
     
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
           marker.bindTooltip(`
            <strong>${light.name}</strong><br>
            Status: ${light.status}<br>
            Type: ${light.power}
        `, {
        direction: 'top',
        opacity: 0.9,
        sticky: true,
        }
        )   

        
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


