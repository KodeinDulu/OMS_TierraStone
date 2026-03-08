<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan – TierraStone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ── TOKENS (identik welcome & order) ── */
        :root {
            --ink: #0f1923;
            --ink2: #2d3f52;
            --body: #4a6278;
            --muted: #8aa0b4;
            --border: #d6e4f0;
            --surface: #eef5fb;
            --bg: #f5f9fd;
            --white: #ffffff;
            --blue: #2a7de1;
            --blue2: #1a60c0;
            --blue-lt: #dbeeff;
            --blue-xs: #f0f7ff;
            --stone: #b0c4d8;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Syne', sans-serif;
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            cursor: none;
        }

        /* ── CURSOR ── */
        .cur-dot {
            width: 7px;
            height: 7px;
            background: var(--blue);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }

        .cur-ring {
            width: 32px;
            height: 32px;
            border: 1.5px solid rgba(42, 125, 225, .35);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width .3s, height .3s, border-color .3s;
        }

        body:has(a:hover) .cur-ring,
        body:has(button:hover) .cur-ring {
            width: 48px;
            height: 48px;
            border-color: var(--blue);
        }

        /* ── NOISE ── */
        .noise {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 200;
            opacity: .25;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
        }

        /* ── BG BLOBS ── */
        .bg-blobs {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .bg-blobs::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(42, 125, 225, .07) 0%, transparent 70%);
            top: -150px;
            right: -150px;
        }

        .bg-blobs::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(62, 207, 207, .05) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
        }

        /* ── NAV (identik) ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(245, 249, 253, .92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 24px rgba(42, 125, 225, .06);
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 19px;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
        }

        .nav-logo span {
            color: var(--blue);
        }

        .nav-link-sm {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--body);
            text-decoration: none;
            transition: color .2s;
        }

        .nav-link-sm:hover {
            color: var(--blue);
        }

        .nav-cta-sm {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: var(--white);
            background: var(--blue);
            padding: 9px 20px;
            border-radius: 2px;
            text-decoration: none;
            transition: all .25s ease;
            box-shadow: 0 4px 14px rgba(42, 125, 225, .28);
        }

        .nav-cta-sm:hover {
            background: var(--blue2);
            transform: translateY(-1px);
        }

        /* ── PAGE ENTRANCE ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pu {
            opacity: 0;
            animation: fadeUp .55s cubic-bezier(.22, 1, .36, 1) both;
        }

        .d1 {
            animation-delay: .06s;
        }

        .d2 {
            animation-delay: .14s;
        }

        .d3 {
            animation-delay: .22s;
        }

        /* ── MAIN CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(42, 125, 225, .04), 0 12px 48px rgba(42, 125, 225, .07);
        }

        /* ── SEARCH BAR ── */
        .search-wrap {
            position: relative;
        }

        .search-wrap input {
            width: 100%;
            padding: 14px 56px 14px 20px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            background: var(--white);
            color: var(--ink);
            outline: none;
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }

        .search-wrap input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(42, 125, 225, .1);
            transform: translateY(-1px);
        }

        .search-wrap input::placeholder {
            color: var(--stone);
        }

        .search-wrap button {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--blue);
            color: white;
            border: none;
            width: 38px;
            height: 38px;
            border-radius: 9px;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 13px;
            transition: background .2s, transform .2s;
        }

        .search-wrap button:hover {
            background: var(--blue2);
            transform: translateY(-50%) scale(1.05);
        }

        /* ── ORDER ROW ── */
        .order-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            background: var(--white);
            cursor: pointer;
            transition: all .22s ease;
        }

        .order-row:hover {
            border-color: var(--blue);
            box-shadow: 0 4px 16px rgba(42, 125, 225, .1);
            transform: translateY(-2px);
        }

        .order-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--blue-xs);
            border: 1px solid var(--blue-lt);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            color: var(--blue);
            font-size: 13px;
        }

        /* ── STATUS BADGES ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            letter-spacing: .04em;
        }

        .badge-pending {
            background: #fef9c3;
            color: #92400e;
        }

        .badge-process {
            background: var(--blue-lt);
            color: var(--blue2);
        }

        .badge-shipped {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-done {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .badge-cancel {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ── SKELETON ── */
        .skeleton {
            background: linear-gradient(90deg, var(--surface) 25%, var(--blue-xs) 50%, var(--surface) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 10px;
        }

        @keyframes shimmer {
            from {
                background-position: 200% 0
            }

            to {
                background-position: -200% 0
            }
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 52px 24px;
        }

        .empty-state i {
            font-size: 36px;
            margin-bottom: 14px;
            display: block;
            color: var(--stone);
        }

        /* ── MODAL ── */
        #modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 500;
            background: rgba(15, 25, 35, .45);
            backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        #modal-overlay.open {
            display: flex;
            animation: overlayIn .2s ease;
        }

        @keyframes overlayIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        #modal-box {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 24px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 80px rgba(15, 25, 35, .18);
            animation: modalUp .28s cubic-bezier(.22, 1, .36, 1);
        }

        @keyframes modalUp {
            from {
                opacity: 0;
                transform: translateY(28px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* Modal scrollbar */
        #modal-box::-webkit-scrollbar {
            width: 4px;
        }

        #modal-box::-webkit-scrollbar-track {
            background: var(--bg);
        }

        #modal-box::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        /* Modal close btn */
        .modal-close {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            background: var(--white);
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--muted);
            font-size: 14px;
            transition: all .2s;
        }

        .modal-close:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-xs);
        }

        /* Info grid in modal */
        .info-tile {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 14px;
        }

        .info-tile-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .info-tile-val {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        /* Modal divider */
        .m-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 16px 0;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 28px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: var(--border);
            border-radius: 2px;
        }

        .tl-item {
            position: relative;
            margin-bottom: 18px;
        }

        .tl-item:last-child {
            margin-bottom: 0;
        }

        .tl-dot {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--white);
            display: grid;
            place-items: center;
            font-size: 7px;
        }

        .tl-dot.done {
            background: var(--blue);
            border-color: var(--blue);
            color: white;
        }

        .tl-dot.active {
            background: var(--white);
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(42, 125, 225, .15);
        }

        .tl-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .tl-label.dim {
            color: var(--stone);
        }

        .tl-time {
            font-size: 11px;
            margin-top: 2px;
            color: var(--muted);
        }

        .tl-time.active-time {
            color: var(--blue);
            font-weight: 600;
        }

        .tl-time.dim-time {
            color: var(--stone);
        }

        /* WA Button in modal */
        .btn-wa-modal {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #16a34a;
            color: white;
            padding: 14px 24px;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .25s cubic-bezier(.34, 1.4, .64, 1);
            box-shadow: 0 4px 20px rgba(21, 128, 61, .25);
        }

        .btn-wa-modal:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(21, 128, 61, .35);
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::selection {
            background: var(--blue);
            color: white;
        }
    </style>
