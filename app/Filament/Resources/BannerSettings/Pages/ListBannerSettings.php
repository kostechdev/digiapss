<?php

namespace App\Filament\Resources\BannerSettings\Pages;

use App\Filament\Resources\BannerSettings\BannerSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBannerSettings extends ListRecords
{
    protected static string $resource = BannerSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
