<?php

namespace App\Filament\Resources\BannerSettings;

use App\Filament\Resources\BannerSettings\Pages\CreateBannerSetting;
use App\Filament\Resources\BannerSettings\Pages\EditBannerSetting;
use App\Filament\Resources\BannerSettings\Pages\ListBannerSettings;
use App\Filament\Resources\BannerSettings\Schemas\BannerSettingForm;
use App\Filament\Resources\BannerSettings\Tables\BannerSettingsTable;
use App\Models\BannerSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BannerSettingResource extends Resource
{
    protected static ?string $model = BannerSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'BannerSetting';

    public static function form(Schema $schema): Schema
    {
        return BannerSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BannerSettingsTable::configure($table);
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
            'index' => ListBannerSettings::route('/'),
            'create' => CreateBannerSetting::route('/create'),
            'edit' => EditBannerSetting::route('/{record}/edit'),
        ];
    }
}
