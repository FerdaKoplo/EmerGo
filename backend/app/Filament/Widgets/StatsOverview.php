<?php

namespace App\Filament\Widgets;

use App\Models\Laporan;
use App\Enums\StatusLaporan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Laporan Masuk (24 Jam Terakhir)',
                Laporan::where('created_at', '>=', now()->subDay())->count()
            )
            ->description('Laporan baru dalam sehari')
            ->color('danger'),

            Stat::make(
                'Laporan Selesai (Total)',
                Laporan::where('status', StatusLaporan::Done)->count()
            )
            ->description('Semua laporan yang telah selesai')
            ->color('success'),

            Stat::make(
                'Total Semua Laporan',
                Laporan::count()
            )
            ->description('Total laporan di dalam sistem')
            ->color('primary'),
        ];
    }
}