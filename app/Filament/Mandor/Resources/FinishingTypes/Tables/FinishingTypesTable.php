<?php

namespace App\Filament\Mandor\Resources\FinishingTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Notifications\Notification;

class FinishingTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Finishing')->searchable(),
                IconColumn::make('is_available')->label('Tersedia')->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_available')->label('Ketersediaan'),

            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
