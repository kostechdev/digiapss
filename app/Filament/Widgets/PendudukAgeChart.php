<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PendudukAgeChart extends ChartWidget
{
    protected ?string $heading = '';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $now = Carbon::now();
        $groups = [
            '0-5' => [$now->copy()->subYears(5), $now],
            '6-12' => [$now->copy()->subYears(12), $now->copy()->subYears(6)->subDay()],
            '13-17' => [$now->copy()->subYears(17), $now->copy()->subYears(13)->subDay()],
            '18-25' => [$now->copy()->subYears(25), $now->copy()->subYears(18)->subDay()],
            '26-45' => [$now->copy()->subYears(45), $now->copy()->subYears(26)->subDay()],
            '46-59' => [$now->copy()->subYears(59), $now->copy()->subYears(46)->subDay()],
            '60+' => [null, $now->copy()->subYears(60)->subDay()],
        ];

        $labels = [];
        $totalCounts = [];

        foreach ($groups as $label => [$from, $until]) {
            $query = Penduduk::query();
            $queryWanita = Penduduk::query()->where('jenis_kelamin', 'Perempuan');
            $queryPria = Penduduk::query()->where('jenis_kelamin', 'Laki-laki');
            
            if ($from) {
                $query->whereDate('tanggal_lahir', '>=', $from->toDateString());
                $queryWanita->whereDate('tanggal_lahir', '>=', $from->toDateString());
                $queryPria->whereDate('tanggal_lahir', '>=', $from->toDateString());
            }
            if ($until) {
                $query->whereDate('tanggal_lahir', '<=', $until->toDateString());
                $queryWanita->whereDate('tanggal_lahir', '<=', $until->toDateString());
                $queryPria->whereDate('tanggal_lahir', '<=', $until->toDateString());
            }
            
            $labels[] = $label;
            $totalCounts[] = $query->count();
            $queryWanita->count();
            $queryPria->count();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Distribusi Usia',
                    'data' => $totalCounts,
                    'backgroundColor' => [
                        'rgba(34,197,94,0.5)',
                        'rgba(59,130,246,0.5)',
                        'rgba(234,179,8,0.5)',
                        'rgba(168,85,247,0.5)',
                        'rgba(244,63,94,0.5)',
                        'rgba(14,165,233,0.5)',
                        'rgba(163,230,53,0.5)'
                    ],
                    'borderColor' => [
                        'rgb(34,197,94)',
                        'rgb(59,130,246)',
                        'rgb(234,179,8)',
                        'rgb(168,85,247)',
                        'rgb(244,63,94)',
                        'rgb(14,165,233)',
                        'rgb(163,230,53)'
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
