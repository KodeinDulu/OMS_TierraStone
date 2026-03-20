<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice {{ $order->order_code }}</title>
    <style>
        /* ── RESET & BASE ── */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
            size: A4 portrait;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            font-size: 10px;
            color: #0f1923;
            background: #ffffff;
            line-height: 1.5;
        }

        /* ── HEADER BAND ── */
        .header {
            background: #0f1923;
            padding: 36px 48px 32px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative corner accent */
        .header-accent {
            position: absolute;
            top: 0;
            right: 0;
            width: 220px;
            height: 100%;
            background: linear-gradient(135deg, transparent 40%, rgba(42, 125, 225, 0.18) 100%);
        }

        .header-accent-dot {
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(42, 125, 225, 0.12);
        }

        .header-inner {
            position: relative;
            z-index: 2;
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: bottom;
            width: 55%;
        }

        .header-right {
            display: table-cell;
            vertical-align: top;
            text-align: right;
        }

        .logo-mark {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #ffffff;
        }

        .logo-mark span {
            color: #2a7de1;
        }

        .logo-tagline {
            font-size: 9px;
            color: #8aa0b4;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .invoice-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #2a7de1;
            margin-bottom: 4px;
        }

        .invoice-number {
            font-size: 26px;
            font-weight: 300;
            color: #ffffff;
            letter-spacing: 0.04em;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .invoice-date {
            font-size: 9px;
            color: #8aa0b4;
            margin-top: 3px;
        }

        /* ── STATUS BADGE in header ── */
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-on_hold {
            background: #f1f5f9;
            color: #475569;
        }

        .status-on_progress {
            background: #dbeeff;
            color: #1a60c0;
        }

        .status-finished {
            background: #dcfce7;
            color: #15803d;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* ── BODY ── */
        .body {
            padding: 36px 48px;
        }

        /* ── INFO ROW ── */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 28px;
        }

        .info-block {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding-right: 24px;
        }

        .info-block:last-child {
            padding-right: 0;
            padding-left: 24px;
            text-align: right;
        }

        .info-label {
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #2a7de1;
            margin-bottom: 6px;
            border-bottom: 1px solid #d6e4f0;
            padding-bottom: 4px;
        }

        .info-name {
            font-size: 13px;
            font-weight: 700;
            color: #0f1923;
            margin-bottom: 2px;
        }

        .info-meta {
            font-size: 9.5px;
            color: #4a6278;
            line-height: 1.6;
        }

        .info-code {
            font-size: 11px;
            font-family: 'DejaVu Serif', Georgia, serif;
            font-weight: 400;
            color: #0f1923;
            margin-bottom: 2px;
        }

        /* ── TABLE ── */
        .section-title {
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #2a7de1;
            margin-bottom: 8px;
            display: table;
            width: 100%;
        }

        .section-title-line {
            display: inline-block;
            width: 20px;
            height: 1.5px;
            background: #2a7de1;
            vertical-align: middle;
            margin-right: 8px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        table.items thead tr {
            background: #0f1923;
        }

        table.items thead th {
            padding: 9px 12px;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #8aa0b4;
            text-align: left;
        }

        table.items thead th:last-child {
            text-align: right;
        }

        table.items tbody tr {
            border-bottom: 1px solid #eef5fb;
        }

        table.items tbody tr:nth-child(even) {
            background: #f5f9fd;
        }

        table.items tbody td {
            padding: 10px 12px;
            font-size: 10px;
            color: #2d3f52;
            vertical-align: top;
        }

        table.items tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .item-stone {
            font-weight: 700;
            color: #0f1923;
            font-size: 10.5px;
        }

        .item-finish {
            font-size: 9px;
            color: #8aa0b4;
            margin-top: 2px;
        }

        .item-dim {
            font-size: 9px;
            color: #4a6278;
        }

        /* ── TOTALS ── */
        .totals {
            display: table;
            width: 100%;
            margin-top: 4px;
        }

        .totals-spacer {
            display: table-cell;
            width: 55%;
        }

        .totals-block {
            display: table-cell;
            width: 45%;
        }

        .total-row {
            display: table;
            width: 100%;
            padding: 6px 0;
            border-bottom: 1px solid #eef5fb;
        }

        .total-row:last-child {
            border: none;
        }

        .total-label {
            display: table-cell;
            font-size: 9px;
            color: #8aa0b4;
        }

        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 10px;
            font-weight: 600;
            color: #0f1923;
        }

        .grand-total-row {
            background: #0f1923;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 8px;
            display: table;
            width: 100%;
        }

        .grand-total-label {
            display: table-cell;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #8aa0b4;
        }

        .grand-total-value {
            display: table-cell;
            text-align: right;
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .grand-total-note {
            font-size: 8px;
            color: #8aa0b4;
            text-align: right;
            margin-top: 4px;
        }

        /* ── NOTES SECTION ── */
        .notes-section {
            margin-top: 28px;
            background: #f0f7ff;
            border: 1px solid #dbeeff;
            border-left: 3px solid #2a7de1;
            border-radius: 6px;
            padding: 12px 16px;
        }

        .notes-label {
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #2a7de1;
            margin-bottom: 5px;
        }

        .notes-text {
            font-size: 9.5px;
            color: #4a6278;
            line-height: 1.6;
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 36px;
            padding-top: 16px;
            border-top: 1px solid #d6e4f0;
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            vertical-align: bottom;
        }

        .footer-right {
            display: table-cell;
            text-align: right;
            vertical-align: bottom;
        }

        .footer-brand {
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #2d3f52;
        }

        .footer-brand span {
            color: #2a7de1;
        }

        .footer-meta {
            font-size: 8px;
            color: #8aa0b4;
            margin-top: 3px;
        }

        .footer-stamp {
            font-size: 8px;
            color: #8aa0b4;
            font-style: italic;
        }

        /* ── PAGE BREAK ── */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    {{-- ── HEADER ── --}}
    <div class="header">
        <div class="header-accent"></div>
        <div class="header-accent-dot"></div>
        <div class="header-inner">
            <div class="header-left">
                <div class="logo-mark">TIERRA<span>STONE</span></div>
                <div class="logo-tagline">Natural Stone Supplier</div>
                @php
                $statusLabels = [
                'pending' => 'Pending',
                'on_hold' => 'On Hold',
                'on_progress' => 'On Progress',
                'finished' => 'Selesai',
                'rejected' => 'Dibatalkan',
                ];
                $statusKey = $order->status ?? 'pending';
                @endphp
                <div class="status-badge status-{{ $statusKey }}">
                    {{ $statusLabels[$statusKey] ?? ucfirst($statusKey) }}
                </div>
            </div>
            <div class="header-right">
                <div class="invoice-label">Invoice</div>
                <div class="invoice-number">{{ $order->order_code }}</div>
                <div class="invoice-date">{{ $date }}</div>
            </div>
        </div>
    </div>

    {{-- ── BODY ── --}}
    <div class="body">

        {{-- Info row: customer + order meta --}}
        <div class="info-row">
            <div class="info-block">
                <div class="info-label">Ditagihkan Kepada</div>
                <div class="info-name">{{ $order->customer_name }}</div>
                <div class="info-meta">
                    @if($order->customer_phone)
                    +62{{ $order->customer_phone }}<br>
                    @endif
                    @if($order->customer_email)
                    {{ $order->customer_email }}
                    @endif
                </div>
            </div>
            <div class="info-block">
                <div class="info-label">Detail Invoice</div>
                <div class="info-code">{{ $order->order_code }}</div>
                <div class="info-meta">
                    Tanggal: {{ $date }}<br>
                    Status: {{ $statusLabels[$statusKey] ?? ucfirst($statusKey) }}<br>
                    Total Item: {{ $items->count() }} jenis batu
                </div>
            </div>
        </div>

        {{-- Items table --}}
        <div class="section-title">
            <span class="section-title-line"></span>Rincian Pesanan
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th style="width:4%">#</th>
                    <th style="width:30%">Jenis Batu &amp; Finishing</th>
                    <th style="width:20%">Dimensi</th>
                    <th style="width:12%">Jumlah</th>
                    <th style="width:17%">Harga Satuan</th>
                    <th style="width:17%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $i => $item)
                @php
                $unitPrice = $item->unit_price ?? 0;
                $qty = $item->quantity ?? 0;
                $lineTotal = $unitPrice * $qty;
                $stoneName = $item->stoneType?->name ?? ('Item #' . ($i + 1));
                @endphp
                <tr>
                    <td style="color:#8aa0b4">{{ $i + 1 }}</td>
                    <td>
                        <div class="item-stone">{{ $stoneName }}</div>
                        @if($item->finishing)
                        <div class="item-finish">✦ {{ $item->finishing }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="item-dim">
                            @if($item->width && $item->height)
                            {{ $item->width }} × {{ $item->height }} cm
                            @else
                            —
                            @endif
                        </div>
                    </td>
                    <td>{{ number_format($qty, 0, ',', '.') }} m²</td>
                    <td>
                        @if($unitPrice)
                        Rp {{ number_format($unitPrice, 0, ',', '.') }}
                        @else
                        <span style="color:#b0c4d8">Belum ditetapkan</span>
                        @endif
                    </td>
                    <td>
                        @if($lineTotal)
                        Rp {{ number_format($lineTotal, 0, ',', '.') }}
                        @else
                        —
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Totals --}}
        <div class="totals">
            <div class="totals-spacer"></div>
            <div class="totals-block">
                <div class="total-row">
                    <div class="total-label">Subtotal</div>
                    <div class="total-value">
                        @if($subtotal)
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                        @else
                        <span style="color:#b0c4d8; font-weight:400">Harga belum ditetapkan</span>
                        @endif
                    </div>
                </div>
                <div class="total-row">
                    <div class="total-label">Pajak (PPN 11%)</div>
                    <div class="total-value">
                        @if($subtotal)
                        Rp {{ number_format($subtotal * 0.11, 0, ',', '.') }}
                        @else
                        —
                        @endif
                    </div>
                </div>
                <div class="grand-total-row">
                    <div class="grand-total-label">Total</div>
                    <div class="grand-total-value">
                        @if($subtotal)
                        Rp {{ number_format($subtotal * 1.11, 0, ',', '.') }}
                        @else
                        <span style="font-size:11px; font-weight:400; color:#8aa0b4">Menunggu penetapan harga</span>
                        @endif
                    </div>
                </div>
                @if($subtotal)
                <div class="grand-total-note">*Sudah termasuk PPN 11%</div>
                @endif
            </div>
        </div>

        {{-- Notes --}}
        @if($order->notes)
        <div class="notes-section">
            <div class="notes-label">Catatan</div>
            <div class="notes-text">{{ $order->notes }}</div>
        </div>
        @endif

        {{-- Footer --}}
        <div class="footer">
            <div class="footer-left">
                <div class="footer-brand">TIERRA<span>STONE</span></div>
                <div class="footer-meta">
                    Dokumen ini dibuat otomatis oleh sistem TierraStone OMS.<br>
                    Dicetak pada {{ $date }}
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-stamp">
                    Sah tanpa tanda tangan apabila<br>
                    diterbitkan oleh sistem.
                </div>
            </div>
        </div>

    </div>
</body>

</html>