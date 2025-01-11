<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mapContainer = document.getElementById("map");
        const skeletonLoader = document.getElementById("map-skeleton");

        const map = L.map("map");

        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        let categories = [];
        let geoJSONLayer;

        const EPSG32748 = "+proj=utm +zone=48 +south +datum=WGS84 +units=m +no_defs";
        const EPSG4326 = "+proj=longlat +datum=WGS84 +no_defs";

        function getUrlParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                district: params.get('district'),
                year: params.get('year'),
            };
        }

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
                const div = L.DomUtil.create('div', 'legend-card hidden-mobile');
                div.id = 'mapLegend';
                div.innerHTML = '<div class="legend-title">Kategori Kelahiran</div>';
                for (let i = 0; i < categories.length; i++) {
                    div.innerHTML += `
                        <div class="legend-item">
                            <i style="background:${getBirthRateColor(categories[i])}"></i>
                            <span>${i === 0 ? Math.floor(min) : Math.ceil(categories[i - 1])} - ${Math.ceil(categories[i])}</span>
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
                if (legendElement.classList.contains('hidden-mobile')) {
                    legendElement.classList.remove('hidden-mobile');
                } else {
                    legendElement.classList.add('hidden-mobile');
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

                    const urlParams = getUrlParams();
                    const selectedDistrict = urlParams.district;

                    if (selectedDistrict && district_id === parseInt(selectedDistrict, 10)) {
                        layer.setStyle({
                            fillOpacity: 1,
                        });
                        layer.bringToFront();
                        layer.on('tooltipopen', () => {
                            layer.getTooltip().getElement().classList.add(
                                'hovered-tooltip');
                        })
                    }

                    layer.bindTooltip(name, {
                        permanent: true,
                        direction: 'center',
                        className: 'district-tooltip',
                    });

                    layer.on('mouseover', () => {
                        if (district_id !== parseInt(selectedDistrict, 10)) {
                            layer.bringToFront();
                            layer.setStyle({
                                fillOpacity: 1,
                                weight: 3,
                            });

                            const tooltip = layer.getTooltip().getElement();
                            tooltip.classList.add(
                                'hovered-tooltip');
                        }
                    });

                    layer.on('mouseout', () => {
                        if (district_id !== parseInt(selectedDistrict, 10)) {
                            layer.setStyle({
                                fillOpacity: 0.7,
                                weight: 2,
                            });

                            const tooltip = layer.getTooltip().getElement();
                            tooltip.classList.remove(
                                'hovered-tooltip');
                        }
                    });

                    layer.on('click', () => {
                        const selectedYear = {!! json_encode($selected_year) !!};
                        window.location.href =
                            `/?district=${district_id}&year=${selectedYear}`;
                    });
                },
            }).addTo(map);

            skeletonLoader.classList.add("hidden");
            mapContainer.classList.remove("hidden");

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
