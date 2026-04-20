<?php

namespace App\Filament\Sales\Resources\Orders\Pages;

use App\Filament\Sales\Resources\Orders\OrderResource;
use App\Services\InvoiceService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_invoice')
                ->label('Download Invoice')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $order = $this->record;
                    $service = app(InvoiceService::class);
                    $filename = 'Invoice-' . $order->order_code . '.pdf';

                    return response()->streamDownload(
                        function () use ($service, $order) {
                            echo $service->stream($order)->getContent();
                        },
                        $filename,
                        ['Content-Type' => 'application/pdf']
                    );
                }),

            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->updateQuietly(['updated_by' => auth()->id()]);

        $order = $this->record;

        if ($order->wasChanged('status')) {
            $order->updateQuietly([
                'completed_at' => in_array($order->status, ['done', 'rejected'])
                    ? now()
                    : null,
            ]);
        }
    }
}
