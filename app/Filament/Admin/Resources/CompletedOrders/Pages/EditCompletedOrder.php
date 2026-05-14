<?php

namespace App\Filament\Admin\Resources\CompletedOrders\Pages;

use App\Filament\Admin\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompletedOrder extends EditRecord
{
    protected static string $resource = CompletedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
