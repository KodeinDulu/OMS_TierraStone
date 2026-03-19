<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class FinishingTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Finishing')
                ->description('Data jenis finishing yang tersedia untuk pemesanan.')
                ->icon('heroicon-o-paint-brush')
                ->iconColor('primary')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Finishing')
                        ->required()
                        ->placeholder('Contoh: Poles, Bakar, Sandblast...')
                        ->prefixIcon('heroicon-o-tag')
                        ->columnSpanFull(),

                    Toggle::make('is_available')
                        ->label('Tersedia untuk Pemesanan')
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
