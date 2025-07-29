<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\StatusLaporan;
use App\Enums\KategoriLaporan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaInsiden = [
            'Kebakaran Rumah Tinggal', 'Kecelakaan Beruntun', 'Pohon Tumbang',
            'Orang Terjatuh di Gunung', 'Pembobolan ATM', 'Tabrakan Motor vs Mobil',
            'Banjir Lokal', 'Penemuan Ular di Pemukiman'
        ];

        return [
            'nomor' => strtoupper(fake()->randomElement(['DMK', 'KCL', 'SAR', 'KJH'])) . '-' . now()->format('dmy') . '-' . fake()->unique()->numerify('###'),
            'nama_insiden' => fake()->randomElement($namaInsiden),
            'tanggal_waktu' => fake()->dateTimeBetween('-2 months', 'now'),
            'lokasi' => fake()->address(),
            'status' => fake()->randomElement(StatusLaporan::cases()),
            'kategori' => fake()->randomElement(KategoriLaporan::cases()),
            'deskripsi' => fake()->paragraphs(3, true),
            // Menggunakan URL gambar palsu untuk kolom foto
            'foto' => fake()->imageUrl(640, 480, 'disaster', true),
        ];
    }
}