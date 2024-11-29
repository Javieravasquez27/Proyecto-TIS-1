const apiKey = 'TU_CLAVE_API_AQUÍ'; // Coloca tu clave API aquí

async function geocodeAddresses(addresses) {
    const locations = []; // Aquí almacenaremos las coordenadas

    for (const address of addresses) {
        const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;
        try {
            const response = await fetch(url);
            const data = await response.json();
            if (data.status === "OK") {
                const location = data.results[0].geometry.location;
                console.log(`Dirección: ${address}, Coordenadas: ${location.lat}, ${location.lng}`);
                locations.push({ address, lat: location.lat, lng: location.lng });
            } else {
                console.error(`Error con la dirección "${address}":`, data.status);
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
    return locations;
}

// Uso
geocodeAddresses(addresses).then(locations => {
    console.log("Coordenadas obtenidas:", locations);
    // Puedes mostrar estas coordenadas en el mapa o en la pantalla
});