</head>

<body>

    <div class="noise"></div>
    <div class="bg-blobs"></div>
    <div class="cur-dot" id="cur-dot"></div>
    <div class="cur-ring" id="cur-ring"></div>

    <!-- ── NAV ── -->
    <nav>
        <div class="max-w-3xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="nav-logo">TIERRA<span>STONE</span></a>
            <div class="flex items-center gap-5">
                <a href="{{ route('order') }}" class="nav-cta-sm hidden sm:inline-flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square" style="font-size:10px"></i> Buat Pesanan
                </a>
                <a href="{{ route('welcome') }}" class="nav-link-sm">
                    <i class="fa-solid fa-arrow-left" style="font-size:10px"></i> Beranda
                </a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-2xl mx-auto px-4 py-12 pb-20">

        <!-- Header -->
        <div class="pu d1 text-center mb-10">
            <div style="display:inline-flex; align-items:center; justify-content:center;
                    width:52px; height:52px; border-radius:14px;
                    background:var(--blue-xs); border:1px solid var(--blue-lt); margin-bottom:18px">
                <i class="fa-solid fa-magnifying-glass" style="color:var(--blue); font-size:18px"></i>
            </div>
            <div style="display:inline-flex; align-items:center; gap:10px; margin-bottom:12px; display:flex; justify-content:center">
                <div style="width:20px; height:1.5px; background:var(--blue)"></div>
                <span style="font-size:10px; font-weight:700; letter-spacing:.22em; text-transform:uppercase; color:var(--blue)">Tracking Pesanan</span>
                <div style="width:20px; height:1.5px; background:var(--blue)"></div>
            </div>
            <h1 style="font-family:'Cormorant',serif; font-size:clamp(38px,5vw,56px); font-weight:300; line-height:.95; color:var(--ink)">
                Lacak <em style="font-style:italic; color:var(--blue)">Pesanan</em> Anda
            </h1>
            <p style="font-size:14px; color:var(--body); margin-top:12px">
                Masukkan nomor order, nomor HP, atau nama untuk melihat status pesanan.
            </p>
        </div>

        <!-- Search Card -->
        <div class="card p-6 mb-5 pu d2">
            <div class="search-wrap">
                <input type="text" id="search-input"
                    placeholder="Cari: ORD-20260001 / nomor HP / nama..."
                    onkeydown="if(event.key==='Enter') doSearch()">
                <button onclick="doSearch()" title="Cari">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <p style="font-size:11px; color:var(--muted); margin-top:10px; display:flex; align-items:center; gap:6px">
                <i class="fa-solid fa-circle-info" style="color:var(--blue)"></i>
                Gunakan nomor pesanan yang Anda terima via WhatsApp dari tim kami.
            </p>
        </div>

        <!-- Results -->
        <div id="results-area" class="pu d3"></div>

    </main>

    <!-- ── MODAL ── -->
    <div id="modal-overlay" onclick="closeModalOutside(event)">
        <div id="modal-box">

            <!-- Modal header -->
            <div style="padding:24px 24px 0; display:flex; align-items:flex-start; justify-content:space-between">
                <div>
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px">
                        <div style="width:4px; height:14px; background:var(--blue); border-radius:2px"></div>
                        <span style="font-size:10px; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:var(--blue)">Detail Pesanan</span>
                    </div>
                    <h2 id="m-order-id" style="font-family:'Cormorant',serif; font-size:30px; font-weight:600; color:var(--ink); line-height:1">—</h2>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="m-divider" style="margin:16px 24px 0"></div>

            <!-- Modal body -->
            <div style="padding:20px 24px; display:flex; flex-direction:column; gap:16px">

                <!-- Status + date -->
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px">
                    <div id="m-status-badge"></div>
                    <span id="m-date" style="font-size:11px; color:var(--muted)"></span>
                </div>

                <!-- Info grid -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px">
                    <div class="info-tile">
                        <div class="info-tile-label">Nama</div>
                        <div class="info-tile-val" id="m-nama">—</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label">WhatsApp</div>
                        <div class="info-tile-val" id="m-phone">—</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label">Produk</div>
                        <div class="info-tile-val" id="m-produk">—</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label">Jumlah</div>
                        <div class="info-tile-val" id="m-qty">—</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label">Lokasi Proyek</div>
                        <div class="info-tile-val" id="m-kota">—</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label">Tipe Proyek</div>
                        <div class="info-tile-val" id="m-tipe">—</div>
                    </div>
                </div>

                <!-- Catatan -->
                <div id="m-catatan-wrap" class="hidden"
                    style="background:var(--blue-xs); border:1px solid var(--blue-lt); border-radius:12px; padding:14px">
                    <p style="font-size:10px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--blue); margin-bottom:6px">
                        <i class="fa-solid fa-note-sticky" style="margin-right:5px"></i>Catatan
                    </p>
                    <p id="m-catatan" style="font-size:13px; color:var(--ink2)"></p>
                </div>

                <!-- Timeline -->
                <div>
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:16px">
                        <div style="width:4px; height:12px; background:var(--muted); border-radius:2px"></div>
                        <span style="font-size:10px; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:var(--muted)">Riwayat Status</span>
                    </div>
                    <div class="timeline" id="m-timeline"></div>
                </div>
            </div>

            <!-- Modal footer -->
            <div style="padding:0 24px 24px">
                <a id="m-wa-link" href="#" target="_blank" class="btn-wa-modal">
                    <i class="fa-brands fa-whatsapp" style="font-size:17px"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- ── FOOTER ── -->
    <footer style="background:var(--ink); padding:36px 48px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; position:relative; z-index:10">
        <div style="font-family:'Syne',sans-serif; font-weight:800; font-size:15px; letter-spacing:.14em; text-transform:uppercase; color:var(--white)">
            TIERRA<span style="color:var(--blue)">STONE</span>
        </div>
        <div style="font-size:11px; color:var(--stone); letter-spacing:.07em">&copy; 2026 OMS TierraStone. All rights reserved.</div>
    </footer>

    <script>
        // ── CURSOR ──
        const dot = document.getElementById('cur-dot');
        const ring = document.getElementById('cur-ring');
        let mx = 0,
            my = 0,
            rx = 0,
            ry = 0;
        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
        });
        (function raf() {
            dot.style.left = mx + 'px';
            dot.style.top = my + 'px';
            rx += (mx - rx) * .12;
            ry += (my - ry) * .12;
            ring.style.left = rx + 'px';
            ring.style.top = ry + 'px';
            requestAnimationFrame(raf);
        })();

        // ── CONFIG ──
        const WA_NUMBER = '6289530513637';

        // ── MOCK DATA ──
        const MOCK_ORDERS = [{
                id: 'ORD-20260001',
                nama: 'Budi Santoso',
                phone: '081234567890',
                produk: 'Marmer Premium',
                qty: '25 m²',
                kota: 'Jakarta Selatan',
                tipe: 'Rumah Tinggal',
                catatan: 'Mohon warna cream/beige, finishing polished.',
                status: 'shipped',
                tanggal: '28 Feb 2026',
                timeline: [{
                        label: 'Pesanan diterima',
                        time: '28 Feb 2026, 09.15',
                        done: true
                    },
                    {
                        label: 'Dikonfirmasi tim',
                        time: '28 Feb 2026, 11.30',
                        done: true
                    },
                    {
                        label: 'Diproses & dikemas',
                        time: '1 Mar 2026, 08.00',
                        done: true
                    },
                    {
                        label: 'Dikirim ke lokasi',
                        time: '3 Mar 2026, 14.00',
                        done: true
                    },
                    {
                        label: 'Terkirim',
                        time: 'Menunggu konfirmasi',
                        done: false,
                        active: true
                    },
                ]
            },
            {
                id: 'ORD-20260002',
                nama: 'Siti Rahayu',
                phone: '085678901234',
                produk: 'Granit Alam',
                qty: '40 m²',
                kota: 'Surabaya',
                tipe: 'Komersial / Perkantoran',
                catatan: '',
                status: 'process',
                tanggal: '3 Mar 2026',
                timeline: [{
                        label: 'Pesanan diterima',
                        time: '3 Mar 2026, 10.00',
                        done: true
                    },
                    {
                        label: 'Dikonfirmasi tim',
                        time: '3 Mar 2026, 12.45',
                        done: true
                    },
                    {
                        label: 'Diproses & dikemas',
                        time: 'Sedang berjalan',
                        done: false,
                        active: true
                    },
                    {
                        label: 'Dikirim ke lokasi',
                        time: '—',
                        done: false
                    },
                    {
                        label: 'Terkirim',
                        time: '—',
                        done: false
                    },
                ]
            },
            {
                id: 'ORD-20260003',
                nama: 'Ahmad Fauzi',
                phone: '089876543210',
                produk: 'Batu Landscape',
                qty: '15 m²',
                kota: 'Bandung',
                tipe: 'Landscape / Taman',
                catatan: 'Batu andesit hitam jika tersedia.',
                status: 'pending',
                tanggal: '5 Mar 2026',
                timeline: [{
                        label: 'Pesanan diterima',
                        time: '5 Mar 2026, 08.30',
                        done: true
                    },
                    {
                        label: 'Menunggu konfirmasi tim',
                        time: 'Dalam antrian',
                        done: false,
                        active: true
                    },
                    {
                        label: 'Diproses & dikemas',
                        time: '—',
                        done: false
                    },
                    {
                        label: 'Dikirim ke lokasi',
                        time: '—',
                        done: false
                    },
                    {
                        label: 'Terkirim',
                        time: '—',
                        done: false
                    },
                ]
            },
        ];

        const STATUS_CONFIG = {
            pending: {
                label: 'Menunggu Konfirmasi',
                icon: 'fa-clock',
                cls: 'badge-pending'
            },
            process: {
                label: 'Diproses',
                icon: 'fa-gear fa-spin',
                cls: 'badge-process'
            },
            shipped: {
                label: 'Dikirim',
                icon: 'fa-truck-fast',
                cls: 'badge-shipped'
            },
            done: {
                label: 'Selesai',
                icon: 'fa-circle-check',
                cls: 'badge-done'
            },
            cancel: {
                label: 'Dibatalkan',
                icon: 'fa-circle-xmark',
                cls: 'badge-cancel'
            },
        };

        // ── SEARCH ──
        function doSearch() {
            const raw = document.getElementById('search-input').value.trim().toLowerCase();
            const area = document.getElementById('results-area');
            if (!raw) {
                area.innerHTML = '';
                return;
            }

            // Skeleton
            area.innerHTML = `
        <div class="card p-5" style="display:flex; flex-direction:column; gap:12px">
            ${[1,2].map(()=>`
            <div style="display:flex; align-items:center; gap:14px">
                <div class="skeleton" style="width:40px; height:40px; flex-shrink:0; border-radius:10px"></div>
                <div style="flex:1; display:flex; flex-direction:column; gap:7px">
                    <div class="skeleton" style="height:13px; width:38%"></div>
                    <div class="skeleton" style="height:11px; width:55%"></div>
                </div>
                <div class="skeleton" style="height:24px; width:90px; border-radius:999px"></div>
            </div>`).join('')}
        </div>`;

            setTimeout(() => {
                // ── Replace with: fetch('/api/orders/search?q='+raw) ──
                const results = MOCK_ORDERS.filter(o =>
                    o.phone.replace(/\D/g, '').includes(raw.replace(/\D/g, '')) ||
                    o.id.toLowerCase().includes(raw) ||
                    o.nama.toLowerCase().includes(raw)
                );
                renderResults(results);
            }, 600);
        }

        function renderResults(orders) {
            const area = document.getElementById('results-area');
            if (!orders.length) {
                area.innerHTML = `
            <div class="card">
                <div class="empty-state">
                    <i class="fa-solid fa-box-open"></i>
                    <p style="font-weight:700; font-size:15px; color:var(--ink2); margin-bottom:6px">Pesanan tidak ditemukan</p>
                    <p style="font-size:13px; color:var(--muted)">Coba gunakan nomor order, nomor HP, atau nama yang tepat.</p>
                </div>
            </div>`;
                return;
            }

            const rows = orders.map(o => {
                const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;
                return `
        <div class="order-row" onclick="openModal('${o.id}')">
            <div class="order-icon"><i class="fa-solid fa-box"></i></div>
            <div style="flex:1; min-width:0">
                <p style="font-size:13px; font-weight:700; color:var(--ink)">${o.id}</p>
                <p style="font-size:11px; color:var(--muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-top:2px">${o.produk} · ${o.qty} · ${o.kota}</p>
            </div>
            <span class="badge ${st.cls}">
                <i class="fa-solid ${st.icon}"></i>${st.label}
            </span>
            <i class="fa-solid fa-chevron-right" style="color:var(--stone); font-size:11px; flex-shrink:0"></i>
        </div>`;
            }).join('');

            area.innerHTML = `
        <div class="card p-5">
            <p style="font-size:11px; color:var(--muted); font-weight:600; letter-spacing:.06em; margin-bottom:12px">
                ${orders.length} pesanan ditemukan
            </p>
            <div style="display:flex; flex-direction:column; gap:8px">${rows}</div>
        </div>`;
        }

        // ── MODAL ──
        function openModal(orderId) {
            const o = MOCK_ORDERS.find(x => x.id === orderId);
            if (!o) return;
            const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;

            document.getElementById('m-order-id').textContent = o.id;
            document.getElementById('m-date').textContent = o.tanggal;
            document.getElementById('m-nama').textContent = o.nama;
            document.getElementById('m-phone').textContent = o.phone;
            document.getElementById('m-produk').textContent = o.produk;
            document.getElementById('m-qty').textContent = o.qty;
            document.getElementById('m-kota').textContent = o.kota;
            document.getElementById('m-tipe').textContent = o.tipe || '—';

            document.getElementById('m-status-badge').innerHTML =
                `<span class="badge ${st.cls}"><i class="fa-solid ${st.icon}" style="margin-right:4px"></i>${st.label}</span>`;

            const noteWrap = document.getElementById('m-catatan-wrap');
            if (o.catatan) {
                noteWrap.classList.remove('hidden');
                document.getElementById('m-catatan').textContent = o.catatan;
            } else {
                noteWrap.classList.add('hidden');
            }

            document.getElementById('m-timeline').innerHTML = o.timeline.map(t => `
        <div class="tl-item">
            <div class="tl-dot ${t.done ? 'done' : t.active ? 'active' : ''}">
                ${t.done ? '<i class="fa-solid fa-check"></i>' : ''}
            </div>
            <p class="tl-label ${!t.done && !t.active ? 'dim' : ''}">${t.label}</p>
            <p class="tl-time ${t.active ? 'active-time' : !t.done ? 'dim-time' : ''}">${t.time}</p>
        </div>`).join('');

            const msg = encodeURIComponent(`Halo TierraStone, saya ingin menanyakan status pesanan:\n\n🔖 *No. Order:* ${o.id}\n👤 *Nama:* ${o.nama}\n\nMohon informasinya. Terima kasih!`);
            document.getElementById('m-wa-link').href = `https://wa.me/${WA_NUMBER}?text=${msg}`;

            document.getElementById('modal-overlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modal-overlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        function closeModalOutside(e) {
            if (e.target.id === 'modal-overlay') closeModal();
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        // ── URL PARAM ──
        window.addEventListener('DOMContentLoaded', () => {
            const q = new URLSearchParams(window.location.search).get('q');
            if (q) {
                document.getElementById('search-input').value = q;
                doSearch();
            }
        });
    </script>
</body>

</html>