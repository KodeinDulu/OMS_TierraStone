<?php

namespace App\Filament\Sales\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

class OrderForm
{
    /**
     * Dummy stone options — key = integer ID sesuai urutan insert di DB.
     * Ganti dengan StoneType::pluck('name','id') kalau model sudah siap.
     */
    private static function stoneOptions(): array
    {
        try {
            // Coba query DB dulu
            return \App\Models\StoneType::where('is_available', true)
                ->pluck('name', 'id')
                ->toArray();
        } catch (\Throwable) {
            // Fallback: integer key dummy supaya tidak crash saat DB kosong/model belum ada
            return [
                1 => 'Marmer Premium',
                2 => 'Granit Alam',
                3 => 'Batu Landscape',
                4 => 'Andesit',
                5 => 'Palimanan',
                6 => 'Batu Candi',
                7 => 'Batu Templek',
                8 => 'Paras Jogja',
            ];
        }
    }

    /**
     * Finishing options — nilai string, disimpan langsung ke kolom finishing.
     * Ganti dengan FinishingType::pluck('name','name') kalau model sudah siap.
     */
    private static function finishingOptions(): array
    {
        try {
            return \App\Models\FinishingType::where('is_available', true)
                ->pluck('name', 'name')
                ->toArray();
        } catch (\Throwable) {
            return [
                'Bakar'       => 'Bakar',
                'Bush Hammer' => 'Bush Hammer',
                'Poles'       => 'Poles',
                'Tekstur'     => 'Tekstur',
                'Sandblast'   => 'Sandblast',
                'Alur'        => 'Alur',
                'Natural'     => 'Natural',
            ];
        }
    }

    public static function configure(Schema $schema): Schema
    {
        $isMandor = fn() => auth()->user()->hasRole('mandor');

        return $schema
            ->components([

                // ── INFORMASI PESANAN ─────────────────────────────────────
                Section::make('Informasi Pesanan')
                    ->description('Kode otomatis dibuat oleh sistem.')
                    ->icon('heroicon-o-document-text')
                    ->iconColor('primary')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('order_code')
                                ->label('Kode Pesanan')
                                ->disabled()
                                ->prefixIcon('heroicon-o-hashtag')
                                ->extraInputAttributes([
                                    'class' => 'font-mono font-bold tracking-widest',
                                ])
                                ->placeholder('ORD-XXXXXXXX'),

                            Select::make('status')
                                ->label('Status Pesanan')
                                ->options([
                                    'pending'     => 'Pending',
                                    'on_hold'     => 'On Hold',
                                    'on_progress' => 'On Progress',
                                    'finished'    => 'Finished',
                                    'rejected'    => 'Rejected',
                                ])
                                ->native(false)
                                ->prefixIcon('heroicon-o-arrow-path')
                                ->required(),
                        ]),
                    ]),

                // ── DATA PELANGGAN ────────────────────────────────────────
                Section::make('Data Pelanggan')
                    ->description('Informasi kontak pemesan.')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('info')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('customer_name')
                                ->label('Nama Pelanggan')
                                ->required()
                                ->prefixIcon('heroicon-o-user')
                                ->placeholder('Nama lengkap pelanggan')
                                ->disabled($isMandor),

                            TextInput::make('customer_phone')
                                ->label('No. Telepon / WhatsApp')
                                ->prefixIcon('heroicon-o-phone')
                                ->prefix('+62')
                                ->tel()
                                ->placeholder('81234567890')
                                ->disabled($isMandor),

                            TextInput::make('customer_email')
                                ->label('Email')
                                ->email()
                                ->prefixIcon('heroicon-o-envelope')
                                ->placeholder('email@domain.com')
                                ->columnSpan(2)
                                ->disabled($isMandor),
                        ]),
                    ]),

                // ── RINCIAN ITEM ──────────────────────────────────────────
                Section::make('Rincian Item Pesanan')
                    ->description('Tambah satu atau beberapa jenis batu dalam satu pesanan.')
                    ->icon('heroicon-o-cube')
                    ->iconColor('warning')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->label('')
                            ->addActionLabel('+ Tambah Item')
                            ->itemLabel(function (array $state): ?string {
                                $stoneId = $state['stone_type_id'] ?? null;
                                if (!$stoneId) return '🪨 Item Baru';
                                $options = self::stoneOptions();
                                return '🪨 ' . ($options[$stoneId] ?? 'Item Baru');
                            })
                            ->collapsible()
                            ->cloneable()
                            ->reorderable()
                            ->defaultItems(1)
                            ->schema([
                                Select::make('stone_type_id')
                                    ->label('Jenis Batu')
                                    ->options(fn() => self::stoneOptions())
                                    ->searchable()
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-sparkles')
                                    ->required()
                                    ->live()
                                    ->columnSpanFull(),

                                Select::make('finishing')
                                    ->label('Finishing')
                                    ->options(fn() => self::finishingOptions())
                                    ->searchable()
                                    ->native(false)
                                    ->prefixIcon('heroicon-o-paint-brush')
                                    ->createOptionForm([
                                        TextInput::make('finishing')
                                            ->label('Nama Finishing Baru')
                                            ->required()
                                            ->placeholder('Contoh: Ukir'),
                                    ])
                                    ->createOptionUsing(fn(array $data): string => $data['finishing'])
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('width')
                                    ->label('Lebar (cm)')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-arrows-right-left')
                                    ->suffix('cm')
                                    ->minValue(1),

                                TextInput::make('height')
                                    ->label('Tinggi (cm)')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->suffix('cm')
                                    ->minValue(1),

                                TextInput::make('quantity')
                                    ->label('Jumlah (m²)')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-calculator')
                                    ->suffix('m²')
                                    ->minValue(5)
                                    ->helperText('Minimum order 5 m²'),

                                TextInput::make('unit_price')
                                    ->label('Harga Satuan (Rp)')
                                    ->numeric()
                                    ->prefixIcon('heroicon-o-banknotes')
                                    ->prefix('Rp')
                                    ->placeholder('0')
                                    ->helperText('Opsional — untuk kalkulasi invoice'),
                            ])
                            ->columns(2)
                            ->required()
                            ->disabled($isMandor),
                    ]),

                // ── CATATAN ───────────────────────────────────────────────
                Section::make('Catatan')
                    ->description('Permintaan khusus, warna, motif, atau instruksi lainnya.')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->iconColor('gray')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Textarea::make('notes')
                            ->label('')
                            ->rows(4)
                            ->placeholder('Contoh: Warna dominan abu-abu, permukaan tidak terlalu kasar...')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
