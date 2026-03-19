<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

use App\Models\StoneType;
use App\Models\FinishingType;

class OrderForm
{
    private static function stoneOptions(): array
    {
        return StoneType::where('is_available', true)
            ->pluck('name', 'id')
            ->toArray();
    }

    private static function finishingOptions(): array
    {
        return FinishingType::where('is_available', true)
            ->pluck('name', 'name')
            ->toArray();
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
                                    'pending'          => 'Pending',
                                    'production'       => 'Production',
                                    'on_progress'      => 'On Progress',
                                    'ready_to_deliver' => 'Ready to Deliver',
                                    'rejected'         => 'Rejected',
                                    'done'             => 'Done',
                                ])
                                ->default('pending')
                                ->native(false)
                                ->prefixIcon('heroicon-o-arrow-path')
                                ->required(),

                            Select::make('production_status')
                                ->label('Status Pengerjaan')
                                ->options([
                                    'produksi'          => 'Produksi',
                                    'klasifikasi_besar' => 'Klasifikasi Besar',
                                    'klasifikasi_sedang'=> 'Klasifikasi Sedang',
                                    'klasifikasi_kecil' => 'Klasifikasi Kecil',
                                    'finishing'         => 'Finishing',
                                ])
                                ->nullable()
                                ->prefixIcon('heroicon-o-wrench')
                                ->native(false),

                            TextInput::make('freight')
                                ->label('Ongkos Kirim')
                                ->numeric()
                                ->required()
                                ->default(0)
                                ->prefixIcon('heroicon-o-truck')
                                ->prefix('Rp')
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
                                    ->createOptionUsing(fn(array $data): string => $data['finishing'])
                                    ->nullable()
                                    ->columnSpanFull(),

                                TextInput::make('width')
                                    ->label('Lebar')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-arrows-right-left')
                                    ->placeholder('0,0'),

                                TextInput::make('height')
                                    ->label('Tinggi')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->placeholder('0,0'),

                                TextInput::make('thickness')
                                    ->label('Ketebalan')
                                    ->numeric()
                                    ->required()
                                    ->placeholder('0,0')
                                    ->prefixIcon('heroicon-o-arrows-up-down'),

                                TextInput::make('quantity_pcs')
                                    ->label('Jumlah (pcs)')
                                    ->numeric()
                                    ->required()
                                    ->placeholder('0')
                                    ->prefixIcon('heroicon-o-calculator')
                                    ->minValue(1),

                                TextInput::make('quantity_sqm')
                                    ->label('Jumlah (m²)')
                                    ->numeric()
                                    ->required()
                                    ->prefixIcon('heroicon-o-calculator')
                                    ->placeholder('0,0')
                                    ->suffix('m²'),

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
                    ]),

                // ── CATATAN ───────────────────────────────────────────────
                Section::make('Preferensi Pelanggan')
                    ->description('Referensi khusus, warna, motif, atau instruksi lainnya.')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->iconColor('gray')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan Khusus')
                            ->rows(4)
                            ->placeholder('Contoh: Warna dominan abu-abu, permukaan tidak terlalu kasar...')
                            ->columnSpanFull(),

                        FileUpload::make('reference_image')
                            ->label('Gambar Referensi')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->reorderable()
                            ->disk('public')
                            ->directory('order-references')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal 2MB.')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
