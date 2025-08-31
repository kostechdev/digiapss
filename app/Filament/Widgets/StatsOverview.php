<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Penduduk;
use App\Models\Rw;
use App\Models\Rt;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        $totalPenduduk = Penduduk::query()->count();
        $wanita = Penduduk::query()->where('jenis_kelamin', 'Perempuan')->count();
        $pria = Penduduk::query()->where('jenis_kelamin', 'Laki-laki')->count();
        $totalBerita = Berita::query()->count();
        $totalKegiatan = Galeri::query()->count();
        $totalRw = Rw::query()->count();
        $totalRt = Rt::query()->count();

        return [
            Stat::make('Penduduk', number_format($totalPenduduk))
                ->description('Total penduduk terdaftar')
                ->icon('heroicon-o-users')
                ->color('primary'),
            Stat::make('RW', number_format($totalRw))
                ->description('Jumlah RW')
                ->url(route('filament.admin.resources.rws.index'))
                ->icon('heroicon-o-rectangle-group')
                ->color('success'),
            Stat::make('RT', number_format($totalRt))
                ->description('Jumlah RT')
                ->url(route('filament.admin.resources.rts.index'))
                ->icon('heroicon-o-queue-list')
                ->color('success'),
            Stat::make('Wanita', number_format($wanita))
                ->description('Penduduk perempuan')
                ->icon('heroicon-o-user')
                ->color('warning'),
            Stat::make('Pria', number_format($pria))
                ->description('Penduduk laki-laki')
                ->icon('heroicon-o-user-circle')
                ->color('info'),
            Stat::make('Berita', number_format($totalBerita))
                ->description('Total berita')
                ->icon('heroicon-o-newspaper')
                ->color('gray'),
            Stat::make('Kegiatan', number_format($totalKegiatan))
                ->description('Total kegiatan')
                ->icon('heroicon-o-presentation-chart-bar')
                ->color('gray'),
        ];
    }
}
