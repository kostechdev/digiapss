<?php

namespace App\Filament\Resources\Galeris\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker as FilterDatePicker;

class GalerisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Kegiatan')->searchable()->sortable(),
                TextColumn::make('tanggal_kegiatan')->date()->sortable(),
                TextColumn::make('createdBy.name')->label('Dibuat Oleh')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ])
            ->defaultSort('tanggal_kegiatan', 'desc')
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                Filter::make('tanggal')
                    ->form([
                        FilterDatePicker::make('from')->label('Dari'),
                        FilterDatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('tanggal_kegiatan', '>=', $date))
                            ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('tanggal_kegiatan', '<=', $date));
                    }),
            ]);
    }
}
