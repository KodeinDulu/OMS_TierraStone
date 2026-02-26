<?php

namespace App\Filament\Sales\Resources\Orders\Pages;

use App\Filament\Sales\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    // Auto-assign sales_id before saving
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['sales_id'] = auth()->id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
