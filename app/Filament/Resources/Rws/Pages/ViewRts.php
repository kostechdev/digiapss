<?php

namespace App\Filament\Resources\Rws\Pages;

use App\Filament\Resources\Rws\RwResource;
use App\Models\Rt;
use App\Models\Rw;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables; 
use Filament\Tables\Concerns\InteractsWithTable;

class ViewRts extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string $resource = RwResource::class;

    protected string $view = 'filament.resources.rws.pages.view-rts';

    public Rw $record;

    public function mount(Rw $record): void
    {
        $this->record = $record;
        $this->heading = 'Daftar RT di RW ' . $record->nomor_rw;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Rt::query()->where('rw_id', $this->record->id)
            )
            ->columns([
                TextColumn::make('nomor_rt')
                    ->label('Nomor RT')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama_ketua')
                    ->label('Nama Ketua')
                    ->sortable()
                    ->searchable(),
            ])
            ->paginated(true)
            ->defaultSort('nomor_rt');
    }

    public function getBreadcrumb(): string
    {
        return 'RT';
    }
}
