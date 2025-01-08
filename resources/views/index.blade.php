<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peta Tingkat Kelahiran Kota {{ $city_name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="icon" href="{{ asset('kota-depok.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        main {
            flex: 1;
            width: 100%;
        }

        #map {
            height: 300px;
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

        .district-tooltip {
            background-color: white;
            color: black;
            font-size: 8px;
            font-weight: bold;
            padding: 0px 2px;
            border-radius: 3px;
            border: 1px solid #ccc;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .district-tooltip.hovered-tooltip {
            background-color: #3388ff;
            color: white;
            opacity: 1;
            border-color: #0056b3;
        }

        .legend-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            font-size: 0.9rem;
            line-height: 1.5;
            color: #333;
            border: 1px solid #ddd;
            position: relative;
            z-index: 1000;
        }

        .legend-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #444;
            text-align: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .legend-card i {
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-right: 8px;
            border-radius: 4px;
        }

        footer {
            background-color: #2d3748;
            /* warna abu-abu gelap */
            color: #e2e8f0;
            /* warna teks abu-abu muda */
            font-size: 0.875rem;
            /* ukuran font kecil */
            text-align: center;
        }


        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }

        @media (max-width: 768px) {
            .legend-card {
                position: fixed;
                bottom: 60px;
                left: 10px;
                z-index: 1000;
                width: 95%;
                padding: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                background-color: rgba(255, 255, 255, 0.9);
                border: 1px solid #ccc;
            }

            .legend-card.hidden {
                display: none;
            }
        }

        @media (min-width: 1024px) {
            #map {
                height: 500px;
            }

            .district-tooltip {
                background-color: white;
                color: black;
                font-size: 12px;
                font-weight: bold;
                padding: 2px 5px;
                border-radius: 3px;
                border: 1px solid #ccc;
                opacity: 0.8;
                transition: all 0.3s ease;
            }
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header>
        <div class="bg-blue-700 px-4 py-2">
            <div
                class="text-gray-200 text-sm text-center mx-auto max-w-7xl flex flex-col sm:flex-row space-y-2 sm:space-x-2 justify-between items-center">
                <p id="current-date" class="sm:text-start"></p>
                <p class="sm:text-end">STANDAR WAKTU INDONESIA | <span id="current-time" class="text-green-500"></span>
                </p>
            </div>
        </div>

        <div class="bg-blue-600 p-4">
            <div class="text-white mx-auto max-w-7xl flex justify-between items-center">
                @if (!request()->routeIs('home'))
                    <a class="text-lg font-bold" href="{{ route('home') }}">PETA TINGKAT KELAHIRAN KOTA
                        {{ strtoupper($city_name) }}</a>
                @else
                    <h1 class="text-sm sm:text-base md:text-lg font-bold">PETA TINGKAT KELAHIRAN KOTA
                        {{ strtoupper($city_name) }}</h1>
                @endif

                <nav class="hidden md:flex space-x-4">
                    <a class="flex items-center px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700"
                        href="{{ route('filament.admin.pages.dashboard') }}">
                        <x-lucide-user class="w-5 h-5 text-white" />
                        <span>Admin</span>
                    </a>
                </nav>

                <button id="mobileMenuButton"
                    class="md:hidden flex items-center space-x-2 px-4 py-2 text-white rounded hover:bg-blue-700">
                    <x-lucide-menu class="w-5 h-5 text-white" />
                    <span>Menu</span>
                </button>
            </div>

            <nav id="mobileMenu" class="hidden bg-blue-500 p-2 rounded mt-2 md:hidden">
                <a class="block px-4 py-2 text-white rounded hover:bg-blue-700"
                    href="{{ route('filament.admin.pages.dashboard') }}">
                    <x-lucide-user class="inline w-5 h-5 text-white" /> Admin
                </a>
            </nav>
        </div>
    </header>

    <nav class="bg-white border-b px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-2">
            <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap gap-2 md:gap-4">
                @foreach ($years as $year)
                    <form action="{{ route('home') }}" method="GET" class="inline">
                        <input type="hidden" name="year" value="{{ $year }}">
                        <button type="submit"
                            class="w-full md:w-fit flex justify-between md:justify-normal items-center px-4 py-2 gap-2 rounded
                               {{ $year == $selected_year ? 'bg-blue-500 text-white hover:bg-blue-600' : 'bg-white-500 border text-gray-600 hover:text-white hover:bg-blue-500 group' }}">
                            <x-lucide-calendar-days
                                class="w-5 h-5 order-3 md:order-1
                                   {{ $year == $selected_year ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" />
                            <span class="order-2">{{ $year }}</span>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 my-6 px-4 sm:px-6 lg:px-8">
        <!-- Modal -->
        <div id="detailModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[10000]">
            <div class="bg-white w-11/12 md:w-1/2 rounded shadow-lg p-6">
                <div class="flex justify-between items-center border-b pb-3">
                    <h3 class="text-lg font-bold">Detail Kecamatan</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <x-lucide-x class="w-5 h-5" />
                    </button>
                </div>
                <div class="mt-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <div class="col-span-12 lg:col-span-6 bg-slate-100 flex flex-col py-2 rounded-md">
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-house class="w-5 h-5 text-orange-500" />
                                <p class="font-medium text-start text-slate-500">Nama Kecamatan:</p>
                            </div>
                            <p id="modalDistrictName" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-calendar-days class="w-5 h-5 text-red-500" />
                                <p class="font-medium text-start text-slate-500">Tahun Data Kecamatan:</p>
                            </div>
                            <p id="modalDistrictDataYear" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-move-horizontal class="w-5 h-5 text-green-500" />
                                <p class="font-medium text-start text-slate-500">Latitude:</p>
                            </div>
                            <p id="modalDistrictLatitude" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-move-vertical class="w-5 h-5 text-blue-500" />
                                <p class="font-medium text-start text-slate-500">Longitude:</p>
                            </div>
                            <p id="modalDistrictLongitude" class="font-bold text-end text-slate-700"></p>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6 bg-slate-100 flex flex-col py-2 rounded-md">
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-calendar-days class="w-5 h-5 text-orange-500" />
                                <p class="font-medium text-start text-slate-500">Tahun Kelahiran:</p>
                            </div>
                            <p id="modalBirthYear" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-users class="w-5 h-5 text-red-500" />
                                <p class="font-medium text-start text-slate-500">Populasi:</p>
                            </div>
                            <p id="modalPopulation" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-target class="w-5 h-5 text-green-500" />
                                <p class="font-medium text-start text-slate-500">Area:</p>
                            </div>
                            <p id="modalArea" class="font-bold text-end text-slate-700"></p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-baby class="w-5 h-5 text-blue-500" />
                                <p class="font-medium text-start text-slate-500">Total Kelahiran:</p>
                            </div>
                            <p id="modalBirthRate" class="font-bold text-end text-slate-700"></p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button id="closeModalBtn"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tutup</button>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="col-span-12 lg:col-span-8">
            <div id="map" class="w-full rounded shadow"></div>
        </div>

        <!-- Details Section -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white p-6 rounded shadow">
                <div class="w-fit px-4 py-1 bg-green-100 rounded">
                    <h2 class="font-medium text-green-600">Terkonfirmasi</h2>
                </div>
                <p class="mt-2 text-gray-600 text-sm">{{ $birth_rate->created_at->format('d M Y, H:i:s') }}</p>
                <h3 class="mt-4 text-xl font-bold">{{ $birth_rate->district->name }}</h3>
                <div class="mt-4">
                    <div class="bg-slate-100 flex flex-col py-2 rounded-md">
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-users class="w-5 h-5 text-red-500" />
                                <p class="font-medium text-start text-slate-500">Populasi:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">
                                {{ $district_data->population }}</p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-target class="w-5 h-5 text-green-500" />
                                <p class="font-medium text-start text-slate-500">Area:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">
                                {{ $district_data->area }} Km²</p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-baby class="w-5 h-5 text-blue-500" />
                                <p class="font-medium text-start text-slate-500">Total Kelahiran:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">{{ $birth_rate->total }}</p>
                        </div>
                    </div>
                </div>
                <button id="openModal" class="mt-6 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Lihat
                    Detail</button>
            </div>
        </div>

        <div id="loading">
            <div class="spinner"></div>
            <p>Loading map data...</p>
        </div>

        <div id="legendToggle"
            class="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg z-[1001] cursor-pointer">
            Legend
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-300 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <p class="text-sm">&copy; {{ date('Y') }} Kota {{ ucfirst($city_name) }}. All rights reserved.</p>
            <p class="text-sm">Made with ❤️ by Irsal Fathi Farhat & Teams</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4leaflet/1.0.1/proj4leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = L.map("map");

            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            let categories = [];
            let geoJSONLayer;

            const EPSG32748 = "+proj=utm +zone=48 +south +datum=WGS84 +units=m +no_defs";
            const EPSG4326 = "+proj=longlat +datum=WGS84 +no_defs";

            function getBirthRateColor(birthRate) {
                return birthRate > categories[3] ? '#800026' :
                    birthRate > categories[2] ? '#BD0026' :
                    birthRate > categories[1] ? '#E31A1C' :
                    birthRate > categories[0] ? '#FC4E2A' :
                    '#FFEDA0';
            }

            function updateLegend(min, categories, max) {
                const legend = L.control({
                    position: 'bottomright'
                });

                legend.onAdd = function() {
                    const div = L.DomUtil.create('div', 'legend-card hidden');
                    div.id = 'mapLegend';
                    div.innerHTML = '<div class="legend-title">Kategori Kelahiran</div>';
                    for (let i = 0; i < categories.length; i++) {
                        div.innerHTML += `
                <div class="legend-item">
                    <i style="background:${getBirthRateColor(categories[i])}"></i>
                    <span>${i === 0 ? Math.floor(min) : Math.ceil(categories[i - 1])}–${Math.ceil(categories[i])}</span>
                </div>`;
                    }
                    div.innerHTML += `
            <div class="legend-item">
                <i style="background:${getBirthRateColor(max)}"></i>
                <span>${Math.ceil(categories[3])}+</span>
            </div>`;
                    return div;
                };

                legend.addTo(map);

                const toggleButton = document.getElementById('legendToggle');
                toggleButton.addEventListener('click', () => {
                    const legendElement = document.getElementById('mapLegend');
                    if (legendElement.classList.contains('hidden')) {
                        legendElement.classList.remove('hidden');
                    } else {
                        legendElement.classList.add('hidden');
                    }
                });
            }


            function updateMap(data) {
                const birthRates = data.features.map(f => f.properties.birth_rate);
                const minBirthRate = Math.min(...birthRates);
                const maxBirthRate = Math.max(...birthRates);
                const step = (maxBirthRate - minBirthRate) / 5;

                categories = [
                    minBirthRate + step,
                    minBirthRate + 2 * step,
                    minBirthRate + 3 * step,
                    minBirthRate + 4 * step
                ];

                if (geoJSONLayer) {
                    map.removeLayer(geoJSONLayer);
                }

                geoJSONLayer = L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#1d4ed8',
                            weight: 2,
                            fillColor: getBirthRateColor(feature.properties.birth_rate),
                            fillOpacity: 0.7,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        const {
                            name,
                            district_id
                        } = feature.properties;

                        layer.bindTooltip(name, {
                            permanent: true,
                            direction: 'center',
                            className: 'district-tooltip',
                        });

                        layer.on('mouseover', () => {
                            const tooltip = layer.getTooltip().getElement();
                            tooltip.classList.add(
                                'hovered-tooltip');
                        });

                        layer.on('mouseout', () => {
                            const tooltip = layer.getTooltip().getElement();
                            tooltip.classList.remove(
                                'hovered-tooltip');
                        });

                        layer.on('click', () => {
                            const selectedYear = {!! json_encode($selected_year) !!};
                            window.location.href =
                                `/?district=${district_id}&year=${selectedYear}`;
                        });
                    },
                }).addTo(map);

                map.fitBounds(geoJSONLayer.getBounds());
                updateLegend(minBirthRate, categories, maxBirthRate);
            }

            function reprojectGeoJSON(geojson) {
                const reprojectedGeoJSON = JSON.parse(JSON.stringify(
                    geojson));

                reprojectedGeoJSON.features.forEach((feature) => {
                    const geometryType = feature.geometry.type;

                    if (geometryType === "Polygon") {
                        feature.geometry.coordinates = feature.geometry.coordinates.map((ring) => {
                            return ring.map((point) => {
                                const [lon, lat] = proj4(EPSG32748, EPSG4326, point);
                                return [lon, lat];
                            });
                        });
                    } else if (geometryType === "MultiPolygon") {
                        feature.geometry.coordinates = feature.geometry.coordinates.map((polygon) => {
                            return polygon.map((ring) => {
                                return ring.map((point) => {
                                    const [lon, lat] = proj4(EPSG32748, EPSG4326,
                                        point);
                                    return [lon, lat];
                                });
                            });
                        });
                    }
                });

                return reprojectedGeoJSON;
            }

            function fetchGeoJSON(year) {
                document.getElementById("loading").style.display = "flex";
                fetch(`/geojson?year=${year}`)
                    .then((response) => response.json())
                    .then((data) => {
                        const reprojectedData = reprojectGeoJSON(data);
                        document.getElementById("loading").style.display = "none";
                        updateMap(reprojectedData);
                    })
                    .catch((error) => {
                        document.getElementById("loading").style.display = "none";
                        console.error("Error fetching GeoJSON:", error);
                    });
            }

            fetchGeoJSON({{ $selected_year }});
        });
    </script>
    <script>
        function updateClock() {
            const now = new Date();

            const days = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU"];
            const months = [
                "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI",
                "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"
            ];

            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");

            const formattedDate = `${day}, ${date} ${month} ${year}`;
            const formattedTime = `${hours} : ${minutes} : ${seconds}`;

            document.getElementById("current-date").textContent = formattedDate;
            document.getElementById("current-time").textContent = `${formattedTime} WIB`;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openModalButton = document.getElementById('openModal');
            const closeModalButton = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const modal = document.getElementById('detailModal');

            const modalDistrictName = document.getElementById('modalDistrictName');
            const modalDistrictDataYear = document.getElementById('modalDistrictDataYear');
            const modalDistrictLatitude = document.getElementById('modalDistrictLatitude');
            const modalDistrictLongitude = document.getElementById('modalDistrictLongitude');
            const modalBirthYear = document.getElementById('modalBirthYear');
            const modalPopulation = document.getElementById('modalPopulation');
            const modalArea = document.getElementById('modalArea');
            const modalBirthRate = document.getElementById('modalBirthRate');

            openModalButton.addEventListener('click', () => {
                modalDistrictName.textContent = "{{ $birth_rate->district->name }}";
                modalDistrictDataYear.textContent = "{{ $district_data->year }}";
                modalDistrictLatitude.textContent = "{{ $birth_rate->district->latitude }}";
                modalDistrictLongitude.textContent = "{{ $birth_rate->district->longitude }}";
                modalBirthYear.textContent = "{{ $birth_rate->birthYear->year }}";
                modalPopulation.textContent = "{{ $district_data->population }}";
                modalArea.textContent = "{{ $district_data->area }}";
                modalBirthRate.textContent = "{{ $birth_rate->total }}";
                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', () => modal.classList.add('hidden'));
            closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
