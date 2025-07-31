<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->unsignedInteger('total_laporan')->default(0);
            $table->unsignedInteger('jumlah_damkar')->default(0);
            $table->unsignedInteger('jumlah_ambulance')->default(0);
            $table->unsignedInteger('jumlah_sar')->default(0);
            $table->unsignedInteger('jumlah_polisi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};