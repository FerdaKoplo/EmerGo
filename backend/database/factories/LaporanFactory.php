<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\StatusLaporan;
use App\Enums\KategoriLaporan;
use Illuminate\Support\Facades\Storage;

class LaporanFactory extends Factory
{
    public function definition(): array
    {
        $namaInsiden = [
            'Kebakaran Rumah Tinggal', 'Kecelakaan Beruntun', 'Pohon Tumbang',
            'Orang Terjatuh di Gunung', 'Pembobolan ATM', 'Tabrakan Motor vs Mobil',
            'Banjir Lokal', 'Penemuan Ular di Pemukiman'
        ];

        // Ambil semua file .png dari folder images Anda
        $sumberGambar = glob(database_path('seeders/images/*.png'));

        return [
            'nomor' => strtoupper(fake()->randomElement(['DMK', 'KCL', 'SAR', 'KJH'])) . '-' . now()->format('dmy') . '-' . fake()->unique()->numerify('###'),
            'nama_insiden' => fake()->randomElement($namaInsiden),
            'tanggal_waktu' => fake()->dateTimeBetween('-2 months', 'now'),
            'lokasi' => fake()->address(),
            'status' => fake()->randomElement(StatusLaporan::cases()),
            'kategori' => fake()->randomElement(KategoriLaporan::cases()),
            'deskripsi' => fake()->paragraphs(3, true),
            'foto' => function () use ($sumberGambar) {
                if (empty($sumberGambar)) {
                    return null;
                }
                $gambarAcakPath = $sumberGambar[array_rand($sumberGambar)];
                $namaFileAsli = basename($gambarAcakPath);
                $pathTujuan = 'laporan-insiden/' . $namaFileAsli;
                Storage::disk('public')->put($pathTujuan, file_get_contents($gambarAcakPath));
                return $pathTujuan;
            },
        ];
    }
}