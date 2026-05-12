<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Form Pesanan — TierraStone</title>
    <link rel="icon" type="image/avif" href="{{ asset('images/logos.avif') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300;1,9..40,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ── Variables ───────────────────────────────────────── */
        :root {
            --accent-primary: #8B7355;
            --ink: #111;
            --muted: #888;
            --subtle: #aaa;
            --bg: #f5f5f3;
            --bg-card: #fff;
            --border: #e0ddd8;
            --red: #c0392b;
            --green: #27ae60;
        }

        /* ── Override: min font 12px everywhere ──────────────── */
        * {
            font-size: max(12px, inherit);
        }

        body {
            font-size: 14px;
        }

        /* ══ Align ALL containers to 1100px ══════════════════ */
        .nav-inner,
        .page-header,
        .progress-wrap,
        .main,
        .trust-row,
        footer {
            max-width: 1100px !important;
            padding-left: 32px;
            padding-right: 32px;
        }

        .form-card {
            max-width: 100% !important;
        }

        /* ── Nav refinements ──────────────────────────────────── */
        .nav {
            background: rgba(255, 255, 255, .98) !important;
            border-bottom: 1px solid #e8e5e0 !important;
        }

        .nav-inner {
            height: 60px !important;
        }

        .nav-logo {
            font-size: 20px !important;
            letter-spacing: .03em !important;
        }

        .nav-back {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            font-size: 11px !important;
            letter-spacing: .14em !important;
            font-weight: 500 !important;
            color: #999 !important;
            text-decoration: none !important;
            text-transform: uppercase !important;
            transition: color .2s !important;
            padding: 8px 16px !important;
            border: 1px solid #e0ddd8 !important;
        }

        .nav-back:hover {
            color: #111 !important;
            border-color: #111 !important;
            background: transparent !important;
        }

        /* ── Page header refinements ──────────────────────────── */
        .page-header {
            padding-top: 52px !important;
            padding-bottom: 28px !important;
        }

        .page-header p {
            max-width: 560px !important;
        }

        /* ── Progress wrap ────────────────────────────────────── */
        .progress-wrap {
            padding-bottom: 28px !important;
        }

        /* ── Trust row ────────────────────────────────────────── */
        .trust-row {
            justify-content: flex-start !important;
            gap: 32px !important;
            padding-top: 24px !important;
            padding-bottom: 0 !important;
        }

        /* ── Footer refinements ───────────────────────────────── */
        footer {
            margin-top: 32px !important;
            padding-top: 22px !important;
            padding-bottom: 28px !important;
            border-top: 1px solid #e8e5e0 !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        /* ── Layout helpers ──────────────────────────────────── */
        .form-body {
            padding: 24px 32px;
        }

        .field {
            margin-bottom: 18px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        /* ── Two-column layout for contact section ───────────── */
        .grid-contact {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 600px) {
            .grid-contact {
                grid-template-columns: 1fr;
            }
        }

        /* ── Dimension grid: 3 columns (p, l, tebal) + luas ─── */
        .grid-dim {
            display: grid;
            grid-template-columns: repeat(3, 1fr) 1.2fr;
            gap: 10px;
        }

        @media (max-width: 600px) {
            .grid-dim {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .input-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
            text-align: center;
        }

        /* ── Qty row ──────────────────────────────────────────── */
        .qty-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-row .input {
            max-width: 120px;
        }

        .qty-unit {
            font-size: 13px;
            color: var(--muted);
            white-space: nowrap;
        }

        /* ── Multi-item list ─────────────────────────────────── */
        .items-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 16px;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: var(--bg, #f5f5f3);
            border: 1px solid #e0ddd8;
            border-radius: 6px;
            font-size: 13px;
            color: var(--ink, #111);
            animation: fadeSlideIn .22s ease;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .item-row-num {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--accent-primary, #8B7355);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .item-row-body {
            flex: 1;
            min-width: 0;
        }

        .item-row-name {
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-row-detail {
            font-size: 12px;
            color: var(--muted, #888);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-row-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        .item-btn {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: background .15s, color .15s;
        }

        .item-btn-edit {
            background: #ede9e3;
            color: var(--ink, #111);
        }

        .item-btn-edit:hover {
            background: #ddd8cf;
        }

        .item-btn-del {
            background: #fce8e8;
            color: #c0392b;
        }

        .item-btn-del:hover {
            background: #f5c6c6;
        }

        /* ── Add item button ────────────────────────────────── */
        .btn-add-item {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 11px 16px;
            border: 1.5px dashed #c8c2b8;
            border-radius: 6px;
            background: transparent;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--muted, #888);
            transition: border-color .2s, color .2s, background .2s;
            margin-bottom: 20px;
        }

        .btn-add-item:hover {
            border-color: var(--accent-primary, #8B7355);
            color: var(--accent-primary, #8B7355);
            background: #faf8f5;
        }

        /* ── Item form panel ────────────────────────────────── */
        .item-form-panel {
            border: 1px solid #e0ddd8;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 16px;
            background: #faf8f5;
            animation: fadeSlideIn .22s ease;
        }

        .item-form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .item-form-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink, #111);
        }

        .btn-cancel-item {
            width: 26px;
            height: 26px;
            border: none;
            border-radius: 4px;
            background: #ede9e3;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--ink, #111);
        }

        .btn-cancel-item:hover {
            background: #ddd8cf;
        }

        @media (max-width: 720px) {
            .grid-three {
                grid-template-columns: 1fr !important;
            }
        }

        .btn-save-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            background: var(--accent-primary, #8B7355);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity .15s;
            margin-top: 16px;
        }

        .btn-save-item:hover {
            opacity: .85;
        }

        /* ── Image upload area ──────────────────────────────── */
        .img-upload-area {
            border: 1.5px dashed #c8c2b8;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            min-height: 100px;
            text-align: center;
        }

        .img-upload-area:hover {
            border-color: var(--accent-primary);
            background: #faf8f5;
        }

        .img-upload-area i {
            font-size: 22px;
            color: var(--subtle);
        }

        .img-upload-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }

        .img-upload-sub {
            font-size: 12px;
            color: var(--muted);
        }

        .img-upload-area input[type="file"] {
            display: none;
        }

        /* Preview strip */
        .img-preview-strip {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .img-preview-strip img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--border);
        }

        /* ── Summary items ──────────────────────────────────── */
        .summary-items-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .sum-item-row {
            display: flex;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #ede9e3;
            font-size: 13px;
        }

        .sum-item-row:last-child {
            border-bottom: none;
        }

        .sum-item-num {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--accent-primary, #8B7355);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .sum-item-name {
            font-weight: 600;
            color: var(--ink, #111);
        }

        .sum-item-detail {
            font-size: 12px;
            color: var(--muted, #888);
            margin-top: 2px;
        }

        /* ── Divider spacing ─────────────────────────────────── */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 24px 0;
        }

        /* ── Section head ────────────────────────────────────── */
        .section-head {
            padding: 24px 32px 0;
        }

        .section-head+.form-body {
            padding-top: 16px;
        }

        .step1-col-left .section-head,
        .step1-col-right .section-head {
            padding: 24px 20px 0;
        }

        .step1-col-left .form-body,
        .step1-col-right .form-body {
            padding-left: 20px;
            padding-right: 20px;
        }

        /* ── Items section padding ───────────────────────────── */
        .items-section {
            padding: 0 24px 24px;
        }

        .step1-col-right .items-section {
            padding: 0 20px 24px;
        }

        /* ── Two-column main layout for step 1 ──────────────── */
        .step1-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            align-items: start;
        }

        .step1-col-left {
            border-right: 1px solid var(--border);
            min-width: 0;
        }

        .step1-col-right {
            min-width: 0;
        }

        .step1-contact {
            border-top: 1px solid var(--border);
        }

        @media (max-width: 720px) {
            .step1-cols {
                grid-template-columns: 1fr;
            }

            .step1-col-left {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
        }

        /* ── label-opt ───────────────────────────────────────── */
        .label-opt {
            font-size: 12px;
            color: var(--subtle);
            font-weight: 400;
        }

        /* ── Labels baseline ─────────────────────────────────── */
        .label {
            font-size: 13px;
        }

        /* ── Ensure all inputs/selects/textareas min 12px ────── */
        .input,
        select.input,
        textarea.input {
            font-size: 13px !important;
        }

        .chip {
            font-size: 12px;
        }

        .section-label {
            font-size: 12px;
        }

        /* ── Product card: putih default, coklat saat dipilih ── */
        .prod-card {
            background: #ffffff !important;
        }

        .prod-name {
            color: #111111 !important;
        }

        .prod-sub {
            color: #999999 !important;
        }

        .prod-img {
            background: #f5f5f3 !important;
        }

        .prod-check {
            background: #8B7355 !important;
        }

        .prod-card.selected {
            background: #8B7355 !important;
            border-color: #8B7355 !important;
            box-shadow: 0 0 0 2px #8B7355, 0 8px 24px rgba(0, 0, 0, .08) !important;
        }

        .prod-card.selected .prod-name {
            color: #ffffff !important;
        }

        .prod-card.selected .prod-sub {
            color: rgba(255, 255, 255, .65) !important;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="nav">
        <div class="nav-inner">
            <a href="{{ route('welcome') }}" class="nav-logo">TierraStone</a>
            <a href="{{ route('welcome') }}" class="nav-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="page-header-label">Form Pemesanan</div>
        <h1>Buat Pesanan <em>Baru</em></h1>
        <p>Lengkapi spesifikasi batu dan data kontak Anda. Tim kami akan menghubungi via WhatsApp.</p>
    </div>

    <!-- PROGRESS -->
    <div class="progress-wrap">
        <div class="steps-row">
            <div class="step-item active" id="step-item-1">
                <div class="step-num" id="step-num-1">1</div>
                <span>Spesifikasi</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item" id="step-item-2">
                <div class="step-num" id="step-num-2">2</div>
                <span>Konfirmasi</span>
            </div>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" id="prog-fill" style="width:50%"></div>
        </div>
    </div>

    <!-- MAIN -->
    <main class="main">
        <div class="form-card">

            <!-- ═══ STEP 1 ═══ -->
            <div class="form-step active" id="step-1">

                <!-- ── TWO-COLUMN ROW: material kiri, item kanan ── -->
                <div class="step1-cols">

                    <!-- ══ LEFT: Pilih Material ══ -->
                    <div class="step1-col-left">
                        <div class="section-head">
                            <div class="section-label">01 — Jenis Batu</div>
                            <div class="section-title">Pilih Material</div>
                            <div class="section-desc">Pilih dari kartu atau cari via dropdown untuk pilihan lengkap.</div>
                        </div>

                        <div class="form-body" style="padding-bottom: 0">
                            <div class="product-grid" id="product-list">
                                @forelse($stoneTypes as $stone)
                                <div class="prod-card" data-product="{{ $stone->name }}" onclick="selectProduct(this)">
                                    <div class="prod-check"><i class="fa-solid fa-check"></i></div>
                                    <div class="prod-img">
                                        <img src="{{ $stone->reference_image ? asset('storage/' . $stone->reference_image) : asset('images/stone-default.png') }}" alt="{{ $stone->name }}">
                                    </div>
                                    <div class="prod-info">
                                        <div class="prod-name">{{ $stone->name }}</div>
                                        <div class="prod-sub">{{ $stone->description ?? 'Batu alam' }}</div>
                                    </div>
                                </div>
                                @empty
                                <div style="grid-column: 1 / -1; text-align: center; padding: 32px 0; color: var(--muted);">
                                    <i class="fa-solid fa-cube" style="font-size: 24px; opacity: 0.3; display: block; margin-bottom: 8px;"></i>
                                    Belum ada jenis batu tersedia.
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="form-body" style="padding-top: 12px; padding-bottom: 28px;">
                            <div class="field" style="margin-bottom: 0;">
                                <div class="sel-wrap">
                                    <select id="jenis-batu" class="input" onchange="syncProductFromDropdown(this.value)">
                                        <option value="">Pilih dari daftar lengkap...</option>
                                        @forelse($stoneTypes as $stone)
                                        <option value="{{ $stone->name }}">{{ $stone->name }}</option>
                                        @empty
                                        <option value="" disabled>— Tidak ada data —</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end left col -->

                    <!-- ══ RIGHT: Daftar Item ══ -->
                    <div class="step1-col-right">
                        <div class="section-head">
                            <div class="section-label">02 — Item Pesanan</div>
                            <div class="section-title">Detail Item</div>
                            <div class="section-desc">Tentukan jumlah, dimensi, dan finishing tiap batu.</div>
                        </div>

                        <!-- ── Item list ── -->
                        <div class="items-section" style="margin-top: 16px;">

                            <div class="items-list" id="items-list">
                                <!-- rendered by JS -->
                            </div>

                            <!-- Item form panel -->
                            <div id="item-form-panel" class="item-form-panel" style="display:none">
                                <div class="item-form-header">
                                    <div class="item-form-title" id="item-form-title">Tambah Item</div>
                                    <button class="btn-cancel-item" onclick="cancelItemForm()" title="Batal">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <input type="hidden" id="edit-item-idx" value="">

                                <!-- Jumlah Batu + Finishing side by side -->
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                                    <!-- Jumlah Batu -->
                                    <div class="field">
                                        <label class="label" style="font-size:13px">Jumlah Batu <span class="req">*</span></label>
                                        <div class="qty-row">
                                            <input type="number" id="qty" class="input" placeholder="1" min="1" value="1" style="max-width:120px">
                                            <span class="qty-unit">pcs</span>
                                        </div>
                                    </div>

                                    <!-- Finishing -->
                                    <div class="field">
                                        <label class="label" style="font-size:13px">Finishing <span class="label-opt">(opsional)</span></label>
                                        <div class="chips">
                                            @forelse($finishingTypes as $fin)
                                            <span class="chip" onclick="selectChip(this)" data-val="{{ $fin->name }}">{{ $fin->name }}</span>
                                            @empty
                                            <span style="font-size: 13px; color: var(--muted);">Belum ada pilihan finishing.</span>
                                            @endforelse
                                        </div>
                                        <input type="hidden" id="finishing" value="">
                                    </div>
                                </div>

                                <!-- Dimensi: Panjang, Lebar, Tebal, Luas -->
                                <div class="field">
                                    <label class="label" style="font-size:13px">Dimensi <span class="req">*</span></label>
                                    <div class="grid-dim">
                                        <div>
                                            <input type="number" id="length" class="input" placeholder="100" min="1">
                                            <div class="input-hint">Panjang (cm)</div>
                                        </div>
                                        <div>
                                            <input type="number" id="width" class="input" placeholder="60" min="1">
                                            <div class="input-hint">Lebar (cm)</div>
                                        </div>
                                        <div>
                                            <input type="number" id="thickness" class="input" placeholder="1.2" min="0" step="0.1">
                                            <div class="input-hint">Tebal (cm)</div>
                                        </div>
                                        <div>
                                            <input type="number" id="luas" class="input" placeholder="0.06" min="0" step="0.0001">
                                            <div class="input-hint">Luas (m²) <span class="label-opt">(opsional)</span></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gambar Referensi -->
                                <div class="field">
                                    <label class="label" style="font-size:13px">Gambar Referensi <span class="label-opt">(opsional)</span></label>
                                    <label class="img-upload-area" id="img-upload-label" for="item-images">
                                        <i class="fa-regular fa-image"></i>
                                        <div class="img-upload-label">Klik untuk unggah gambar</div>
                                        <div class="img-upload-sub">JPG, PNG, WEBP — maks. 2MB per file</div>
                                        <input type="file" id="item-images" accept="image/*" multiple onchange="previewImages(this)">
                                    </label>
                                    <div class="img-preview-strip" id="img-preview-strip"></div>
                                </div>

                                <div class="error-box shake" id="item-error">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <span id="item-err-msg"></span>
                                </div>

                                <button class="btn-save-item" onclick="saveItem()" type="button">
                                    <i class="fa-solid fa-check" style="font-size:12px"></i> Simpan Item
                                </button>
                            </div>

                            <button class="btn-add-item" id="btn-add-item" onclick="openItemForm()" type="button">
                                <i class="fa-solid fa-plus" style="font-size:12px"></i> Tambah Item Batu
                            </button>
                        </div>
                        <!-- ── END Item list ── -->

                    </div><!-- end step1-col-right -->
                </div><!-- end step1-cols -->

                <!-- ── Data Pemesan: full width below ── -->
                <div class="step1-contact">

                    <div style="padding: 0 32px;">
                        <hr class="divider" style="margin: 24px 0 0;">
                    </div>

                    <div class="section-head" style="padding-bottom: 16px;">
                        <div class="section-label">03 — Data Pemesan</div>
                        <div class="section-title">Informasi Kontak</div>
                    </div>

                    <div class="form-body" style="padding-top: 0;">
                        <!-- Nama + WA + Alamat: three columns -->
                        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:18px;">
                            <div class="field" style="margin-bottom:0">
                                <label class="label">Nama Lengkap <span class="req">*</span></label>
                                <input type="text" id="nama" class="input" placeholder="Nama lengkap Anda" autocomplete="name">
                            </div>
                            <div class="field" style="margin-bottom:0">
                                <label class="label">No. WhatsApp <span class="req">*</span></label>
                                <div class="phone-wrap">
                                    <div class="phone-prefix">+62</div>
                                    <input type="number" id="phone" class="input" placeholder="81234567890" autocomplete="tel">
                                </div>
                            </div>
                            <div class="field" style="margin-bottom:0">
                                <label class="label">Alamat <span class="req">*</span></label>
                                <input type="text" id="alamat" class="input" placeholder="Jl. Contoh No. 1, Kota..." autocomplete="street-address">
                            </div>
                        </div>



                        <!-- Catatan Umum -->
                        <div class="field">
                            <label class="label">Catatan Umum <span class="label-opt">(opsional)</span></label>
                            <textarea id="catatan" class="input" rows="3"
                                placeholder="Lokasi proyek, instruksi pengiriman, atau informasi lainnya..."
                                style="resize:vertical; min-height:80px; line-height:1.6"></textarea>
                        </div>

                        <div class="error-box shake" id="step1-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span id="s1-msg"></span>
                        </div>

                        <div class="btn-row">
                            <span style="font-size:12px; color:var(--subtle)">
                                <span style="color:var(--red)">*</span> Wajib diisi
                            </span>
                            <button class="btn-primary" onclick="goStep2()" type="button">
                                Review Pesanan <i class="fa-solid fa-arrow-right" style="font-size:12px"></i>
                            </button>
                        </div>
                    </div><!-- end form-body contact -->
                </div><!-- end step1-contact -->
            </div>
            <!-- end step-1 -->

            <!-- ═══ STEP 2 ═══ -->
            <div class="form-step" id="step-2">
                <div class="section-head">
                    <div class="section-label">Konfirmasi</div>
                    <div class="section-title">Periksa Detail</div>
                    <div class="section-desc">Pastikan semua informasi sudah benar sebelum dikirim.</div>
                </div>

                <div class="form-body">
                    <div class="summary-block">
                        <div class="summary-head">Spesifikasi Material</div>
                        <div id="s-items-container" class="summary-items-list"></div>
                    </div>

                    <div class="summary-block">
                        <div class="summary-head">Data Pemesan</div>
                        <div class="sum-row"><span class="sum-lbl">Nama</span><span class="sum-val" id="s-nama">—</span></div>
                        <div class="sum-row"><span class="sum-lbl">WhatsApp</span><span class="sum-val" id="s-phone">—</span></div>
                        <div class="sum-row" id="s-alamat-row"><span class="sum-lbl">Alamat</span><span class="sum-val" id="s-alamat">—</span></div>
                        <div class="sum-row" id="s-catatan-row"><span class="sum-lbl">Catatan</span><span class="sum-val" id="s-catatan">—</span></div>
                    </div>

                    <div class="wa-note">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Pesan WhatsApp sudah terisi otomatis. Klik tombol di bawah dan tinggal kirim.</span>
                    </div>

                    <button class="btn-wa" onclick="submitOrder()" type="button">
                        <i class="fa-brands fa-whatsapp"></i> Kirim via WhatsApp
                    </button>

                    <div class="btn-row" style="justify-content:center; border:none; margin-top:12px; padding-top:0">
                        <button class="btn-ghost" onclick="goBack()" type="button">
                            <i class="fa-solid fa-arrow-left" style="font-size:12px"></i> Edit Pesanan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Trust row -->
    <div class="trust-row">
        <div class="trust-item"><i class="fa-solid fa-lock" style="color:var(--green)"></i> Data aman & privat</div>
        <div class="trust-item"><i class="fa-regular fa-clock" style="color:var(--ink)"></i> Respons jam kerja</div>
        <div class="trust-item"><i class="fa-solid fa-truck-fast" style="color:var(--muted)"></i> Kirim seluruh Indonesia</div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-logo">TierraStone</div>
        <div class="footer-copy">&copy; 2026 TierraStone. All rights reserved.</div>
    </footer>

    <script>
        const WA_NUMBER = '6289683000050';
        const STORE_URL = '{{ route("order.store") }}';
        const CSRF_TOKEN = '{{ csrf_token() }}';

        let selectedProduct = '',
            selectedFinishing = '';
        let orderItems = [];

        /* ── Init ─────────────────────────────────────────── */
        window.addEventListener('DOMContentLoaded', () => {
            const p = new URLSearchParams(window.location.search).get('product');
            if (p) {
                const card = document.querySelector(`.prod-card[data-product="${p}"]`);
                if (card) selectProduct(card);
                const dd = document.getElementById('jenis-batu');
                if ([...dd.options].some(o => o.value === p)) dd.value = p;
                else selectedProduct = p;
                openItemForm();
            }
            renderItemList();
        });

        /* ── Product selection ────────────────────────────── */
        function selectProduct(el) {
            document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedProduct = el.dataset.product;
            const dd = document.getElementById('jenis-batu');
            dd.value = [...dd.options].some(o => o.value === selectedProduct) ? selectedProduct : '';
        }

        function syncProductFromDropdown(val) {
            document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
            if (!val) {
                selectedProduct = '';
                return;
            }
            selectedProduct = val;
            const card = document.querySelector(`.prod-card[data-product="${val}"]`);
            if (card) card.classList.add('selected');
        }

        function getProductValue() {
            return selectedProduct;
        }

        /* ── Chip logic ──────────────────────────────────── */
        function selectChip(el) {
            if (el.classList.contains('active')) {
                el.classList.remove('active');
                selectedFinishing = '';
                document.getElementById('finishing').value = '';
                return;
            }
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            selectedFinishing = el.dataset.val;
            document.getElementById('finishing').value = el.dataset.val;
        }

        function getFinishingValue() {
            return document.getElementById('finishing').value;
        }

        /* ── Image preview ───────────────────────────────── */
        function previewImages(input) {
            const strip = document.getElementById('img-preview-strip');
            strip.innerHTML = '';
            Array.from(input.files).forEach(file => {
                const url = URL.createObjectURL(file);
                const img = document.createElement('img');
                img.src = url;
                strip.appendChild(img);
            });
        }

        /* ── Item form open / cancel / save ──────────────── */
        function openItemForm(editIdx) {
            const panel = document.getElementById('item-form-panel');
            const addBtn = document.getElementById('btn-add-item');
            panel.style.display = 'block';
            addBtn.style.display = 'none';

            const title = document.getElementById('item-form-title');
            const idxInput = document.getElementById('edit-item-idx');

            if (editIdx !== undefined) {
                title.textContent = `Edit Item ${editIdx + 1}`;
                idxInput.value = editIdx;
                const it = orderItems[editIdx];

                selectedProduct = it.product;
                document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
                const card = document.querySelector(`.prod-card[data-product="${it.product}"]`);
                const dd = document.getElementById('jenis-batu');
                if (card) {
                    card.classList.add('selected');
                    dd.value = it.product;
                } else {
                    dd.value = it.product;
                }

                document.getElementById('qty').value = it.qty || 1;
                document.getElementById('length').value = it.length;
                document.getElementById('width').value = it.width;
                document.getElementById('thickness').value = it.thickness || '';
                document.getElementById('luas').value = it.luas || '';

                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                document.getElementById('finishing').value = '';
                selectedFinishing = it.finishing || '';
                if (it.finishing) {
                    const chip = document.querySelector(`.chip[data-val="${it.finishing}"]`);
                    if (chip) {
                        chip.classList.add('active');
                        document.getElementById('finishing').value = it.finishing;
                    }
                }

                // Di dalam blok if (editIdx !== undefined), ganti bagian gambar:
                document.getElementById('img-preview-strip').innerHTML = '';
                document.getElementById('item-images').value = '';
                // Tampilkan preview gambar yang sudah ada
                if (it.images && it.images.length > 0) {
                    const strip = document.getElementById('img-preview-strip');
                    it.images.forEach(file => {
                        const url = URL.createObjectURL(file);
                        const img = document.createElement('img');
                        img.src = url;
                        strip.appendChild(img);
                    });
                }
            } else {
                title.textContent = 'Tambah Item';
                idxInput.value = '';
                document.getElementById('qty').value = 1;
                document.getElementById('length').value = '';
                document.getElementById('width').value = '';
                document.getElementById('thickness').value = '';
                document.getElementById('luas').value = '';
                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                document.getElementById('finishing').value = '';
                selectedFinishing = '';
                document.getElementById('img-preview-strip').innerHTML = '';
                document.getElementById('item-images').value = '';
            }

            panel.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }

        function cancelItemForm() {
            document.getElementById('item-form-panel').style.display = 'none';
            document.getElementById('btn-add-item').style.display = 'flex';
        }

        // Ganti fungsi saveItem() — tambah images
        function saveItem() {
            const product = getProductValue();
            if (!product) return showItemErr('Pilih jenis batu terlebih dahulu.');
            const qty = document.getElementById('qty').value.trim();
            if (!qty || parseInt(qty) < 1) return showItemErr('Jumlah batu wajib diisi (minimal 1).');
            const len = document.getElementById('length').value.trim();
            const wid = document.getElementById('width').value.trim();
            if (!len || !wid) return showItemErr('Panjang dan lebar wajib diisi.');

            const fileInput = document.getElementById('item-images');
            const files = fileInput.files ? Array.from(fileInput.files) : [];
            const maxSize = 2 * 1024 * 1024; // 2MB
            const overLimit = files.filter(f => f.size > maxSize);
            if (overLimit.length > 0) {
                const names = overLimit.map(f => f.name).join(', ');
                return showItemErr(`File terlalu besar (maks. 2MB): ${names}`);
            }

            const idxVal = document.getElementById('edit-item-idx').value;
            const existingFiles = (idxVal !== '' && orderItems[parseInt(idxVal)]?.images) ?
                orderItems[parseInt(idxVal)].images : [];

            const item = {
                product,
                qty,
                length: len,
                width: wid,
                thickness: document.getElementById('thickness').value.trim(),
                luas: document.getElementById('luas').value.trim(),
                finishing: getFinishingValue(),
                images: files.length > 0 ? files : existingFiles,
            };

            if (idxVal !== '') orderItems[parseInt(idxVal)] = item;
            else orderItems.push(item);

            renderItemList();
            cancelItemForm();
        }

        function deleteItem(idx) {
            orderItems.splice(idx, 1);
            renderItemList();
        }

        function renderItemList() {
            const list = document.getElementById('items-list');
            list.innerHTML = '';

            if (orderItems.length === 0) {
                list.innerHTML = `<div style="font-size:13px; color:var(--muted); padding:4px 0 8px;">Belum ada item ditambahkan.</div>`;
                return;
            }

            orderItems.forEach((it, idx) => {
                let detail = `${it.qty} buah · ${it.length} × ${it.width} cm`;
                if (it.thickness) detail += `, tebal ${it.thickness} cm`;
                if (it.luas && it.luas !== '') detail += ` · ${it.luas} m²`;
                if (it.finishing) detail += ` · ${it.finishing}`;


                const row = document.createElement('div');
                row.className = 'item-row';
                row.innerHTML = `
                <div class="item-row-num">${idx + 1}</div>
                <div class="item-row-body">
                    <div class="item-row-name">${escHtml(it.product)}</div>
                    <div class="item-row-detail">${escHtml(detail)}</div>
                </div>
                <div class="item-row-actions">
                    <button class="item-btn item-btn-edit" onclick="openItemForm(${idx})" title="Edit item"><i class="fa-solid fa-pen" style="font-size:12px"></i></button>
                    <button class="item-btn item-btn-del"  onclick="deleteItem(${idx})"  title="Hapus item"><i class="fa-solid fa-trash" style="font-size:12px"></i></button>
                </div>`;
                list.appendChild(row);
            });
        }

        function showItemErr(msg) {
            const box = document.getElementById('item-error');
            document.getElementById('item-err-msg').textContent = msg;
            box.classList.add('visible', 'shake');
            setTimeout(() => box.classList.remove('shake'), 350);
            setTimeout(() => box.classList.remove('visible'), 4500);
        }

        function escHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        /* ── Step navigation ─────────────────────────────── */
        function goStep2() {
            if (orderItems.length === 0) return showErr('Tambahkan minimal satu item batu terlebih dahulu.');
            if (!document.getElementById('nama').value.trim()) return showErr('Nama lengkap wajib diisi.');
            const ph = document.getElementById('phone').value.trim();
            if (!ph) return showErr('Nomor WhatsApp wajib diisi.');
            if (!/^\d{8,14}$/.test(ph)) return showErr('Format nomor tidak valid (contoh: 81234567890).');
            if (!document.getElementById('alamat').value.trim()) return showErr('Alamat wajib diisi.');
            fillSummary();
            animStep('step-1', 'step-2', false);
            setSteps(2);
            document.getElementById('prog-fill').style.width = '100%';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function goBack() {
            animStep('step-2', 'step-1', true);
            setSteps(1);
            document.getElementById('prog-fill').style.width = '50%';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function animStep(fromId, toId, isBack) {
            const from = document.getElementById(fromId);
            const to = document.getElementById(toId);
            from.classList.add('anim-out');
            setTimeout(() => {
                from.classList.remove('active', 'anim-out');
                from.style.display = 'none';
                to.style.display = 'block';
                to.classList.add(isBack ? 'anim-in-back' : 'anim-in');
                setTimeout(() => {
                    to.classList.remove('anim-in', 'anim-in-back');
                    to.classList.add('active');
                }, 350);
            }, 180);
        }

        function setSteps(active) {
            const i1 = document.getElementById('step-item-1'),
                i2 = document.getElementById('step-item-2');
            const n1 = document.getElementById('step-num-1'),
                n2 = document.getElementById('step-num-2');
            if (active === 1) {
                i1.className = 'step-item active';
                n1.innerHTML = '1';
                i2.className = 'step-item';
                n2.innerHTML = '2';
            } else {
                i1.className = 'step-item done';
                n1.innerHTML = '<i class="fa-solid fa-check" style="font-size:9px"></i>';
                i2.className = 'step-item active';
                n2.innerHTML = '2';
            }
        }

        function showErr(msg) {
            const box = document.getElementById('step1-error');
            document.getElementById('s1-msg').textContent = msg;
            box.classList.add('visible', 'shake');
            setTimeout(() => box.classList.remove('shake'), 350);
            setTimeout(() => box.classList.remove('visible'), 4500);
        }

        /* ── Fill summary ────────────────────────────────── */
        function fillSummary() {
            const g = id => document.getElementById(id)?.value?.trim() ?? '';

            const container = document.getElementById('s-items-container');
            container.innerHTML = '';
            orderItems.forEach((it, idx) => {
                let dimStr = `${it.qty} buah · ${it.length} × ${it.width} cm`;
                if (it.thickness) dimStr += `, tebal ${it.thickness} cm`;
                if (it.luas && it.luas !== '') dimStr += ` · Luas: ${it.luas} m²`;
                let detail = dimStr;
                if (it.finishing) detail += ` · Finishing: ${it.finishing}`;

                const row = document.createElement('div');
                row.className = 'sum-item-row';
                row.innerHTML = `
                <div class="sum-item-num">${idx + 1}</div>
                <div class="sum-item-body">
                    <div class="sum-item-name">${escHtml(it.product)}</div>
                    <div class="sum-item-detail">${escHtml(detail)}</div>
                </div>`;
                container.appendChild(row);
            });

            const catatan = g('catatan');
            const alamat = g('alamat');
            document.getElementById('s-nama').textContent = g('nama');
            document.getElementById('s-phone').textContent = '+62' + g('phone');
            document.getElementById('s-alamat').textContent = alamat || '—';
            document.getElementById('s-alamat-row').style.display = 'flex';
            document.getElementById('s-catatan').textContent = catatan || '—';
            document.getElementById('s-catatan-row').style.display = 'flex';
        }

        /* ── Submit: simpan ke DB dulu, lalu buka WA ─────── */
        async function submitOrder() {
            const btn = document.querySelector('.btn-wa');
            const g = id => document.getElementById(id)?.value?.trim() ?? '';

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan pesanan...';

            // Buat FormData
            const fd = new FormData();
            fd.append('customer_name', g('nama'));
            fd.append('customer_phone', '+62' + g('phone'));
            fd.append('customer_address', g('alamat'));
            fd.append('notes', g('catatan'));

            // Items sebagai JSON string
            const itemsForPayload = orderItems.map(it => ({
                product: it.product,
                qty: it.qty,
                length: it.length,
                width: it.width,
                thickness: it.thickness,
                luas: it.luas,
                finishing: it.finishing,
            }));
            fd.append('items', JSON.stringify(itemsForPayload));

            // Append semua gambar dari semua item
            orderItems.forEach(it => {
                if (it.images && it.images.length > 0) {
                    it.images.forEach(file => {
                        fd.append('reference_images[]', file);
                    });
                }
            });

            try {
                const res = await fetch(STORE_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                        // Jangan set Content-Type — browser set otomatis dengan boundary
                    },
                    body: fd,
                });

                const data = await res.json();

                if (!res.ok || !data.success) {
                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan pesanan.');
                }

                bukaWhatsApp(data.order_code, g);

            } catch (err) {
                alert('Gagal menyimpan pesanan: ' + err.message);
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-brands fa-whatsapp"></i> Kirim via WhatsApp';
            }
        }

        /* ── Buka WA dengan order_code disertakan ─────────── */
        function bukaWhatsApp(orderCode, g) {
            const note = g('catatan') || '-';
            const alamat = g('alamat') || '-';

            let itemsText = '';
            orderItems.forEach((it, idx) => {
                let dimLine = `${it.length} × ${it.width} cm`;
                if (it.thickness) dimLine += `, tebal ${it.thickness} cm`;
                if (it.luas && it.luas !== '') dimLine += ` (${it.luas} m²)`;
                itemsText += `\n*Item ${idx + 1}:*\n`;
                itemsText += `  Jenis    : ${it.product}\n`;
                itemsText += `  Jumlah   : ${it.qty} buah\n`;
                itemsText += `  Dimensi  : ${dimLine}\n`;
                if (it.finishing) itemsText += `  Finishing: ${it.finishing}\n`;
            });

            const msg =
                `Halo TierraStone!\n\n` +
                `*No. Pesanan: ${orderCode}*\n\n` +
                `Saya ingin memesan batu alam:\n${itemsText}\n` +
                `*Data Pemesan:*\n` +
                `Nama    : ${g('nama')}\n` +
                `No. WA  : +62${g('phone')}\n` +
                `Alamat  : ${alamat}\n\n` +
                `*Catatan Umum:* ${note}\n\n` +
                `Mohon informasi selanjutnya. Terima kasih!`;

            window.open(`https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
        }
    </script>
</body>

</html>