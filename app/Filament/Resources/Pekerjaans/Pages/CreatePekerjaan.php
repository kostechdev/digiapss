<?php

namespace App\Filament\Resources\Pekerjaans\Pages;

use App\Filament\Resources\Pekerjaans\PekerjaanResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePekerjaan extends CreateRecord
{
    protected static string $resource = PekerjaanResource::class;

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
