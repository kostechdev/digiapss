<?php

namespace App\Filament\Resources\Rts\Pages;

use App\Filament\Resources\Rts\RtResource;
use App\Models\Penduduk;
use App\Models\Rt;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;

class ViewPenduduk extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = RtResource::class;

    protected string $view = 'filament.resources.rts.pages.view-penduduk';

    public Rt $record;

    public function mount(Rt $record): void
    {
        $this->record = $record;
        $this->heading = 'Penduduk RT ' . $record->nomor_rt . ' / RW ' . $record->rw->nomor_rw;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Penduduk::query()->where('rt_id', $this->record->id)
            )
            ->columns([
                TextColumn::make('nik')->label('NIK')->searchable()->toggleable(),
                TextColumn::make('nama')->label('Nama')->searchable()->toggleable(),
                TextColumn::make('jenis_kelamin')->label('JK')->badge()->color(fn($state) => $state === 'Perempuan' ? 'warning' : 'info')->toggleable(),
                TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->date('d/m/Y')->toggleable(),
                TextColumn::make('alamat')->label('Alamat')->limit(30)->toggleable(),
                TextColumn::make('rw.nomor_rw')->label('RW')->badge()->color('primary')->toggleable(),
                TextColumn::make('rt.nomor_rt')->label('RT')->badge()->color('primary')->toggleable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(true)
            ->defaultSort('nama');
    }
}
