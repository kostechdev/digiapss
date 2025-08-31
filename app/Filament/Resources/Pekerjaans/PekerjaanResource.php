<?php

namespace App\Filament\Resources\Pekerjaans;

use App\Filament\Resources\Pekerjaans\Pages\CreatePekerjaan;
use App\Filament\Resources\Pekerjaans\Pages\EditPekerjaan;
use App\Filament\Resources\Pekerjaans\Pages\ListPekerjaans;
use App\Models\Pekerjaan;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use UnitEnum;

class PekerjaanResource extends Resource
{
    protected static ?string $model = Pekerjaan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nama')
                ->label('Nama Pekerjaan')
                ->required()
                ->unique(ignoreRecord: true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPekerjaans::route('/'),
            'create' => CreatePekerjaan::route('/create'),
            'edit' => EditPekerjaan::route('/{record}/edit'),
        ];
    }
}
