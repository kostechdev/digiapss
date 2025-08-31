<?php

namespace App\Filament\Resources\BannerSettings\Pages;

use App\Filament\Resources\BannerSettings\BannerSettingResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateBannerSetting extends CreateRecord
{
    protected static string $resource = BannerSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->hidden();
    }
}
