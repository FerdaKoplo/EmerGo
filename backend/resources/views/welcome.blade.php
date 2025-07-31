<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>EmerGo</title>
</head>

<body class="font-sans antialiased bg-white text-gray-800">

    {{-- Navbar --}}
    <nav class="px-8 md:px-32 sticky top-0 z-50 flex justify-between items-center py-4 bg-white shadow-md">
        <h1 class="text-2xl font-bold text-brand_primary">
            Emer<span class="text-brand_orange">Go</span>
        </h1>
        <ul class="flex items-center gap-8 font-medium text-gray-700">
            <li><a href="#about" class="hover:text-brand_orange transition">About</a></li>
            <li><a href="#features" class="hover:text-brand_orange transition">Features</a></li>
            <li><a href="#supports" class="hover:text-brand_orange transition">Supports</a></li>
        </ul>
    </nav>

    {{-- Hero --}}
    <section
        class="px-8 md:px-32 py-24 bg-brand_orange flex flex-col-reverse md:flex-row-reverse items-center justify-center gap-20">
        <div class="text-white flex flex-col gap-8 max-w-lg">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                Laporkan Kejadian Sekitar Anda dengan Cepat
            </h1>
            <p class="text-lg">
                EmerGo hadir untuk memudahkan pelaporan darurat dan kejadian penting di lingkungan Anda. Aman, cepat,
                dan langsung ditindak.
            </p>
            <a href="#about"
                class="w-fit bg-black hover:bg-white hover:text-black transition font-semibold border-2 border-white text-white px-8 py-3 rounded-full">
                JELAJAHI

            </a>
        </div>
        <img src="assets/header/header.png" alt="Ilustrasi EmerGo" class="w-full max-w-md drop-shadow-xl" />
    </section>

    {{-- About --}}
    <section id="about"
        class="px-8 md:px-32 py-24 bg-brand_secondary text-white flex flex-col-reverse md:flex-row justify-center items-center gap-10">
        <div class="flex flex-col gap-6 max-w-xl">
            <h2 class="text-4xl font-bold">Tentang EmerGo</h2>
            <p class="text-lg">
                EmerGo adalah platform pelaporan kejadian darurat yang dirancang untuk membantu masyarakat memberikan
                informasi penting secara cepat dan akurat. Kami percaya bahwa respon awal yang cepat bisa menyelamatkan
                banyak nyawa.
            </p>
        </div>
        <img src="assets/about/about.png" alt="Tentang EmerGo" class="w-full max-w-md drop-shadow-xl" />
    </section>

    {{-- Features --}}
    <section id="features" class="px-8 md:px-32 py-24 bg-gray-100 min-h-screen flex flex-col justify-center text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Fitur Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-brand_orange mb-3">Laporan Sekejap</h3>
                <p>Laporkan kejadian hanya dalam beberapa detik dengan form yang intuitif dan mudah digunakan.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-brand_secondary mb-3">Pelacakan Lokasi</h3>
                <p>Deteksi otomatis lokasi Anda untuk memberikan data akurat ke pihak berwenang.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-brand_danger mb-3">Notifikasi Tindak Lanjut</h3>
                <p>Dapatkan update real-time mengenai status laporan yang Anda kirimkan.</p>
            </div>
        </div>
    </section>

    {{-- Supports --}}
    <section id="supports" class="px-8 md:px-32 py-24 bg-white text-center min-h-screen flex flex-col justify-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Dukungan Kami</h2>
        <p class="text-gray-600 text-lg max-w-3xl mx-auto mb-12">
            Kami menyediakan dukungan teknis dan edukasi bagi masyarakat, petugas lapangan, serta instansi pemerintah
            untuk memastikan penggunaan EmerGo yang maksimal dan berkelanjutan.
        </p>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-brand_orange text-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Panduan & Dokumentasi</h3>
                <p>Manual lengkap & video tutorial bagi pengguna baru.</p>
            </div>
            <div class="bg-brand_secondary text-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Layanan Pengguna</h3>
                <p>Dukungan teknis 24/7 melalui email dan live chat.</p>
            </div>
            <div class="bg-brand_danger text-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Kolaborasi Lembaga</h3>
                <p>Buka peluang kerja sama dengan lembaga untuk meningkatkan jangkauan EmerGo.</p>
            </div>
        </div>
    </section>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll("a[href^='#']");

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const targetId = this.getAttribute("href").substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            });
        });
    });
</script>

</html>
