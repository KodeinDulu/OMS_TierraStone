<?php

namespace App\Filament\Admin\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;

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
                        'pending'          => 'warning',
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
                TextColumn::make('updatedBy.name')->label('Updated By')->default('-'),
                TextColumn::make('created_at')->dateTime(),
            ])

            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        'pending'          => 'Pending',
                        'on_progress'      => 'On Progress',
                        'ready_to_deliver' => 'Ready to Deliver',
                        'rejected'         => 'Rejected',
                        'done'             => 'Done',
                    ]),
                SelectFilter::make('date_range')
                    ->label('Rentang Waktu')
                    ->options([
                        'last_week'    => 'Last Week',
                        'last_month'   => 'Last Month',
                        'last_3_months' => 'Last 3 Months',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match($data['value']) {
                            'last_week'     => $query->where('created_at', '>=', now()->subWeek()),
                            'last_month'    => $query->where('created_at', '>=', now()->subMonth()),
                            'last_3_months' => $query->where('created_at', '>=', now()->subMonths(3)),
                            default         => $query,
                        };
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
