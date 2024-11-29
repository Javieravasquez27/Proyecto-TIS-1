// Crear el mapa inicial
const map = L.map('map').setView([37.7749, -122.4194], 5); // Coordenadas iniciales (centro del mapa)

// Agregar el tile layer (mapa base)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Lista de direcciones
const addresses = [
    "1600 Amphitheatre Parkway, Mountain View, CA",
    "1 Infinite Loop, Cupertino, CA",
    "350 Fifth Avenue, New York, NY"
];

// Geocodificar y agregar marcadores
geocodeAddresses(addresses).then(locations => {
    locations.forEach(location => {
        L.marker([location.lat, location.lng])
            .addTo(map)
            .bindPopup(`<b>${location.address}</b><br>Lat: ${location.lat}, Lng: ${location.lng}`)
            .openPopup();
    });
});
