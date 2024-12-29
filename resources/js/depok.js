document.addEventListener("DOMContentLoaded", function () {
    const { latitude, longitude } = cityData;

    const map = L.map("map").setView([latitude, longitude], 13);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    fetch("/geojson")
        .then((response) => response.json())
        .then((data) => {
            L.geoJSON(data, {
                pointToLayer: (feature, latLng) => L.marker(latLng),
                onEachFeature: (feature, layer) => {
                    const { name, population, area, year } = feature.properties;
                    layer.bindPopup(
                        `<h3>${name}</h3>
                        <p><strong>Population:</strong> ${population}</p>
                        <p><strong>Area:</strong> ${area} km²</p>
                        <p><strong>Year:</strong> ${year}</p>`
                    );
                },
            }).addTo(map);
        })
        .catch((err) => console.error("Error loading GeoJSON:", err));
});
