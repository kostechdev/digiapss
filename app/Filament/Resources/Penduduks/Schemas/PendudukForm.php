<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use App\Enums\JenisKelamin;
use App\Enums\Agama;
use App\Enums\StatusPerkawinan;
use App\Models\Rw;
use App\Models\Rt;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PendudukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nik')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->inputMode('numeric')
                    ->placeholder('Masukkan 16 digit NIK')
                    ->maxLength(16)
                    ->minLength(16)
                    ->rules(['regex:/^[0-9]{16}$/'])
                    ->helperText('NIK harus 16 digit angka'),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('tempat_lahir')
                    ->required(),
                DatePicker::make('tanggal_lahir')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->required()
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Select::make('agama')
                    ->required()
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ]),
                Select::make('pekerjaan_id')
                    ->label('Pekerjaan')
                    ->relationship('pekerjaan', 'nama')
                    ->searchable()
                    ->preload(),
                TextInput::make('pekerjaan')
                    ->hidden(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('no_hp'),
                Select::make('status_perkawinan')
                    ->required()
                    ->options([
                        'Belum Menikah' => 'Belum Menikah',
                        'Menikah' => 'Menikah',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Cerai Mati' => 'Cerai Mati',
                    ]),
                Select::make('rw_id')
                    ->label('RW')
                    ->options(Rw::all()->pluck('nomor_rw', 'id'))
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('rt_id', null)),
                Select::make('rt_id')
                    ->label('RT')
                    ->options(function (callable $get) {
                        $rwId = $get('rw_id');
                        if (!$rwId) {
                            return [];
                        }
                        return Rt::where('rw_id', $rwId)->pluck('nomor_rt', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->disabled(fn (callable $get) => !$get('rw_id')),
            ]);
    }
}
