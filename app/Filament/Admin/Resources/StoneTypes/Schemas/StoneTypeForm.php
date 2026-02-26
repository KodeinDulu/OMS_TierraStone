<?php

namespace App\Filament\Admin\Resources\StoneTypes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class StoneTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Jenis Batu')
                ->required(),

            Toggle::make('is_available')
                ->label('Tersedia')
                ->default(true),
        ]);
    }
}
