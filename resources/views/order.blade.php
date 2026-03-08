<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Sekarang – TierraStone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ── TOKENS (sama persis welcome) ── */
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
            --accent: #3ecfcf;
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

        /* ── CURSOR (sama welcome) ── */
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
            transition: width .3s ease, height .3s ease, border-color .3s;
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

        /* ── NAV (sama welcome) ── */
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

        .nav-back {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--body);
            text-decoration: none;
            transition: color .2s;
        }

        .nav-back:hover {
            color: var(--blue);
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
            animation-delay: .12s;
        }

        .d3 {
            animation-delay: .18s;
        }

        .d4 {
            animation-delay: .26s;
        }

        /* ── STEP PILLS ── */
        .step-pill {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .05em;
            transition: all .35s cubic-bezier(.34, 1.4, .64, 1);
            user-select: none;
            border: 1.5px solid transparent;
        }

        .step-pill.inactive {
            background: var(--white);
            border-color: var(--border);
            color: var(--muted);
        }

        .step-pill.active {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(42, 125, 225, .3);
            transform: scale(1.05);
        }

        .step-pill.done {
            background: #dcfce7;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .pill-num {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 10px;
            font-weight: 800;
            background: rgba(255, 255, 255, .25);
        }

        .step-pill.inactive .pill-num {
            background: var(--surface);
            color: var(--muted);
        }

        .step-pill.done .pill-num {
            background: #16a34a;
            color: white;
        }

        .step-connector {
            width: 40px;
            height: 2px;
            background: var(--border);
            border-radius: 2px;
        }

        /* Progress bar */
        .prog-track {
            height: 3px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .prog-fill {
            height: 100%;
            border-radius: 4px;
            background: var(--blue);
            transition: width .55s cubic-bezier(.34, 1.3, .64, 1);
        }

        /* ── MAIN CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 2px 8px rgba(42, 125, 225, .04), 0 12px 48px rgba(42, 125, 225, .07);
        }

        /* ── SECTION DIVIDER ── */
        .sec-divider {
            height: 1px;
            margin: 28px 0;
            background: linear-gradient(to right, transparent, var(--border), transparent);
        }

        /* ── SECTION LABEL (same style as welcome sec-tag) ── */
        .form-sec-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }

        .form-sec-label-line {
            width: 20px;
            height: 1.5px;
            background: var(--blue);
        }

        .form-sec-label span {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--blue);
        }

        /* ── PRODUCT CARDS ── */
        .prod-card {
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            border: 2px solid var(--border);
            background: #1c2530;
            transition: all .28s cubic-bezier(.34, 1.4, .64, 1);
        }

        .prod-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 28px rgba(42, 125, 225, .14);
            border-color: var(--stone);
        }

        .prod-card.selected {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(42, 125, 225, .15), 0 10px 28px rgba(42, 125, 225, .15);
            transform: scale(1.03);
        }

        .prod-card .check-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--blue);
            color: white;
            display: grid;
            place-items: center;
            font-size: 10px;
            opacity: 0;
            transform: scale(0);
            transition: all .25s cubic-bezier(.34, 1.56, .64, 1);
        }

        .prod-card.selected .check-badge {
            opacity: 1;
            transform: scale(1);
        }

        .prod-card img {
            transition: transform .5s ease;
        }

        .prod-card:hover img {
            transform: scale(1.07);
        }

        .img-wrap {
            height: 100px;
            overflow: hidden;
        }

        /* ── DROPDOWN ARROW ── */
        .sel-wrap {
            position: relative;
        }

        .sel-wrap::after {
            content: '';
            pointer-events: none;
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid var(--muted);
        }

        /* ── INPUTS ── */
        .fi {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            background: var(--white);
            color: var(--ink);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }

        .fi:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(42, 125, 225, .1);
            transform: translateY(-1px);
        }

        .fi::placeholder {
            color: var(--stone);
        }

        .fi-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink2);
            margin-bottom: 7px;
        }

        .fi-opt {
            font-weight: 400;
            color: var(--muted);
            text-transform: none;
            letter-spacing: 0;
            font-size: 10px;
        }

        /* ── FINISHING CHIPS ── */
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .fchip {
            padding: 7px 15px;
            border-radius: 999px;
            border: 1.5px solid var(--border);
            font-family: 'Syne', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            background: var(--white);
            color: var(--body);
            user-select: none;
            transition: all .2s cubic-bezier(.34, 1.4, .64, 1);
        }

        .fchip:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-xs);
            transform: scale(1.05);
        }

        .fchip.active {
            background: var(--blue);
            border-color: var(--blue);
            color: white;
            transform: scale(1.07);
            box-shadow: 0 4px 14px rgba(42, 125, 225, .28);
        }

        /* ── QTY STEPPER ── */
        .qty-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: var(--white);
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 18px;
            font-weight: 300;
            color: var(--ink);
            flex-shrink: 0;
            transition: all .2s cubic-bezier(.34, 1.56, .64, 1);
        }

        .qty-btn:hover {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
            transform: scale(1.1);
        }

        .qty-btn:active {
            transform: scale(.94);
        }

        /* ── BUTTONS ── */
        .btn-primary {
            background: var(--blue);
            color: white;
            padding: 13px 30px;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            transition: all .25s cubic-bezier(.34, 1.4, .64, 1);
            box-shadow: 0 4px 16px rgba(42, 125, 225, .28);
        }

        .btn-primary:hover {
            background: var(--blue2);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 24px rgba(42, 125, 225, .38);
        }

        .btn-primary:active {
            transform: scale(.97);
        }

        .btn-ghost {
            background: transparent;
            color: var(--body);
            padding: 12px 22px;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: 1.5px solid var(--border);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s ease;
        }

        .btn-ghost:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-xs);
        }

        .btn-wa {
            background: #16a34a;
            color: white;
            padding: 16px 32px;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            transition: all .25s cubic-bezier(.34, 1.4, .64, 1);
            box-shadow: 0 4px 20px rgba(21, 128, 61, .28);
        }

        .btn-wa:hover {
            background: #15803d;
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 32px rgba(21, 128, 61, .38);
        }

        .btn-wa:active {
            transform: scale(.98);
        }

        /* ── STEP TRANSITIONS ── */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        @keyframes stepEnter {
            from {
                opacity: 0;
                transform: translateX(36px) scale(.97)
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1)
            }
        }

        @keyframes stepExit {
            from {
                opacity: 1;
                transform: translateX(0) scale(1)
            }

            to {
                opacity: 0;
                transform: translateX(-28px) scale(.97)
            }
        }

        @keyframes stepEnterBack {
            from {
                opacity: 0;
                transform: translateX(-36px) scale(.97)
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1)
            }
        }

        .anim-enter {
            animation: stepEnter .4s cubic-bezier(.34, 1.3, .64, 1) forwards;
        }

        .anim-exit {
            animation: stepExit .2s ease forwards;
        }

        .anim-enter-back {
            animation: stepEnterBack .4s cubic-bezier(.34, 1.3, .64, 1) forwards;
        }

        /* ── SUMMARY ── */
        .sum-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 11px 0;
            border-bottom: 1px solid var(--surface);
            font-size: 14px;
        }

        .sum-row:last-child {
            border: none;
        }

        .sum-lbl {
            color: var(--muted);
            font-size: 13px;
        }

        .sum-val {
            font-weight: 600;
            text-align: right;
            max-width: 58%;
            color: var(--ink);
        }

        /* ── ERROR / SHAKE ── */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0)
            }

            20%,
            60% {
                transform: translateX(-6px)
            }

            40%,
            80% {
                transform: translateX(6px)
            }
        }

        .shake {
            animation: shake .35s ease;
        }

        /* ── MISC ── */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        ::selection {
            background: var(--blue);
            color: white;
        }

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
            <a href="{{ route('welcome') }}" class="nav-back">
                <i class="fa-solid fa-arrow-left" style="font-size:10px"></i> Kembali
            </a>
        </div>
    </nav>

    <main class="relative z-10 max-w-3xl mx-auto px-4 py-10 pb-20">

        <!-- Header -->
        <div class="pu d1 text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-4">
                <div style="width:20px; height:1.5px; background:var(--blue)"></div>
                <span style="font-size:10px; font-weight:700; letter-spacing:.22em; text-transform:uppercase; color:var(--blue)">Form Pemesanan</span>
                <div style="width:20px; height:1.5px; background:var(--blue)"></div>
            </div>
            <h1 style="font-family:'Cormorant',serif; font-size:clamp(38px,5vw,56px); font-weight:300; line-height:.95; color:var(--ink)">
                Mulai Pesanan <em style="font-style:italic; color:var(--blue)">Anda</em>
            </h1>
            <p class="mt-3" style="font-size:14px; color:var(--body); font-weight:400">Isi detail di bawah, tim kami hubungi via WhatsApp.</p>
        </div>

        <!-- Step pills -->
        <div class="pu d2 flex items-center justify-center gap-2 mb-3">
            <div class="step-pill active" id="pill-1">
                <div class="pill-num" id="pnum-1">1</div>
                <span>Produk &amp; Detail</span>
            </div>
            <div class="step-connector"></div>
            <div class="step-pill inactive" id="pill-2">
                <div class="pill-num" id="pnum-2">2</div>
                <span>Konfirmasi</span>
            </div>
        </div>

        <!-- Progress -->
        <div class="pu d2 max-w-xs mx-auto mb-8">
            <div class="prog-track">
                <div class="prog-fill" id="prog-fill" style="width:50%"></div>
            </div>
        </div>

        <!-- CARD -->
        <div class="card p-7 md:p-10 pu d3">

            <!-- ════ STEP 1 ════ -->
            <div class="form-step active" id="step-1">

                <!-- Jenis Batu -->
                <div class="form-sec-label">
                    <div class="form-sec-label-line"></div>
                    <span>Jenis Batu</span>
                </div>
                <h2 style="font-family:'Cormorant',serif; font-size:26px; font-weight:600; color:var(--ink); margin-bottom:4px">
                    Pilih Jenis Batu
                </h2>
                <p style="font-size:13px; color:var(--muted); margin-bottom:20px">Pilih dari kartu atau gunakan dropdown lengkap.</p>

                <!-- Product cards -->
                <div class="grid grid-cols-3 gap-3 mb-4" id="product-list">
                    <div class="prod-card" data-product="Marmer Premium" onclick="selectProduct(this)">
                        <div class="check-badge"><i class="fa-solid fa-check"></i></div>
                        <div class="img-wrap">
                            <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png"
                                alt="Marmer" style="width:100%;height:100%;object-fit:contain;object-position:center;padding:8px">
                        </div>
                        <div class="p-2.5">
                            <p style="font-size:12px; font-weight:700; color:var(--white)">Marmer Premium</p>
                            <p style="font-size:11px; color:var(--stone); margin-top:2px">Lantai &amp; dinding</p>
                        </div>
                    </div>
                    <div class="prod-card" data-product="Granit Alam" onclick="selectProduct(this)">
                        <div class="check-badge"><i class="fa-solid fa-check"></i></div>
                        <div class="img-wrap">
                            <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png"
                                alt="Granit" style="width:100%;height:100%;object-fit:contain;object-position:center;padding:8px">
                        </div>
                        <div class="p-2.5">
                            <p style="font-size:12px; font-weight:700; color:var(--white)">Granit Alam</p>
                            <p style="font-size:11px; color:var(--stone); margin-top:2px">Outdoor &amp; dapur</p>
                        </div>
                    </div>
                    <div class="prod-card" data-product="Batu Landscape" onclick="selectProduct(this)">
                        <div class="check-badge"><i class="fa-solid fa-check"></i></div>
                        <div class="img-wrap">
                            <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png"
                                alt="Landscape" style="width:100%;height:100%;object-fit:contain;object-position:center;padding:8px">
                        </div>
                        <div class="p-2.5">
                            <p style="font-size:12px; font-weight:700; color:var(--white)">Batu Landscape</p>
                            <p style="font-size:11px; color:var(--stone); margin-top:2px">Taman &amp; kolam</p>
                        </div>
                    </div>
                </div>

                <!-- Dropdown -->
                <div class="sel-wrap mb-2">
                    <select id="jenis-batu" class="fi" onchange="syncProductFromDropdown(this.value)">
                        <option value="">— atau pilih dari daftar lengkap —</option>
                        <option value="Marmer Premium">Marmer Premium</option>
                        <option value="Granit Alam">Granit Alam</option>
                        <option value="Batu Landscape">Batu Landscape</option>
                        <option value="Andesit">Andesit</option>
                        <option value="Palimanan">Palimanan</option>
                        <option value="Batu Candi">Batu Candi</option>
                        <option value="Batu Templek">Batu Templek</option>
                        <option value="Paras Jogja">Paras Jogja</option>
                        <option value="Lainnya">Lainnya...</option>
                    </select>
                </div>

                <!-- Input custom jenis batu (muncul saat "Lainnya" dipilih) -->
                <div id="jenis-custom-wrap" class="hidden" style="margin-top:10px">
                    <input type="text" id="jenis-custom" class="fi"
                        placeholder="Tulis jenis batu yang Anda inginkan...">
                </div>

                <div class="sec-divider"></div>

                <!-- Ukuran + Qty -->
                <div class="form-sec-label">
                    <div class="form-sec-label-line"></div>
                    <span>Spesifikasi</span>
                </div>
                <h2 style="font-family:'Cormorant',serif; font-size:26px; font-weight:600; color:var(--ink); margin-bottom:20px">
                    Ukuran &amp; Jumlah
                </h2>

                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="fi-label">Ukuran <span style="color:#dc2626">*</span></label>
                        <input type="text" id="size" class="fi" placeholder="Contoh: 60×60 cm">
                        <p style="font-size:11px; color:var(--muted); margin-top:6px">Panjang × lebar dalam cm</p>
                    </div>
                    <div>
                        <label class="fi-label">Estimasi Jumlah (m²) <span style="color:#dc2626">*</span></label>
                        <div class="flex items-center gap-3">
                            <button class="qty-btn" onclick="changeQty(-1)" type="button">−</button>
                            <input type="number" id="qty" class="fi text-center" style="max-width:80px" value="10" min="1">
                            <button class="qty-btn" onclick="changeQty(1)" type="button">+</button>
                            <span style="font-size:11px; color:var(--muted)">min. 5 m²</span>
                        </div>
                    </div>
                </div>

                <!-- Finishing -->
                <div class="mb-2">
                    <label class="fi-label">Finishing <span style="color:#dc2626">*</span></label>
                    <div class="chips">
                        <span class="fchip" onclick="selectChip(this)" data-val="Bakar">🔥 Bakar</span>
                        <span class="fchip" onclick="selectChip(this)" data-val="Bush Hammer">🔨 Bush Hammer</span>
                        <span class="fchip" onclick="selectChip(this)" data-val="Poles">✨ Poles</span>
                        <span class="fchip" onclick="selectChip(this)" data-val="Tekstur">🪵 Tekstur</span>
                        <span class="fchip" id="chip-custom-toggle" onclick="selectChip(this)" data-val="__custom__">✏️ Lainnya...</span>
                    </div>
                    <div id="finishing-custom-wrap" class="hidden">
                        <input type="text" id="finishing-custom" class="fi" placeholder="Tulis jenis finishing Anda...">
                    </div>
                    <input type="hidden" id="finishing" value="">
                </div>

                <div class="sec-divider"></div>

                <!-- Data Diri -->
                <div class="form-sec-label">
                    <div class="form-sec-label-line"></div>
                    <span>Data Pemesan</span>
                </div>
                <h2 style="font-family:'Cormorant',serif; font-size:26px; font-weight:600; color:var(--ink); margin-bottom:20px">
                    Informasi <em style="font-style:italic; color:var(--blue)">Diri</em>
                </h2>

                <div class="grid md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="fi-label">Nama Lengkap <span style="color:#dc2626">*</span></label>
                        <input type="text" id="nama" class="fi" placeholder="Contoh: Budi Santoso" autocomplete="name">
                    </div>
                    <div>
                        <label class="fi-label">No. HP / WhatsApp <span style="color:#dc2626">*</span></label>
                        <div class="flex gap-2">
                            <span class="fi flex-shrink-0 grid place-items-center"
                                style="width:56px; background:var(--blue-xs); color:var(--blue); font-weight:700; font-size:13px; cursor:default; border-color:var(--blue-lt)">+62</span>
                            <input type="number" id="phone" class="fi" placeholder="81234567890" autocomplete="tel">
                        </div>
                    </div>
                    <div>
                        <label class="fi-label">Email <span class="fi-opt">(opsional)</span></label>
                        <input type="email" id="email" class="fi" placeholder="email@domain.com" autocomplete="email">
                    </div>
                    <div class="md:col-span-2">
                        <label class="fi-label">Catatan Tambahan <span class="fi-opt">(opsional)</span></label>
                        <textarea id="catatan" class="fi" rows="3" placeholder="Warna, motif, atau permintaan khusus..."></textarea>
                    </div>
                </div>

                <!-- Error -->
                <div id="step1-error" class="hidden mt-5 flex items-center gap-3 rounded-xl px-4 py-3 text-sm"
                    style="background:#fef2f2; border:1px solid #fecaca; color:#b91c1c">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0"></i>
                    <span id="s1-msg"></span>
                </div>

                <div class="flex justify-end mt-8">
                    <button class="btn-primary" onclick="goStep2()" type="button">
                        Review Pesanan <i class="fa-solid fa-arrow-right" style="font-size:10px"></i>
                    </button>
                </div>
            </div>
            <!-- /step-1 -->

            <!-- ════ STEP 2 ════ -->
            <div class="form-step" id="step-2">

                <!-- Header step 2 -->
                <div class="flex items-center gap-4 mb-7">
                    <div style="width:44px; height:44px; border-radius:12px; background:var(--blue-xs); border:1px solid var(--blue-lt); display:grid; place-items:center; flex-shrink:0">
                        <i class="fa-solid fa-clipboard-check" style="color:var(--blue); font-size:16px"></i>
                    </div>
                    <div>
                        <h2 style="font-family:'Cormorant',serif; font-size:28px; font-weight:600; line-height:1; color:var(--ink)">
                            Konfirmasi Pesanan
                        </h2>
                        <p style="font-size:13px; color:var(--muted); margin-top:3px">Pastikan semua detail sudah benar.</p>
                    </div>
                </div>

                <!-- Summary produk -->
                <div style="background:var(--blue-xs); border:1px solid var(--blue-lt); border-radius:16px; padding:20px; margin-bottom:14px">
                    <div class="flex items-center gap-2 mb-3">
                        <div style="width:4px; height:14px; background:var(--blue); border-radius:2px"></div>
                        <p style="font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--blue)">Rincian Produk</p>
                    </div>
                    <div class="sum-row" style="border-color:rgba(42,125,225,.12)"><span class="sum-lbl">Jenis Batu</span> <span class="sum-val" id="s-produk">—</span></div>
                    <div class="sum-row" style="border-color:rgba(42,125,225,.12)"><span class="sum-lbl">Ukuran</span> <span class="sum-val" id="s-size">—</span></div>
                    <div class="sum-row" style="border-color:rgba(42,125,225,.12)"><span class="sum-lbl">Jumlah</span> <span class="sum-val" id="s-qty">—</span></div>
                    <div class="sum-row" style="border-color:none; border:none; padding-bottom:0"><span class="sum-lbl">Finishing</span> <span class="sum-val" id="s-finishing">—</span></div>
                </div>

                <!-- Summary pemesan -->
                <div style="background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:20px; margin-bottom:20px">
                    <div class="flex items-center gap-2 mb-3">
                        <div style="width:4px; height:14px; background:var(--muted); border-radius:2px"></div>
                        <p style="font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--muted)">Data Pemesan</p>
                    </div>
                    <div class="sum-row"><span class="sum-lbl">Nama</span> <span class="sum-val" id="s-nama">—</span></div>
                    <div class="sum-row"><span class="sum-lbl">WhatsApp</span> <span class="sum-val" id="s-phone">—</span></div>
                    <div class="sum-row" id="s-email-row" style="display:none"><span class="sum-lbl">Email</span><span class="sum-val" id="s-email">—</span></div>
                    <div class="sum-row" style="border:none; padding-bottom:0"><span class="sum-lbl">Catatan</span><span class="sum-val" id="s-catatan">—</span></div>
                </div>

                <!-- WA info banner -->
                <div class="flex gap-3 mb-6" style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:14px; padding:16px; font-size:13px; color:#15803d">
                    <i class="fa-brands fa-whatsapp flex-shrink-0 mt-0.5" style="font-size:18px"></i>
                    <p>Klik tombol di bawah — pesan ke WhatsApp sudah terisi otomatis. Tinggal kirim!</p>
                </div>

                <div class="flex flex-col gap-3">
                    <button class="btn-wa" onclick="kirimWA()" type="button">
                        <i class="fa-brands fa-whatsapp" style="font-size:18px"></i> Kirim via WhatsApp
                    </button>
                    <div class="flex justify-center">
                        <button class="btn-ghost" onclick="goBack()" type="button">
                            <i class="fa-solid fa-arrow-left" style="font-size:10px"></i> Edit Pesanan
                        </button>
                    </div>
                </div>
            </div>
            <!-- /step-2 -->

        </div><!-- /card -->

        <!-- Trust row (sama seperti welcome) -->
        <div class="pu d4 flex justify-center gap-6 mt-8 flex-wrap">
            <span class="flex items-center gap-2" style="font-size:11px; color:var(--muted)">
                <i class="fa-solid fa-lock" style="color:#16a34a"></i> Data aman &amp; privat
            </span>
            <span class="flex items-center gap-2" style="font-size:11px; color:var(--muted)">
                <i class="fa-solid fa-clock" style="color:var(--blue)"></i> Respons jam kerja
            </span>
            <span class="flex items-center gap-2" style="font-size:11px; color:var(--muted)">
                <i class="fa-solid fa-truck-fast" style="color:#d97706"></i> Kirim seluruh Indonesia
            </span>
        </div>

    </main>

    <footer style="background:var(--ink); padding:36px 48px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px">
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
        let selectedProduct = '',
            selectedFinishing = '';

        // ── URL PARAM pre-select ──
        window.addEventListener('DOMContentLoaded', () => {
            const p = new URLSearchParams(window.location.search).get('product');
            if (p) {
                const card = document.querySelector(`.prod-card[data-product="${p}"]`);
                if (card) selectProduct(card);
                const dd = document.getElementById('jenis-batu');
                if (dd && [...dd.options].some(o => o.value === p)) dd.value = p;
                if (!card) selectedProduct = p;
            }
            document.getElementById('finishing-custom').addEventListener('input', function() {
                selectedFinishing = this.value.trim();
                document.getElementById('finishing').value = selectedFinishing;
            });
            document.getElementById('jenis-custom').addEventListener('input', function() {
                if (this.value.trim()) selectedProduct = this.value.trim();
            });
        });

        // ── PRODUCT CARD ──
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
            wrap.classList.remove('hidden');
            if (prefill) input.value = prefill;
            setTimeout(() => input.focus(), 60);
        }

        function hideJenisCustom() {
            document.getElementById('jenis-custom-wrap').classList.add('hidden');
            document.getElementById('jenis-custom').value = '';
        }

        function getProductValue() {
            const dd = document.getElementById('jenis-batu');
            if (dd.value === 'Lainnya') return document.getElementById('jenis-custom').value.trim();
            return selectedProduct;
        }

        // ── CHIPS ──
        function selectChip(el) {
            const val = el.dataset.val;
            if (val === '__custom__') {
                const wrap = document.getElementById('finishing-custom-wrap');
                const opening = wrap.classList.contains('hidden');
                wrap.classList.toggle('hidden', !opening);
                el.classList.toggle('active', opening);
                if (opening) {
                    document.querySelectorAll('.fchip:not(#chip-custom-toggle)').forEach(c => c.classList.remove('active'));
                    selectedFinishing = '';
                    document.getElementById('finishing').value = '';
                    setTimeout(() => document.getElementById('finishing-custom').focus(), 60);
                }
                return;
            }
            document.getElementById('finishing-custom-wrap').classList.add('hidden');
            document.getElementById('chip-custom-toggle').classList.remove('active');
            document.getElementById('finishing-custom').value = '';
            document.querySelectorAll('.fchip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            selectedFinishing = val;
            document.getElementById('finishing').value = val;
        }

        function getFinishingValue() {
            return document.getElementById('finishing-custom').value.trim() || document.getElementById('finishing').value;
        }

        // ── QTY ──
        function changeQty(d) {
            const i = document.getElementById('qty');
            i.value = Math.max(1, (parseInt(i.value) || 0) + d);
            i.classList.add('shake');
            setTimeout(() => i.classList.remove('shake'), 380);
        }

        // ── STEP NAV ──
        function goStep2() {
            const _produk = getProductValue();
            if (!_produk) {
                const _dd = document.getElementById('jenis-batu');
                return showErr(_dd.value === 'Lainnya' ? 'Tulis jenis batu yang Anda inginkan.' : 'Pilih jenis batu terlebih dahulu.');
            }
            const qty = parseInt(document.getElementById('qty').value);
            if (!qty || qty < 5) return showErr('Minimum order adalah 5 m².');
            if (!document.getElementById('size').value.trim()) return showErr('Ukuran batu wajib diisi.');
            if (!getFinishingValue()) return showErr('Pilih atau isi jenis finishing.');
            if (!document.getElementById('nama').value.trim()) return showErr('Nama lengkap wajib diisi.');
            const ph = document.getElementById('phone').value.trim();
            if (!ph) return showErr('Nomor HP wajib diisi.');
            if (!/^\d{8,14}$/.test(ph)) return showErr('Format nomor tidak valid (contoh: 81234567890).');
            fillSummary();
            animTransition('step-1', 'step-2', false);
            setPills(2);
            document.getElementById('prog-fill').style.width = '100%';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function goBack() {
            animTransition('step-2', 'step-1', true);
            setPills(1);
            document.getElementById('prog-fill').style.width = '50%';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function animTransition(fromId, toId, isBack) {
            const from = document.getElementById(fromId);
            const to = document.getElementById(toId);
            from.classList.add('anim-exit');
            setTimeout(() => {
                from.classList.remove('active', 'anim-exit');
                from.style.display = 'none';
                to.style.display = 'block';
                to.classList.add(isBack ? 'anim-enter-back' : 'anim-enter');
                setTimeout(() => {
                    to.classList.remove('anim-enter', 'anim-enter-back');
                    to.classList.add('active');
                }, 420);
            }, 200);
        }

        function setPills(active) {
            const p1 = document.getElementById('pill-1'),
                p2 = document.getElementById('pill-2');
            const n1 = document.getElementById('pnum-1'),
                n2 = document.getElementById('pnum-2');
            if (active === 1) {
                p1.className = 'step-pill active';
                n1.innerHTML = '1';
                p2.className = 'step-pill inactive';
                n2.innerHTML = '2';
            } else {
                p1.className = 'step-pill done';
                n1.innerHTML = '<i class="fa-solid fa-check" style="font-size:9px"></i>';
                p2.className = 'step-pill active';
                n2.innerHTML = '2';
            }
        }

        function showErr(msg) {
            const box = document.getElementById('step1-error');
            document.getElementById('s1-msg').textContent = msg;
            box.classList.remove('hidden');
            box.classList.add('shake');
            setTimeout(() => box.classList.remove('shake'), 400);
            setTimeout(() => box.classList.add('hidden'), 4000);
        }

        // ── SUMMARY ──
        function fillSummary() {
            const g = id => document.getElementById(id).value.trim();
            const fin = getFinishingValue();
            const email = g('email');
            document.getElementById('s-produk').textContent = selectedProduct;
            document.getElementById('s-size').textContent = g('size');
            document.getElementById('s-qty').textContent = document.getElementById('qty').value + ' m²';
            document.getElementById('s-finishing').textContent = fin;
            document.getElementById('s-nama').textContent = g('nama');
            document.getElementById('s-phone').textContent = '+62' + g('phone');
            document.getElementById('s-catatan').textContent = g('catatan') || '—';
            const er = document.getElementById('s-email-row');
            document.getElementById('s-email').textContent = email;
            er.style.display = email ? 'flex' : 'none';
        }

        // ── SEND WA ──
        function kirimWA() {
            const g = id => document.getElementById(id).value.trim();
            const fin = getFinishingValue();
            const email = g('email');
            const note = g('catatan') || '-';
            const msg =
                `Halo TierraStone! 

Saya ingin memesan batu alam:

*Jenis Batu:* ${getProductValue()}
*Ukuran:* ${g('size')}
*Jumlah:* ${document.getElementById('qty').value} m²
*Finishing:* ${fin}

*Data Pemesan:*
Nama: ${g('nama')}
No. WA: +62${g('phone')}${email ? '\n📧 Email: '+email : ''}

*Catatan:* ${note}

Mohon informasi selanjutnya. Terima kasih!`;
            window.open(`https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
        }
    </script>
</body>

</html>