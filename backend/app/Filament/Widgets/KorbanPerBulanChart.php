<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class KorbanPerBulanChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Korban Dilaporkan per Bulan';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // data dummy
        return [
            'datasets' => [
                [
                    'label' => 'Korban Jiwa',
                    'data' => [200, 300, 450, 350, 500, 650, 700, 500, 600, 800, 700, 750],
                    'borderColor' => '#ef4444', // warna merah
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