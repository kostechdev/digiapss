<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PendudukGrowthChart extends ChartWidget
{
    protected ?string $heading = '';
    
    protected static ?int $sort = 4;
    
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $now = Carbon::now();
        $labels = [];
        $counts = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $labels[] = $month->format('M Y');
            
            $count = Penduduk::query()
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            $counts[] = $count;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Penduduk Baru',
                    'data' => $counts,
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
