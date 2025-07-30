<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseTeam extends Model
{
    protected $fillable = [
        'emergency_type',
        'location',
        'number',
        'status',
        'category',
        'latitude',
        'longitude'
    ];
}