<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor\ToolbarButton;


class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori')
                    ->options([
                        'berita' => 'Berita',
                        'pengumuman' => 'Pengumuman',
                    ])
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $state));
                        $slug = trim($slug, '-');
                        $set('slug', $slug);
                    }),
                TextInput::make('slug')
                    ->required()
                    ->readOnly(),
                FileUpload::make('gambar')
                    ->image()
                    ->directory('berita-images')
                    ->required()
                    ->columnSpanFull()
                    ->saveUploadedFileUsing(function ($file, $record) {
                        return \App\Services\DualStorageUploadService::store($file, 'berita-images');
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        \App\Services\DualStorageUploadService::delete($file);
                    }),
                RichEditor::make('konten')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'code',
                        'codeBlock',
                    
                        'h2',
                        'h3',
                        'link',
                        'redo',
                        'undo'
                        
                    ])
                    ->columnSpanFull(),
                Hidden::make('penulis')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
