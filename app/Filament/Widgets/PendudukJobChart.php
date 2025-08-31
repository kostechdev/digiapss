<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Schema;
use Filament\Widgets\ChartWidget;

class PendudukJobChart extends ChartWidget
{
    protected ?string $heading = '';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        if (Schema::hasTable('pekerjaans')) {
            $counts = Penduduk::query()
                ->selectRaw('COALESCE(pekerjaans.nama, penduduk.pekerjaan) as nama, COUNT(*) as total')
                ->leftJoin('pekerjaans', 'pekerjaans.id', '=', 'penduduk.pekerjaan_id')
                ->groupByRaw('COALESCE(pekerjaans.nama, penduduk.pekerjaan)')
                ->orderByDesc('total')
                ->limit(12)
                ->get();
        } else {
            $counts = Penduduk::query()
                ->selectRaw('penduduk.pekerjaan as nama, COUNT(*) as total')
                ->groupBy('penduduk.pekerjaan')
                ->orderByDesc('total')
                ->limit(12)
                ->get();
        }

        $labels = $counts->pluck('nama')->toArray();
        $data = $counts->pluck('total')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Distribusi Pekerjaan',
                    'data' => $data,
                    'backgroundColor' => array_map(function ($i) {
                        $colors = [
                            'rgba(59,130,246,0.6)',
                            'rgba(34,197,94,0.6)',
                            'rgba(234,179,8,0.6)',
                            'rgba(244,63,94,0.6)',
                            'rgba(168,85,247,0.6)',
                            'rgba(14,165,233,0.6)',
                            'rgba(163,230,53,0.6)',
                            'rgba(249,115,22,0.6)',
                            'rgba(20,184,166,0.6)',
                            'rgba(236,72,153,0.6)',
                            'rgba(107,114,128,0.6)',
                            'rgba(190,18,60,0.6)'
                        ];
                        return $colors[$i % count($colors)];
                    }, array_keys($labels)),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
