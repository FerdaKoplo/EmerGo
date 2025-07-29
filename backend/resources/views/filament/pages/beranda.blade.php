<x-filament::page>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Command Center</h1>
        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="text-lg font-semibold mb-2">Recent Updates</h2>
            <div id="map" style="height: 550px; border-radius: 12px; overflow: hidden;"></div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([-7.2575, 112.7521], 13); 
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            
            var damkarIcon = L.icon({
            iconUrl: '/images/damkar.png', 
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            }); 
            L.marker([-7.2575, 112.7521], {icon: damkarIcon}).addTo(map);

            var ambulanIcon = L.icon({
            iconUrl: '/images/ambulan.png',
            iconSize: [30, 30],
            iconAnchor: [20, 40],
            });
            L.marker([-7.2600, 112.7600], {icon: ambulanIcon}).addTo(map);

            var polisiIcon = L.icon({
            iconUrl: '/images/polisi.png',
            iconSize: [35, 35],
            iconAnchor: [17, 35],
            });
            L.marker([-7.2550, 112.7500], {icon: polisiIcon}).addTo(map);
                
        });
    </script>
</x-filament::page>