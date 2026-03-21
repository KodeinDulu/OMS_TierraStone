<?php

/**
 * ─────────────────────────────────────────────────────────────
 * INVOICE DOWNLOAD ACTION  —  Filament v4 compatible
 * ─────────────────────────────────────────────────────────────
 *
 * Taruh file ini di:
 *   app/Filament/Sales/Resources/Orders/Actions/InvoiceDownloadAction.php
 *
 * ── PENGGUNAAN ───────────────────────────────────────────────
 *
 * A) Di Table actions (OrderResource::table):
 *
 *   use App\Filament\Sales\Resources\Orders\Actions\InvoiceDownloadAction;
 *
 *   ->actions([
 *       Tables\Actions\EditAction::make(),
 *       InvoiceDownloadAction::table(),
 *   ])
 *
 * B) Di header page Edit/View:
 *
 *   use App\Filament\Sales\Resources\Orders\Actions\InvoiceDownloadAction;
 *
 *   protected function getHeaderActions(): array
 *   {
 *       return [
 *           InvoiceDownloadAction::header($this->record),
 *       ];
 *   }
 *
 * ─────────────────────────────────────────────────────────────
 * SETUP CHECKLIST
 * ─────────────────────────────────────────────────────────────
 * 1. Install DomPDF:
 *      composer require barryvdh/laravel-dompdf
 *
 * 2. Blade template di:
 *      resources/views/invoices/order.blade.php
 *
 * 3. InvoiceService di:
 *      app/Services/InvoiceService.php
 * ─────────────────────────────────────────────────────────────
 */

namespace App\Filament\Sales\Resources\Orders\Actions;

use App\Models\Order;
use App\Services\InvoiceService;

// Filament v4 — Actions hidup di filament/actions, bukan filament/tables
use Filament\Actions\Action;

class InvoiceDownloadAction
{
    /**
     * Untuk dipakai di table()->actions([...])
     * Menggunakan Filament\Tables\Actions\Action (wrapper tipis).
     */
    public static function table(): \Filament\Tables\Actions\Action
    {
        return \Filament\Tables\Actions\Action::make('download_invoice')
            ->label('Invoice')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('info')
            ->tooltip('Unduh invoice PDF')
            ->action(function (Order $record) {
                return self::generateDownload($record);
            });
    }

    /**
     * Untuk dipakai di getHeaderActions() pada halaman Edit/View.
     * Menggunakan Filament\Actions\Action.
     */
    public static function header(?Order $record = null): Action
    {
        return Action::make('download_invoice')
            ->label('Download Invoice')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('info')
            ->tooltip('Unduh invoice PDF pesanan ini')
            ->action(function () use ($record) {
                $target = $record ?? request()->route('record');
                return self::generateDownload($target);
            });
    }

    private static function generateDownload(Order $record): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $service  = app(InvoiceService::class);
        $filename = 'Invoice-' . $record->order_code . '.pdf';

        return response()->streamDownload(
            function () use ($service, $record) {
                echo $service->stream($record)->getContent();
            },
            $filename,
            ['Content-Type' => 'application/pdf']
        );
    }
}
