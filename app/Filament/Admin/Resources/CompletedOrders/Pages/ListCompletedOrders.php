<?php

namespace App\Filament\Admin\Resources\CompletedOrders\Pages;

use App\Filament\Admin\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompletedOrders extends ListRecords
{
    protected static string $resource = CompletedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
