<?php

namespace App\Filament\Sales\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')->searchable()->label('Kode Pesanan'),
                TextColumn::make('customer_name')->searchable()->label('Nama Pelanggan'),
                TextColumn::make('status')->label('Status Pesanan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'          => 'warning',
                        'production'       => 'info',
                        'on_progress'      => 'primary',
                        'ready_to_deliver' => 'success',
                        'rejected'         => 'danger',
                        'done'             => 'gray',
                        default            => 'gray',
                    }),
                TextColumn::make('production_status')
                    ->label('Status Pengerjaan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'produksi'           => 'warning',
                        'klasifikasi_besar'  => 'info',
                        'klasifikasi_sedang' => 'primary',
                        'klasifikasi_kecil'  => 'secondary',
                        'finishing'          => 'success',
                    })
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending'          => 'Pending',
                        'production'       => 'Production',
                        'on_progress'      => 'On Progress',
                        'ready_to_deliver' => 'Ready to Deliver',
                        'rejected'         => 'Rejected',
                        'done'             => 'Done',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
