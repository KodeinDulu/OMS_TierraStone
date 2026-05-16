<?php

namespace App\Filament\Admin\Resources\CompletedOrders;

use App\Filament\Admin\Resources\CompletedOrders\Pages\EditCompletedOrder;
use App\Filament\Admin\Resources\CompletedOrders\Pages\ListCompletedOrders;
use App\Filament\Admin\Resources\CompletedOrders\Schemas\CompletedOrderForm;
use App\Filament\Admin\Resources\CompletedOrders\Tables\CompletedOrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CompletedOrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationLabel = 'Completed Orders';
    protected static ?string $pluralLabel = 'Completed Orders';
    protected static BackedEnum|String|null $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $slug = 'completed-orders'; // penting! beda slug dari OrderResource

    public static function canCreate(): bool { return false; }
    public static function canDelete($record): bool { return false; }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('status', ['done', 'rejected']);
    }

    public static function form(Schema $schema): Schema
    {
        return CompletedOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompletedOrdersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompletedOrders::route('/'),
            'edit'  => EditCompletedOrder::route('/{record}/edit'),
        ];
    }
}
