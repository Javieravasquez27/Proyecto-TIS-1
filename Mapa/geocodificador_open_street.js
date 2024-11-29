async function geocodeAddresses(addresses) {
    const baseUrl = "https://nominatim.openstreetmap.org/search";
    const locations = [];

    for (const address of addresses) {
        const url = `${baseUrl}?q=${encodeURIComponent(address)}&format=json&limit=1`;
        try {
            const response = await fetch(url);
            const data = await response.json();
            if (data.length > 0) {
                const location = data[0];
                console.log(`Dirección: ${address}, Coordenadas: ${location.lat}, ${location.lon}`);
                locations.push({ 
                    address, 
                    lat: parseFloat(location.lat), 
                    lng: parseFloat(location.lon) 
                });
            } else {
                console.error(`No se encontraron coordenadas para la dirección "${address}".`);
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
    return locations;
}
