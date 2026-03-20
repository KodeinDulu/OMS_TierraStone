<?php

namespace App\Filament\Admin\Resources\FinishingTypes;

use App\Filament\Admin\Resources\FinishingTypes\Pages\CreateFinishingType;
use App\Filament\Admin\Resources\FinishingTypes\Pages\EditFinishingType;
use App\Filament\Admin\Resources\FinishingTypes\Pages\ListFinishingTypes;
use App\Filament\Admin\Resources\FinishingTypes\Schemas\FinishingTypeForm;
use App\Filament\Admin\Resources\FinishingTypes\Tables\FinishingTypesTable;
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
            'create' => CreateFinishingType::route('/create'),
            'edit' => EditFinishingType::route('/{record}/edit'),
        ];
    }
}
