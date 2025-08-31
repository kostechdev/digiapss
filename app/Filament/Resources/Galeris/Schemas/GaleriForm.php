<?php

namespace App\Filament\Resources\Galeris\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GaleriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('judul')->required(),
            RichEditor::make('deskripsi')->columnSpanFull(),
            Repeater::make('images')
                ->relationship('images')
                ->schema([
                    FileUpload::make('path')
                        ->image()
                        ->directory('galeri-images')
                        ->required()
                        ->saveUploadedFileUsing(function ($file, $record) {
                            return \App\Services\DualStorageUploadService::store($file, 'galeri-images');
                        })
                        ->deleteUploadedFileUsing(function ($file) {
                            \App\Services\DualStorageUploadService::delete($file);
                        }),
                ])
                ->orderable('position')
                ->minItems(0)
                ->maxItems(5)
                ->defaultItems(0)
                ->columnSpanFull(),
            DatePicker::make('tanggal_kegiatan'),
            Hidden::make('created_by')->default(fn () => auth()->id()),
        ]);
    }
}
