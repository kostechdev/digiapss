<?php

namespace App\Filament\Resources\Rts\Schemas;

use App\Models\Rw;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('rw_id')
                    ->label('RW')
                    ->options(Rw::all()->pluck('nomor_rw', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('nomor_rt')
                    ->label('Nomor RT')
                    ->required()
                    ->placeholder('Contoh: 001, 002, 003')
                    ->maxLength(10),
                TextInput::make('nama_ketua')
                    ->label('Nama Ketua RT')
                    ->required()
                    ->placeholder('Masukkan nama ketua RT')
                    ->maxLength(255),
            ]);
    }
}
