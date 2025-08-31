<?php

namespace App\Filament\Resources\Rws\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\Rws\RwResource;

class RwsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_rw')
                    ->label('Nomor RW')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_ketua')
                    ->label('Nama Ketua')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_rt')
                    ->label('Jumlah RT')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('jumlah_penduduk')
                    ->label('Jumlah Penduduk')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('lihat_rt')
                    ->label('Lihat RT')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record) => RwResource::getUrl('rts', ['record' => $record]))
                    ->openUrlInNewTab(false),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
