<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peta Kampus Kota {{ $city_name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        body {
            overflow: hidden;
        }

        #map {
            height: 100vh;
        }

        #loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s ease;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loading p {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        #error-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #e74c3c;
            color: white;
            padding: 20px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 8px;
            display: none;
            z-index: 1000;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s ease;
        }

        #error-message i {
            margin-right: 8px;
            font-size: 1.5rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <div id="loading">
        <div class="spinner"></div>
        <p>Loading Map...</p>
    </div>
    <div id="error-message">
        Error loading map. Please check your internet connection.
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    {{-- @push('scripts') --}}
    <script>
        const cityData = {
            latitude: {{ $latitude }},
            longitude: {{ $longitude }}
        };

        document.addEventListener("DOMContentLoaded", function() {
            const {
                latitude,
                longitude
            } = cityData;

            const map = L.map("map").setView([latitude, longitude], 13);

            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            fetch("/geojson")
                .then((response) => response.json())
                .then((data) => {
                    L.geoJSON(data, {
                        pointToLayer: (feature, latLng) => {
                            console.log(latLng);
                            return L.marker(latLng)
                        },
                        onEachFeature: (feature, layer) => {
                            const {
                                name,
                                population,
                                area,
                                year
                            } = feature.properties;
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
    </script>
    {{-- @endpush --}}
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
