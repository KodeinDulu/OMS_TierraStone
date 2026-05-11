<?php

namespace App\Filament\Mandor\Resources\StoneTypes;

use App\Filament\Mandor\Resources\StoneTypes\Pages\CreateStoneType;
use App\Filament\Mandor\Resources\StoneTypes\Pages\EditStoneType;
use App\Filament\Mandor\Resources\StoneTypes\Pages\ListStoneTypes;
use App\Filament\Mandor\Resources\StoneTypes\Schemas\StoneTypeForm;
use App\Filament\Mandor\Resources\StoneTypes\Tables\StoneTypesTable;
use App\Models\StoneType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StoneTypeResource extends Resource
{
    protected static ?string $model = StoneType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StoneTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoneTypesTable::configure($table);
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
            'index' => ListStoneTypes::route('/'),
            'edit' => EditStoneType::route('/{record}/edit'),
        ];
    }
}
