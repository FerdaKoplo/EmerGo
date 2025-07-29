<?php

namespace App\Models;

use App\Enums\KategoriLaporan;
use App\Enums\StatusLaporan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor',
        'nama_insiden',
        'tanggal_waktu',
        'lokasi',
        'status',
        'kategori',
        'deskripsi',
        'foto',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => StatusLaporan::class,
        'kategori' => KategoriLaporan::class,
        'tanggal_waktu' => 'datetime',
    ];
}