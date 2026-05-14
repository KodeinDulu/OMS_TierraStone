<?php

namespace App\Filament\Mandor\Resources\CompletedOrders\Pages;

use App\Filament\Mandor\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompletedOrder extends ViewRecord
{
    protected static string $resource = CompletedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
