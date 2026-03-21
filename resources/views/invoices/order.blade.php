<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice {{ $order->order_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 50px 60px;
            size: A4 portrait;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            font-size: 10px;
            color: #1a1a1a;
            background: #fff;
            line-height: 1.5;
        }

        /* ── HEADER ── */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 32px;
            padding-bottom: 16px;
            border-bottom: 1px solid #ddd;
        }

        .header-left {
            display: table-cell;
            vertical-align: top;
            width: 60%;
        }

        .header-right {
            display: table-cell;
            vertical-align: top;
            text-align: right;
            width: 40%;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 12px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .company-info {
            font-size: 9px;
            color: #555;
            line-height: 1.7;
            margin-top: 3px;
        }

        .company-contact {
            font-size: 9px;
            color: #555;
            line-height: 1.7;
            text-align: right;
        }

        .logo-text {
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 0.08em;
            color: #1a8fc4;
        }

        .logo-text-sub {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: #1a8fc4;
        }

        /* ── BILL TO + INVOICE META ── */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 24px;
        }

        .info-left {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .info-right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .info-label {
            font-size: 9px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 10px;
            color: #333;
            line-height: 1.7;
        }

        .info-value strong {
            font-weight: 700;
            color: #1a1a1a;
        }

        .meta-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 3px 0;
            font-size: 10px;
            vertical-align: top;
        }

        .meta-table .meta-label {
            text-align: right;
            color: #555;
            padding-right: 10px;
            width: 50%;
        }

        .meta-table .meta-sep {
            width: 10px;
            text-align: center;
            color: #555;
        }

        .meta-table .meta-val {
            text-align: right;
            font-weight: 600;
            color: #1a1a1a;
        }

        /* ── ITEMS TABLE ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .items-table thead tr {
            background: #f0f0ee;
        }

        .items-table th {
            padding: 8px 10px;
            font-size: 8.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #1a1a1a;
            text-align: left;
            border-bottom: 1.5px solid #1a1a1a;
            border-top: 1.5px solid #1a1a1a;
        }

        .items-table th.r {
            text-align: right;
        }

        .items-table th.c {
            text-align: center;
        }

        .items-table td {
            padding: 9px 10px;
            font-size: 10px;
            color: #333;
            border-bottom: 0.5px solid #ddd;
            vertical-align: top;
        }

        .items-table td.r {
            text-align: right;
        }

        .items-table td.c {
            text-align: center;
        }

        .items-table td.bold {
            font-weight: 600;
            color: #1a1a1a;
        }

        /* ── TOTALS ── */
        .totals-row {
            display: table;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 28px;
        }

        .totals-left {
            display: table-cell;
            vertical-align: top;
            width: 52%;
        }

        .totals-right {
            display: table-cell;
            vertical-align: top;
            width: 48%;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 5px 10px;
            font-size: 10px;
        }

        .totals-table .t-label {
            text-align: right;
            color: #555;
            font-weight: 500;
        }

        .totals-table .t-sep {
            width: 10px;
            text-align: center;
            color: #555;
        }

        .totals-table .t-val {
            text-align: right;
            font-weight: 600;
            color: #1a1a1a;
        }

        .totals-table tr.total-final td {
            padding-top: 8px;
            font-weight: 700;
            font-style: italic;
            border-top: 1px solid #ccc;
        }

        .totals-table tr.total-final .t-label {
            color: #1a1a1a;
            font-weight: 700;
            font-style: italic;
        }

        /* ── NOTES ── */
        .notes-section {
            margin-bottom: 24px;
        }

        .notes-title {
            font-size: 10px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .notes-text {
            font-size: 9px;
            color: #555;
            line-height: 1.8;
            padding-left: 18px;
        }

        /* ── BOTTOM: BANK + SIGNATURE ── */
        .bottom-row {
            display: table;
            width: 100%;
            margin-top: 24px;
        }

        .bottom-left {
            display: table-cell;
            vertical-align: top;
            width: 55%;
        }

        .bottom-right {
            display: table-cell;
            vertical-align: top;
            width: 45%;
            text-align: right;
        }

        .bank-title {
            font-size: 10px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
            text-decoration: underline;
        }

        .bank-box {
            border: 1px solid #1a1a1a;
            padding: 10px 14px;
            display: inline-block;
        }

        .bank-box p {
            font-size: 10px;
            color: #1a1a1a;
            line-height: 1.7;
        }

        .bank-box p.bank-name {
            font-weight: 700;
        }

        .signature-block {
            text-align: center;
            display: inline-block;
        }

        .sig-label {
            font-size: 10px;
            color: #555;
            margin-bottom: 4px;
        }

        .sig-stamp {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 0.06em;
            color: #1a8fc4;
            margin: 24px 0 4px;
        }

        .sig-stamp-sub {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #1a8fc4;
        }

        .dim {
            color: #999;
        }
    </style>
</head>

<body>

    @php
    $freight = $order->freight ?? 0;
    $grandTotal = $subtotal + $freight;
    @endphp

    {{-- ── HEADER ── --}}
    <div class="header">
        <div class="header-left">
            <div class="invoice-title">INVOICE</div>
            <div class="company-name">Tierra Stone Indonesia</div>
            <div class="company-info">
                Jalan Magelang Km 15 belakang SPBU Medari<br>
                Sleman, Yogyakarta
            </div>
        </div>
        <div class="header-right">
            <div class="company-contact">
                +6289683000050<br>
                tierrastone.id@gmail.com<br>
                tierrastone.com/id
            </div>
            <div style="margin-top: 8px;">
                <span class="logo-text">TIERRA</span>
                <span class="logo-text-sub">STONE</span>
            </div>
        </div>
    </div>

    {{-- ── BILL TO + META ── --}}
    <div class="info-row">
        <div class="info-left">
            <div class="info-label">Bill To:</div>
            <div class="info-value">
                <strong>{{ $order->customer_name }}</strong><br>
                @if($order->customer_phone)
                +62{{ $order->customer_phone }}<br>
                @endif
                @if($order->customer_email)
                {{ $order->customer_email }}
                @endif
            </div>
        </div>
        <div class="info-right">
            <table class="meta-table">
                <tr>
                    <td class="meta-label">Invoice No.</td>
                    <td class="meta-sep">:</td>
                    <td class="meta-val">{{ $order->order_code }}</td>
                </tr>
                <tr>
                    <td class="meta-label">Invoice Date</td>
                    <td class="meta-sep">:</td>
                    <td class="meta-val">{{ $date }}</td>
                </tr>
                <tr>
                    <td class="meta-label">Status</td>
                    <td class="meta-sep">:</td>
                    <td class="meta-val">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── ITEMS TABLE ── --}}
    <table class="items-table">
        <thead>
            <tr>
                <th style="width:4%">#</th>
                <th style="width:18%">Description</th>
                <th style="width:11%">Finishing</th>
                <th class="c" style="width:10%">Size</th>
                <th class="c" style="width:9%">Thickness</th>
                <th class="r" style="width:9%">Qty (Pcs)</th>
                <th class="r" style="width:10%">Qty (sqm)</th>
                <th class="r" style="width:13%">Price</th>
                <th class="r" style="width:16%">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            @php
            $unitPrice = $item->unit_price ?? 0;
            $pcs = $item->quantity_pcs ?? 0;
            $sqm = $item->quantity_sqm ?? 0;
            $lineTotal = $unitPrice * $sqm;
            $stoneName = $item->stoneType?->name ?? ('Item #' . ($i + 1));
            $size = ($item->width && $item->height) ? $item->width . 'x' . $item->height : '—';
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="bold">{{ $stoneName }}</td>
                <td>{{ $item->finishing ?? '—' }}</td>
                <td class="c">{{ $size }}</td>
                <td class="c">{{ $item->thickness ?? '—' }}</td>
                <td class="r">{{ $pcs ? number_format($pcs, 0, ',', '.') : '—' }}</td>
                <td class="r">{{ $sqm ? number_format($sqm, 2, ',', '.') : '—' }}</td>
                <td class="r">
                    @if($unitPrice)
                    Rp{{ number_format($unitPrice, 0, ',', '.') }}
                    @else
                    <span class="dim">—</span>
                    @endif
                </td>
                <td class="r bold">
                    @if($lineTotal)
                    Rp{{ number_format($lineTotal, 0, ',', '.') }}
                    @else
                    <span class="dim">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ── TOTALS + NOTES ── --}}
    <div class="totals-row">
        <div class="totals-left">
            <div class="notes-section">
                <div class="notes-title">Notes:</div>
                <div class="notes-text">
                    1. Tidak termasuk PPN<br>
                    2. Tidak dapat di retur, kecuali ukuran tidak presisi/tidak dapat dipasang dengan baik
                    @if($order->notes)
                    <br>3. {{ $order->notes }}
                    @endif
                </div>
            </div>
        </div>
        <div class="totals-right">
            <table class="totals-table">
                <tr>
                    <td class="t-label">Subtotal</td>
                    <td class="t-sep">:</td>
                    <td class="t-val">
                        @if($subtotal) Rp{{ number_format($subtotal, 0, ',', '.') }}
                        @else <span class="dim">—</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="t-label">Freight</td>
                    <td class="t-sep">:</td>
                    <td class="t-val">
                        @if($freight) Rp{{ number_format($freight, 0, ',', '.') }}
                        @else Rp0
                        @endif
                    </td>
                </tr>
                <tr class="total-final">
                    <td class="t-label">Total</td>
                    <td class="t-sep">:</td>
                    <td class="t-val">
                        @if($grandTotal) Rp{{ number_format($grandTotal, 0, ',', '.') }}
                        @else <span class="dim">—</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── BANK + SIGNATURE ── --}}
    <div class="bottom-row">
        <div class="bottom-left">
            <div class="bank-title">Transfer Bank / BG via BCA</div>
            <div class="bank-box">
                <p class="bank-name">BCA</p>
                <p>0373064537</p>
                <p>Khrisna Widya Gunawan</p>
            </div>
        </div>
        <div class="bottom-right">
            <div class="signature-block">
                <div class="sig-label">Best Regards,</div>
                <div class="sig-stamp">TIERRA</div>
                <div class="sig-stamp-sub">STONE</div>
            </div>
        </div>
    </div>

</body>

</html>