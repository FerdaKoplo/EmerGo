<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverview; 
use App\Filament\Widgets\LaporanPerBulanChart;
use App\Filament\Widgets\KorbanPerBulanChart; 

class Statistik extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.statistik';
    protected static ?string $title = 'Statistik';
     public function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            KorbanPerBulanChart::class, 
            LaporanPerBulanChart::class
        ];
    }
}
