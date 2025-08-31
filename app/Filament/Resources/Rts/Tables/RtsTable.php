<?php

namespace App\Filament\Resources\Rts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\Rts\RtResource;

class RtsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rw.nomor_rw')
                    ->label('RW')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nomor_rt')
                    ->label('Nomor RT')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_ketua')
                    ->label('Nama Ketua')
                    ->searchable()
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
                Action::make('overview')
                    ->label('Overview')
                    ->icon('heroicon-o-user-group')
                    ->color('info')
                    ->url(fn ($record) => RtResource::getUrl('overview', ['record' => $record]))
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
