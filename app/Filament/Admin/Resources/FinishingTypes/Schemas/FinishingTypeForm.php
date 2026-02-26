<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class FinishingTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama Finishing')
                ->required(),

            Toggle::make('is_available')
                ->label('Tersedia')
                ->default(true),
        ]);
    }
}
