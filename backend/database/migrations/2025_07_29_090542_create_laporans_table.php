<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusLaporan;
use App\Enums\KategoriLaporan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique();
            $table->string('nama_insiden');
            $table->dateTime('tanggal_waktu');
            $table->string('lokasi');
            // Menggunakan Enum untuk nilai default status
            $table->string('status')->default(StatusLaporan::Waiting->value);
            $table->string('kategori')->default(KategoriLaporan::Damkar->value);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
