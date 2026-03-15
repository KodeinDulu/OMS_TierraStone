<?php

namespace App\Filament\Admin\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')->searchable()->label('Kode Pesanan'),
                TextColumn::make('customer_name')->searchable()->label('Nama Pelanggan'),
                TextColumn::make('sales.name')->label('Nama Sales'),
                TextColumn::make('status')->label('Status Pesanan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'     => 'warning',
                        'on_hold'     => 'danger',
                        'on_progress' => 'primary',
                        'finished'    => 'success',
                        'rejected'    => 'danger',
                        default       => 'secondary',
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
                TextColumn::make('updatedBy.name')->label('Updated By')->default('-'),
                TextColumn::make('created_at')->dateTime(),
            ])

            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        'pending'     => 'Pending',
                        'on_hold'     => 'On Hold',
                        'on_progress' => 'On Progress',
                        'finished'    => 'Finished',
                        'rejected'    => 'Rejected',
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
