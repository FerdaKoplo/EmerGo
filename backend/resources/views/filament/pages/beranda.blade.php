
<x-filament::page>
    <style>
    #map {
        z-index: 0;
        position: relative;
    }
</style>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Command Center</h1>
        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="text-lg font-semibold mb-2">Recent Updates</h2>
            <div id="map" style="height: 550px; border-radius: 12px; overflow: hidden;"></div>
        </div>
    </div>

    {{-- Detail Response Team Modal --}}
<div id="detailModal" class="hidden fixed inset-0 overflow-y-auto h-full w-full" style="z-index: 9999;">
    <div class="p-5 border shadow-lg rounded-md bg-white" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 448px; height: 317px; z-index: 10000;">
        <div class="flex justify-between items-start mb-4">
            <h2 class="text-xl font-semibold">Detail Response Team</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        
        <div class="flex items-start gap-4 mb-6">
            <div class="flex-shrink-0">
                <img id="modalIcon" class="w-12 h-12 rounded-full" alt="Emergency Icon">
            </div>
            <div class="flex-grow min-w-0">
                <h3 id="modalEmergencyType" class="text-red-500 font-semibold text-base"></h3>
                <p id="modalTimeLocation" class="text-sm text-gray-500"></p>
                <p id="modalAddress" class="text-sm text-gray-600 truncate"></p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Nomor</span>
                <span id="modalNumber" class="font-medium"></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Status</span>
                <span id="modalStatus" class="px-3 py-1 rounded-full text-xs"></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Kategori</span>
                <span id="modalCategory" class="px-3 py-1 rounded-full text-xs"></span>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50" style="z-index: -1;"></div>
</div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // ...existing code...

        var map = L.map('map').setView([-7.2575, 112.7521], 13);
        
        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Data untuk setiap marker
        const markersData = [
            {
                type: 'damkar',
                position: [-7.2575, 112.7521],
                data: {
                    emergency_type: 'Kebakaran Rumah Tinggal',
                    location: 'Jl. Darmo Permai III, Surabaya',
                    number: 'DMKR-250724-001',
                    status: 'Done',
                    category: 'Damkar'
                }
            },
            {
                type: 'ambulan',
                position: [-7.2600, 112.7600],
                data: {
                    emergency_type: 'Kecelakaan Lalu Lintas',
                    location: 'Jl. Ahmad Yani, Surabaya',
                    number: 'AMB-250724-001',
                    status: 'In Progress',
                    category: 'Ambulans'
                }
            },
            {
                type: 'polisi',
                position: [-7.2550, 112.7500],
                data: {
                    emergency_type: 'Tindak Kriminal',
                    location: 'Jl. Raya Gubeng, Surabaya',
                    number: 'POL-250724-001',
                    status: 'In Progress',
                    category: 'Polisi'
                }
            }
        ];

        // Definisi icon
        const icons = {
            damkar: L.icon({
                iconUrl: '/images/damkar.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40]
            }),
            ambulan: L.icon({
                iconUrl: '/images/ambulan.png',
                iconSize: [30, 30],
                iconAnchor: [20, 40]
            }),
            polisi: L.icon({
                iconUrl: '/images/polisi.png',
                iconSize: [35, 35],
                iconAnchor: [17, 35]
            })
        };

        // Fungsi untuk menutup modal
        window.closeModal = function() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Fungsi untuk menampilkan detail
        function showDetail(data) {
    // Set icon based on category
    const iconMap = {
        'Damkar': '/images/damkar.png',
        'Ambulans': '/images/ambulan.png',
        'Polisi': '/images/polisi.png'
    };
    
    document.getElementById('modalIcon').src = iconMap[data.category];
    document.getElementById('modalEmergencyType').textContent = data.emergency_type;
    
    // Format time
    const timeAgo = '13 minutes ago'; // You should calculate this dynamically
    document.getElementById('modalTimeLocation').textContent = timeAgo;
    document.getElementById('modalAddress').textContent = data.location;
    
    document.getElementById('modalNumber').textContent = data.number;
    
    // Set status with proper styling
    const statusElement = document.getElementById('modalStatus');
    statusElement.textContent = data.status;
    if (data.status === 'Done') {
        statusElement.classList.remove('bg-yellow-100', 'text-yellow-700');
        statusElement.classList.add('bg-green-100', 'text-green-700');
    } else {
        statusElement.classList.remove('bg-green-100', 'text-green-700');
        statusElement.classList.add('bg-yellow-100', 'text-yellow-700');
    }
    
    document.getElementById('modalCategory').textContent = data.category;
    
    // Show modal
    document.getElementById('detailModal').classList.remove('hidden');
}

        // Tambahkan marker dengan data
        markersData.forEach(markerInfo => {
            L.marker(markerInfo.position, {
                icon: icons[markerInfo.type]
            })
            .addTo(map)
            .on('click', function() {
                showDetail(markerInfo.data);
            });
        });
    });
    </script>
</x-filament::page>