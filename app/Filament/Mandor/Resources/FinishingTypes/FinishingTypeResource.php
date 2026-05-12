<?php

namespace App\Filament\Mandor\Resources\FinishingTypes;

use App\Filament\Mandor\Resources\FinishingTypes\Pages\CreateFinishingType;
use App\Filament\Mandor\Resources\FinishingTypes\Pages\EditFinishingType;
use App\Filament\Mandor\Resources\FinishingTypes\Pages\ListFinishingTypes;
use App\Filament\Mandor\Resources\FinishingTypes\Schemas\FinishingTypeForm;
use App\Filament\Mandor\Resources\FinishingTypes\Tables\FinishingTypesTable;
use App\Models\FinishingType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FinishingTypeResource extends Resource
{
    protected static ?string $model = FinishingType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FinishingTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinishingTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinishingTypes::route('/'),
            'edit' => EditFinishingType::route('/{record}/edit'),
        ];
    }
}
