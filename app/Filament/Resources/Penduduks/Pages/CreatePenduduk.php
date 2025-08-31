<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreatePenduduk extends CreateRecord
{
    protected static string $resource = PendudukResource::class;


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
