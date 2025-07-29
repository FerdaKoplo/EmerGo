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

            
            var ambulanceIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
            });
            L.marker([-7.2575, 112.7521], {icon: ambulanceIcon}).addTo(map);

           
        });
    </script>
</x-filament::page>