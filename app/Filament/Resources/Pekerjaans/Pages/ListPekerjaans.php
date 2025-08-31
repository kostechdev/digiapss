<?php

namespace App\Filament\Resources\Pekerjaans\Pages;

use App\Filament\Resources\Pekerjaans\PekerjaanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListPekerjaans extends ListRecords
{
    protected static string $resource = PekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getEmptyStateActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
