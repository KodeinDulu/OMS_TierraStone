<?php

namespace App\Filament\Sales\Resources\CompletedOrders;


use App\Filament\Sales\Resources\CompletedOrders\Pages\ListCompletedOrders;
use App\Filament\Sales\Resources\CompletedOrders\Schemas\CompletedOrderForm;
use App\Filament\Sales\Resources\CompletedOrders\Schemas\CompletedOrderInfolist;
use App\Filament\Sales\Resources\CompletedOrders\Schemas\ViewCompletedOrderInfolist;
use App\Filament\Sales\Resources\CompletedOrders\Tables\CompletedOrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompletedOrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = 'Completed Orders';
    protected static ?string $pluralLabel = 'Completed Orders';
    protected static BackedEnum|String|null $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $slug = 'completed-orders'; // penting! beda slug dari OrderResource

    public static function infolist(Schema $schema): Schema
    {
        return CompletedOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompletedOrdersTable::configure($table);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('status', ['done', 'rejected']);
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
            'index' => ListCompletedOrders::route('/'),
        ];
    }

    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }
}
