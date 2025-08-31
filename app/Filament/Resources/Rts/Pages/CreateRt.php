<?php

namespace App\Filament\Resources\Rts\Pages;

use App\Filament\Resources\Rts\RtResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateRt extends CreateRecord
{
    protected static string $resource = RtResource::class;

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
