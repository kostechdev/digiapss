<?php

namespace App\Filament\Resources\Rws;

use App\Filament\Resources\Rws\Pages\CreateRw;
use App\Filament\Resources\Rws\Pages\EditRw;
use App\Filament\Resources\Rws\Pages\ListRws;
use App\Filament\Resources\Rws\Pages\ViewRts;
use App\Filament\Resources\Rws\Schemas\RwForm;
use App\Filament\Resources\Rws\Tables\RwsTable;
use App\Models\Rw;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RwResource extends Resource
{
    protected static ?string $model = Rw::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string| UnitEnum|null $navigationGroup = 'Data Master';
    protected static ?string $recordTitleAttribute = 'Rw';

    public static function form(Schema $schema): Schema
    {
        return RwForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RwsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRws::route('/'),
            'create' => CreateRw::route('/create'),
            'edit' => EditRw::route('/{record}/edit'),
            'rts' => ViewRts::route('/{record}/rts'),
        ];
    }
}
