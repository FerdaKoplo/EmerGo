<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResponseTeam;

class ResponseTeamSeeder extends Seeder
{
    public function run()
    {
        ResponseTeam::create([
            'emergency_type' => 'Kebakaran Rumah Tinggal',
            'location' => 'Jl. Darmo Permai III, Surabaya',
            'number' => 'DMKR-250724-001',
            'status' => 'Done',
            'category' => 'Damkar',
            'latitude' => -7.2575,
            'longitude' => 112.7521
        ]);

        // Add more sample data if needed
        ResponseTeam::create([
            'emergency_type' => 'Kecelakaan Lalu Lintas',
            'location' => 'Jl. Ahmad Yani, Surabaya',
            'number' => 'DMKR-250724-002',
            'status' => 'In Progress',
            'category' => 'Ambulans',
            'latitude' => -7.2670,
            'longitude' => 112.7401
        ]);
    }
}