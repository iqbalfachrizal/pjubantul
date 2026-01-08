import './bootstrap';
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

// Fix missing marker icons
import icon from 'leaflet/dist/images/marker-icon.png'
import iconShadow from 'leaflet/dist/images/marker-shadow.png'

L.Icon.Default.mergeOptions({
    iconUrl: icon,
    shadowUrl: iconShadow,
})

window.L = L
