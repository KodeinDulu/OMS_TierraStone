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
        /* ── Multi-item list ─────────────────────────────── */
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
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--accent-primary, #8B7355);
            color: #fff;
            font-size: 11px;
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

        /* Add item button */
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
            margin-bottom: 16px;
        }

        .btn-add-item:hover {
            border-color: var(--accent-primary, #8B7355);
            color: var(--accent-primary, #8B7355);
            background: #faf8f5;
        }

        /* Item form panel */
        .item-form-panel {
            border: 1px solid #e0ddd8;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 16px;
            background: #faf8f5;
            animation: fadeSlideIn .22s ease;
        }

        .item-form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
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
            margin-top: 14px;
        }

        .btn-save-item:hover {
            opacity: .85;
        }

        /* Summary items table */
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
            font-size: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .sum-item-body {}

        .sum-item-name {
            font-weight: 600;
            color: var(--ink, #111);
        }

        .sum-item-detail {
            font-size: 12px;
            color: var(--muted, #888);
            margin-top: 2px;
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
                            Belum ada jenis batu tersedia. Gunakan dropdown "Lainnya" di bawah.
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="field" style="margin-top:14px">
                    <div class="sel-wrap">
                        <select id="jenis-batu" class="input" onchange="syncProductFromDropdown(this.value)">
                            <option value="">Pilih dari daftar lengkap...</option>
                            @forelse($stoneTypes as $stone)
                            <option value="{{ $stone->name }}">{{ $stone->name }}</option>
                            @empty
                            <option value="" disabled>— Tidak ada data —</option>
                            @endforelse
                            <option value="Lainnya">Lainnya...</option>
                        </select>
                    </div>
                    <div id="jenis-custom-wrap" style="display:none; margin-top:10px">
                        <input type="text" id="jenis-custom" class="input" placeholder="Tulis jenis batu yang Anda inginkan...">
                    </div>
                </div>

                <!-- ── Item list ── -->
                <div class="divider" style="margin:18px 0 14px"></div>

                <div class="section-head" style="margin-bottom:10px">
                    <div class="section-label">Daftar Item Pesanan</div>
                </div>

                <div class="items-list" id="items-list">
                    <!-- rendered by JS -->
                </div>

                <!-- Item form panel -->
                <div id="item-form-panel" class="item-form-panel" style="display:none">
                    <div class="item-form-header">
                        <div class="item-form-title" id="item-form-title">Tambah Item</div>
                        <button class="btn-cancel-item" onclick="cancelItemForm()" title="Batal"><i class="fa-solid fa-xmark"></i></button>
                    </div>

                    <input type="hidden" id="edit-item-idx" value="">

                    <div class="field">
                        <label class="label" style="font-size:12px">Dimensi <span class="req">*</span></label>
                        <div class="grid-3">
                            <div>
                                <input type="number" id="length" class="input" placeholder="Panjang" min="1">
                                <div class="input-hint">Panjang</div>
                            </div>
                            <div>
                                <input type="number" id="width" class="input" placeholder="Lebar" min="1">
                                <div class="input-hint">Lebar</div>
                            </div>
                            <div>
                                <input type="number" id="thickness" class="input" placeholder="1.2" min="0" step="0.1">
                                <div class="input-hint">Tebal</div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" style="font-size:12px">Finishing <span class="label-opt">(opsional)</span></label>
                        <div class="chips">
                            @forelse($finishingTypes as $fin)
                            <span class="chip" onclick="selectChip(this)" data-val="{{ $fin->name }}">{{ $fin->name }}</span>
                            @empty
                            <span style="font-size: 13px; color: var(--muted);">Belum ada pilihan finishing.</span>
                            @endforelse
                            <span class="chip" id="chip-custom-toggle" onclick="selectChip(this)" data-val="__custom__">+ Lainnya</span>
                        </div>
                        <div class="chip-custom-input" id="finishing-custom-wrap">
                            <input type="text" id="finishing-custom" class="input" placeholder="Tulis jenis finishing...">
                        </div>
                        <input type="hidden" id="finishing" value="">
                    </div>

                    <div class="field">
                        <label class="label" style="font-size:12px">Catatan Item <span class="label-opt">(opsional)</span></label>
                        <input type="text" id="item-catatan" class="input" placeholder="Warna, motif, atau keterangan khusus item ini...">
                    </div>

                    <div class="error-box shake" id="item-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span id="item-err-msg"></span>
                    </div>

                    <button class="btn-save-item" onclick="saveItem()" type="button">
                        <i class="fa-solid fa-check" style="font-size:11px"></i> Simpan Item
                    </button>
                </div>

                <button class="btn-add-item" id="btn-add-item" onclick="openItemForm()" type="button">
                    <i class="fa-solid fa-plus" style="font-size:11px"></i> Tambah Item Batu
                </button>

                <!-- ── END Item list ── -->

                <div class="divider"></div>

                <div class="section-head">
                    <div class="section-label">02 — Data Pemesan</div>
                    <div class="section-title">Informasi Kontak</div>
                </div>

                <div class="form-body">
                    <div class="field">
                        <label class="label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="nama" class="input" placeholder="Nama lengkap Anda" autocomplete="name">
                    </div>

                    <div class="grid-2">
                        <div class="field">
                            <label class="label">No. WhatsApp <span class="req">*</span></label>
                            <div class="phone-wrap">
                                <div class="phone-prefix">+62</div>
                                <input type="number" id="phone" class="input" placeholder="81234567890" autocomplete="tel">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email <span class="label-opt">(opsional)</span></label>
                            <input type="email" id="email" class="input" placeholder="email@domain.com" autocomplete="email">
                        </div>
                    </div>

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
                            Review Pesanan <i class="fa-solid fa-arrow-right" style="font-size:10px"></i>
                        </button>
                    </div>
                </div>
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
                        <!-- Items summary rendered by JS here -->
                        <div id="s-items-container" class="summary-items-list"></div>
                    </div>

                    <div class="summary-block">
                        <div class="summary-head">Data Pemesan</div>
                        <div class="sum-row"><span class="sum-lbl">Nama</span><span class="sum-val" id="s-nama">—</span></div>
                        <div class="sum-row"><span class="sum-lbl">WhatsApp</span><span class="sum-val" id="s-phone">—</span></div>
                        <div class="sum-row" id="s-email-row" style="display:none"><span class="sum-lbl">Email</span><span class="sum-val" id="s-email">—</span></div>
                        <div class="sum-row" id="s-catatan-row"><span class="sum-lbl">Catatan</span><span class="sum-val" id="s-catatan">—</span></div>
                    </div>

                    <div class="wa-note">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Pesan WhatsApp sudah terisi otomatis. Klik tombol di bawah dan tinggal kirim.</span>
                    </div>

                    <button class="btn-wa" onclick="kirimWA()" type="button">
                        <i class="fa-brands fa-whatsapp"></i> Kirim via WhatsApp
                    </button>

                    <div class="btn-row" style="justify-content:center; border:none; margin-top:12px; padding-top:0">
                        <button class="btn-ghost" onclick="goBack()" type="button">
                            <i class="fa-solid fa-arrow-left" style="font-size:10px"></i> Edit Pesanan
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

        /* ─── Existing product / finishing state ─────────────── */
        let selectedProduct = '',
            selectedFinishing = '';

        /* ─── NEW: items array ──────────────────────────────── */
        // Each item: { product, length, width, thickness, finishing, catatan }
        let orderItems = [];

        window.addEventListener('DOMContentLoaded', () => {
            const p = new URLSearchParams(window.location.search).get('product');
            if (p) {
                const card = document.querySelector(`.prod-card[data-product="${p}"]`);
                if (card) selectProduct(card);
                const dd = document.getElementById('jenis-batu');
                if ([...dd.options].some(o => o.value === p)) dd.value = p;
                else selectedProduct = p;
                const known = [...dd.options].map(o => o.value);
                if (!known.includes(p) && p) {
                    dd.value = 'Lainnya';
                    showJenisCustom(p);
                }
                // auto-open form for that product
                openItemForm();
            }
            document.getElementById('finishing-custom').addEventListener('input', function() {
                selectedFinishing = this.value.trim();
                document.getElementById('finishing').value = selectedFinishing;
            });
            document.getElementById('jenis-custom').addEventListener('input', function() {
                if (this.value.trim()) selectedProduct = this.value.trim();
            });

            renderItemList();
        });

        /* ─── Existing product selection logic (unchanged) ─── */
        function selectProduct(el) {
            document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedProduct = el.dataset.product;
            const dd = document.getElementById('jenis-batu');
            dd.value = [...dd.options].some(o => o.value === selectedProduct) ? selectedProduct : '';
            hideJenisCustom();
        }

        function syncProductFromDropdown(val) {
            document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
            if (val === 'Lainnya') {
                selectedProduct = '';
                showJenisCustom();
                return;
            }
            hideJenisCustom();
            if (!val) {
                selectedProduct = '';
                return;
            }
            selectedProduct = val;
            const card = document.querySelector(`.prod-card[data-product="${val}"]`);
            if (card) card.classList.add('selected');
        }

        function showJenisCustom(prefill) {
            const wrap = document.getElementById('jenis-custom-wrap');
            const input = document.getElementById('jenis-custom');
            wrap.style.display = 'block';
            if (prefill) input.value = prefill;
            setTimeout(() => input.focus(), 60);
        }

        function hideJenisCustom() {
            document.getElementById('jenis-custom-wrap').style.display = 'none';
            document.getElementById('jenis-custom').value = '';
        }

        function getProductValue() {
            const dd = document.getElementById('jenis-batu');
            if (dd.value === 'Lainnya') return document.getElementById('jenis-custom').value.trim();
            return selectedProduct;
        }

        /* ─── Existing chip logic (unchanged) ──────────────── */
        function selectChip(el) {
            const val = el.dataset.val;
            if (val === '__custom__') {
                const wrap = document.getElementById('finishing-custom-wrap');
                const open = !wrap.classList.contains('visible');
                wrap.classList.toggle('visible', open);
                el.classList.toggle('active', open);
                if (open) {
                    document.querySelectorAll('.chip:not(#chip-custom-toggle)').forEach(c => c.classList.remove('active'));
                    selectedFinishing = '';
                    document.getElementById('finishing').value = '';
                    setTimeout(() => document.getElementById('finishing-custom').focus(), 60);
                } else {
                    selectedFinishing = '';
                    document.getElementById('finishing').value = '';
                    document.getElementById('finishing-custom').value = '';
                }
                return;
            }
            document.getElementById('finishing-custom-wrap').classList.remove('visible');
            document.getElementById('chip-custom-toggle').classList.remove('active');
            document.getElementById('finishing-custom').value = '';
            if (el.classList.contains('active')) {
                el.classList.remove('active');
                selectedFinishing = '';
                document.getElementById('finishing').value = '';
                return;
            }
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            selectedFinishing = val;
            document.getElementById('finishing').value = val;
        }

        function getFinishingValue() {
            return document.getElementById('finishing-custom').value.trim() || document.getElementById('finishing').value;
        }

        /* ─── NEW: Item form open/close/save ─────────────────── */
        function openItemForm(editIdx) {
            const panel = document.getElementById('item-form-panel');
            const addBtn = document.getElementById('btn-add-item');
            panel.style.display = 'block';
            addBtn.style.display = 'none';

            const title = document.getElementById('item-form-title');
            const idxInput = document.getElementById('edit-item-idx');

            if (editIdx !== undefined) {
                // Populate for editing
                title.textContent = `Edit Item ${editIdx + 1}`;
                idxInput.value = editIdx;
                const it = orderItems[editIdx];

                // restore product selection
                selectedProduct = it.product;
                document.querySelectorAll('.prod-card').forEach(c => c.classList.remove('selected'));
                const card = document.querySelector(`.prod-card[data-product="${it.product}"]`);
                const dd = document.getElementById('jenis-batu');
                if (card) {
                    card.classList.add('selected');
                    dd.value = it.product;
                    hideJenisCustom();
                } else {
                    dd.value = 'Lainnya';
                    showJenisCustom(it.product);
                }

                document.getElementById('length').value = it.length;
                document.getElementById('width').value = it.width;
                document.getElementById('thickness').value = it.thickness || '';
                document.getElementById('item-catatan').value = it.catatan || '';

                // restore finishing chips
                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                document.getElementById('finishing-custom-wrap').classList.remove('visible');
                document.getElementById('finishing-custom').value = '';
                document.getElementById('finishing').value = '';
                selectedFinishing = it.finishing || '';
                if (it.finishing) {
                    const chip = document.querySelector(`.chip[data-val="${it.finishing}"]`);
                    if (chip && chip.dataset.val !== '__custom__') {
                        chip.classList.add('active');
                        document.getElementById('finishing').value = it.finishing;
                    } else if (!chip) {
                        document.getElementById('chip-custom-toggle').classList.add('active');
                        document.getElementById('finishing-custom-wrap').classList.add('visible');
                        document.getElementById('finishing-custom').value = it.finishing;
                        document.getElementById('finishing').value = it.finishing;
                    }
                }
            } else {
                title.textContent = 'Tambah Item';
                idxInput.value = '';
                // Clear fields for new item
                document.getElementById('length').value = '';
                document.getElementById('width').value = '';
                document.getElementById('thickness').value = '';
                document.getElementById('item-catatan').value = '';
                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                document.getElementById('finishing-custom-wrap').classList.remove('visible');
                document.getElementById('finishing-custom').value = '';
                document.getElementById('finishing').value = '';
                selectedFinishing = '';
                // keep product selection as-is so user can add multiple stones quickly
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

        function saveItem() {
            const product = getProductValue();
            if (!product) {
                const dd = document.getElementById('jenis-batu');
                return showItemErr(dd.value === 'Lainnya' ? 'Tulis jenis batu yang Anda inginkan.' : 'Pilih jenis batu terlebih dahulu.');
            }
            const len = document.getElementById('length').value.trim();
            const wid = document.getElementById('width').value.trim();
            if (!len || !wid) return showItemErr('Panjang dan lebar wajib diisi.');

            const item = {
                product,
                length: len,
                width: wid,
                thickness: document.getElementById('thickness').value.trim(),
                finishing: getFinishingValue(),
                catatan: document.getElementById('item-catatan').value.trim(),
            };

            const idxVal = document.getElementById('edit-item-idx').value;
            if (idxVal !== '') {
                orderItems[parseInt(idxVal)] = item;
            } else {
                orderItems.push(item);
            }

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
                let detail = `${it.length} × ${it.width}`;
                if (it.thickness) detail += `, tebal ${it.thickness}`;
                if (it.finishing) detail += ` · ${it.finishing}`;
                if (it.catatan) detail += ` · "${it.catatan}"`;

                const row = document.createElement('div');
                row.className = 'item-row';
                row.innerHTML = `
                    <div class="item-row-num">${idx + 1}</div>
                    <div class="item-row-body">
                        <div class="item-row-name">${escHtml(it.product)}</div>
                        <div class="item-row-detail">${escHtml(detail)}</div>
                    </div>
                    <div class="item-row-actions">
                        <button class="item-btn item-btn-edit" onclick="openItemForm(${idx})" title="Edit item"><i class="fa-solid fa-pen" style="font-size:11px"></i></button>
                        <button class="item-btn item-btn-del" onclick="deleteItem(${idx})" title="Hapus item"><i class="fa-solid fa-trash" style="font-size:11px"></i></button>
                    </div>
                `;
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
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        /* ─── Existing step navigation (unchanged) ──────────── */
        function goStep2() {
            if (orderItems.length === 0) return showErr('Tambahkan minimal satu item batu terlebih dahulu.');
            if (!document.getElementById('nama').value.trim()) return showErr('Nama lengkap wajib diisi.');
            const ph = document.getElementById('phone').value.trim();
            if (!ph) return showErr('Nomor WhatsApp wajib diisi.');
            if (!/^\d{8,14}$/.test(ph)) return showErr('Format nomor tidak valid (contoh: 81234567890).');
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
            const i1 = document.getElementById('step-item-1');
            const i2 = document.getElementById('step-item-2');
            const n1 = document.getElementById('step-num-1');
            const n2 = document.getElementById('step-num-2');
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

        /* ─── NEW: fill summary with items list ─────────────── */
        function fillSummary() {
            const g = id => document.getElementById(id)?.value?.trim() ?? '';

            // Items
            const container = document.getElementById('s-items-container');
            container.innerHTML = '';
            orderItems.forEach((it, idx) => {
                let dimStr = `${it.length} × ${it.width}`;
                if (it.thickness) dimStr += `, tebal ${it.thickness}`;
                let detail = dimStr;
                if (it.finishing) detail += ` · Finishing: ${it.finishing}`;
                if (it.catatan) detail += ` · Catatan: ${it.catatan}`;

                const row = document.createElement('div');
                row.className = 'sum-item-row';
                row.innerHTML = `
                    <div class="sum-item-num">${idx + 1}</div>
                    <div class="sum-item-body">
                        <div class="sum-item-name">${escHtml(it.product)}</div>
                        <div class="sum-item-detail">${escHtml(detail)}</div>
                    </div>
                `;
                container.appendChild(row);
            });

            // Contact
            const email = g('email');
            const catatan = g('catatan');
            document.getElementById('s-nama').textContent = g('nama');
            document.getElementById('s-phone').textContent = '+62' + g('phone');
            const er = document.getElementById('s-email-row');
            document.getElementById('s-email').textContent = email;
            er.style.display = email ? 'flex' : 'none';
            const cr = document.getElementById('s-catatan-row');
            document.getElementById('s-catatan').textContent = catatan || '—';
            cr.style.display = 'flex';
        }

        /* ─── NEW: WA message with all items ────────────────── */
        function kirimWA() {
            const g = id => document.getElementById(id)?.value?.trim() ?? '';
            const email = g('email');
            const note = g('catatan') || '-';

            let itemsText = '';
            orderItems.forEach((it, idx) => {
                let dimLine = `${it.length} × ${it.width}`;
                if (it.thickness) dimLine += `, tebal ${it.thickness}`;
                itemsText += `\n*Item ${idx + 1}:*\n`;
                itemsText += `  Jenis: ${it.product}\n`;
                itemsText += `  Dimensi (p×l): ${dimLine}\n`;
                if (it.finishing) itemsText += `  Finishing: ${it.finishing}\n`;
                if (it.catatan) itemsText += `  Catatan: ${it.catatan}\n`;
            });

            const msg =
                `Halo TierraStone!\n\nSaya ingin memesan batu alam:\n${itemsText}\n*Data Pemesan:*\nNama: ${g('nama')}\nNo. WA: +62${g('phone')}${email ? '\nEmail: ' + email : ''}\n\n*Catatan Umum:* ${note}\n\nMohon informasi selanjutnya. Terima kasih!`;

            window.open(`https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
        }
    </script>
</body>

</html>