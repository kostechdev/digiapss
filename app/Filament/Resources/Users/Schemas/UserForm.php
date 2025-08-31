<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('password')->password()->dehydrateStateUsing(fn ($state) => filled($state) ? $state : null)->required(fn (string $operation): bool => $operation === 'create')->dehydrated(fn ($state) => filled($state)),
            Select::make('role')->options([
                'admin' => 'admin',
                'operator' => 'operator',
                'warga' => 'warga',
            ])->default('warga')->required(),
        ]);
    }
}
