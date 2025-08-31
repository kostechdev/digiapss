<?php

namespace App\Filament\Resources\Rws\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RwForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_rw')
                    ->label('Nomor RW')
                    ->required()
                    ->placeholder('Contoh: 001, 002, 003')
                    ->maxLength(10),
                TextInput::make('nama_ketua')
                    ->label('Nama Ketua RW')
                    ->required()
                    ->placeholder('Masukkan nama ketua RW')
                    ->maxLength(255),
            ]);
    }
}
