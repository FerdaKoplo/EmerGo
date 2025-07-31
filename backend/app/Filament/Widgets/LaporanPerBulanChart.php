<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class LaporanPerBulanChart extends ChartWidget
{
    protected static ?string $heading = 'Laporan Masuk per Bulan';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Laporan',
                    'data' => [600, 800, 750, 900, 850, 1050, 950, 1100, 800, 1150, 1000, 1050],
                    'borderColor' => '#f59e0b',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}