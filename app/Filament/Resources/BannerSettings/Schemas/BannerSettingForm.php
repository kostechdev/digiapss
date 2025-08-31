<?php

namespace App\Filament\Resources\BannerSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('gambar')
                    ->image()
                    ->directory('banner-images')
                    ->required()
                    ->columnSpanFull()
                    ->saveUploadedFileUsing(function ($file, $record) {
                        return \App\Services\DualStorageUploadService::store($file, 'banner-images');
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        \App\Services\DualStorageUploadService::delete($file);
                    }),
                Toggle::make('aktif')
                    ->default(true),
                TextInput::make('urutan')
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
            ]);
    }
}
