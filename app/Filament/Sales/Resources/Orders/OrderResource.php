<?php

namespace App\Filament\Sales\Resources\Orders;

use App\Filament\Sales\Resources\Orders\Pages\CreateOrder;
use App\Filament\Sales\Resources\Orders\Pages\EditOrder;
use App\Filament\Sales\Resources\Orders\Pages\ListOrders;
use App\Filament\Sales\Resources\Orders\Schemas\OrderForm;
use App\Filament\Sales\Resources\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationLabel = 'Orders';
    protected static BackedEnum|String|null $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery();
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('sales');
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
