<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan – TierraStone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --stone: #b5a89a;
            --earth: #7c6b5d;
            --dark: #1c1814;
            --cream: #f5f1ec;
            --blue: #2563eb;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
        }

        h1,
        h2,
        h3,
        .serif {
            font-family: 'Cormorant Garamond', serif;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }

        /* Search bar */
        .search-wrap {
            position: relative;
        }

        .search-wrap input {
            width: 100%;
            padding: 16px 56px 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            background: white;
            color: var(--dark);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-wrap input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .1);
        }

        .search-wrap button {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--blue);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 15px;
            transition: background .2s;
        }

        .search-wrap button:hover {
            background: #1d4ed8;
        }

        /* Card */
        .card {
            background: rgba(255, 255, 255, .8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(181, 168, 154, .2);
            border-radius: 20px;
            box-shadow: 0 4px 32px rgba(28, 24, 20, .05);
        }

        /* Order row */
        .order-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-radius: 14px;
            border: 1.5px solid transparent;
            cursor: pointer;
            transition: all .2s;
            background: white;
        }

        .order-row:hover {
            border-color: var(--blue);
            box-shadow: 0 4px 16px rgba(37, 99, 235, .1);
            transform: translateY(-1px);
        }

        /* Status badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-pending {
            background: #fef9c3;
            color: #92400e;
        }

        .badge-process {
            background: #dbeafe;
            color: #1e40af;
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

        /* Modal overlay */
        #modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(28, 24, 20, .5);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        #modal-overlay.open {
            display: flex;
            animation: fadeIn .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        #modal-box {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 80px rgba(28, 24, 20, .2);
            animation: slideUp .25s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 28px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: #e2e8f0;
        }

        .tl-item {
            position: relative;
            margin-bottom: 20px;
        }

        .tl-item:last-child {
            margin-bottom: 0;
        }

        .tl-dot {
            position: absolute;
            left: -28px;
            top: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
            background: white;
            display: grid;
            place-items: center;
            font-size: 8px;
        }

        .tl-dot.done {
            background: var(--blue);
            border-color: var(--blue);
            color: white;
        }

        .tl-dot.active {
            background: white;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
        }

        /* Divider */
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 16px 0;
        }

        /* Empty / error state */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 16px;
            display: block;
        }

        /* Skeleton loader */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
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
    </style>
</head>

<body class="min-h-screen">

    <!-- Nav -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 relative">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold tracking-tight text-slate-800" style="font-family:'Cormorant Garamond',serif;">TIERRA<span style="color:var(--blue)">STONE</span></a>
            <div class="flex items-center gap-4">
                <a href="{{ route('order') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> Buat Pesanan
                </a>
                <a href="{{ route('welcome') }}" class="text-sm text-slate-500 hover:text-slate-800 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Beranda
                </a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-2xl mx-auto px-4 py-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-50 rounded-2xl mb-4">
                <i class="fa-solid fa-magnifying-glass text-blue-600 text-xl"></i>
            </div>
            <h1 class="text-4xl font-bold" style="font-family:'Cormorant Garamond',serif;">Lacak Pesanan</h1>
            <p class="text-slate-500 mt-2">Masukkan nomor order Anda untuk melihat status.</p>
        </div>

        <!-- Search Card -->
        <div class="card p-6 mb-6">
            <div class="search-wrap">
                <input type="text" id="search-input" placeholder="Contoh: ORD-20260001"
                    onkeydown="if(event.key==='Enter') doSearch()">
                <button onclick="doSearch()" title="Cari">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <p class="text-xs text-slate-400 mt-3 flex items-center gap-1.5">
                <i class="fa-solid fa-circle-info"></i>
                Gunakan nomor pesanan yang anda dapatkan dari whatsapp
            </p>
        </div>

        <!-- Results area -->
        <div id="results-area"></div>

    </main>

    <!-- ─── MODAL DETAIL ─────────────────────────────────── -->
    <div id="modal-overlay" onclick="closeModalOutside(event)">
        <div id="modal-box">
            <!-- Header -->
            <div class="flex items-start justify-between p-6 pb-4">
                <div>
                    <p class="text-xs font-semibold tracking-widest uppercase text-slate-400 mb-1">Detail Pesanan</p>
                    <h2 class="text-2xl font-bold" style="font-family:'Cormorant Garamond',serif;" id="m-order-id">—</h2>
                </div>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-700 transition w-9 h-9 rounded-full hover:bg-slate-100 grid place-items: center text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="divider mx-6 my-0"></div>

            <!-- Body -->
            <div class="p-6 space-y-5">

                <!-- Status + tanggal -->
                <div class="flex items-center justify-between">
                    <div id="m-status-badge"></div>
                    <span class="text-xs text-slate-400" id="m-date"></span>
                </div>

                <!-- Info grid -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Nama</p>
                        <p class="font-semibold text-sm" id="m-nama">—</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">WhatsApp</p>
                        <p class="font-semibold text-sm" id="m-phone">—</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Produk</p>
                        <p class="font-semibold text-sm" id="m-produk">—</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Jumlah</p>
                        <p class="font-semibold text-sm" id="m-qty">—</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Lokasi Proyek</p>
                        <p class="font-semibold text-sm" id="m-kota">—</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Tipe Proyek</p>
                        <p class="font-semibold text-sm" id="m-tipe">—</p>
                    </div>
                </div>

                <!-- Catatan -->
                <div id="m-catatan-wrap" class="bg-amber-50 border border-amber-100 rounded-xl p-3 hidden">
                    <p class="text-xs text-amber-600 font-semibold mb-1"><i class="fa-solid fa-note-sticky mr-1"></i>Catatan</p>
                    <p class="text-sm text-amber-900" id="m-catatan"></p>
                </div>

                <!-- Timeline -->
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-4">Riwayat Status</p>
                    <div class="timeline" id="m-timeline"></div>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0">
                <a id="m-wa-link" href="#" target="_blank"
                    class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                    <i class="fa-brands fa-whatsapp text-lg"></i> Hubungi Kami via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <footer class="relative z-10 py-8 border-t border-slate-200 text-center text-slate-400 text-sm">
        &copy; 2026 OMS TierraStone. All rights reserved.
    </footer>

    <script>
        // ─── CONFIG ──────────────────────────────────────────────────
        const WA_NUMBER = '628123456789'; // ← Ganti nomor WA

        // ─── MOCK DATA (ganti dengan fetch ke API Laravel) ──────────
        // Struktur data ini sesuai dengan apa yang akan dikembalikan backend
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

        // Status config
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

        // ─── SEARCH ──────────────────────────────────────────────────
        function doSearch() {
            const raw = document.getElementById('search-input').value.trim().toLowerCase();
            const area = document.getElementById('results-area');
            if (!raw) {
                area.innerHTML = '';
                return;
            }

            // Show skeleton
            area.innerHTML = `
        <div class="card p-5 space-y-3">
            ${[1,2].map(()=>`
            <div class="flex items-center gap-4">
                <div class="skeleton w-10 h-10 rounded-xl flex-shrink-0"></div>
                <div class="flex-1 space-y-2">
                    <div class="skeleton h-4 w-1/3 rounded"></div>
                    <div class="skeleton h-3 w-1/2 rounded"></div>
                </div>
                <div class="skeleton h-6 w-24 rounded-full"></div>
            </div>`).join('')}
        </div>`;

            // Simulate API delay
            setTimeout(() => {
                // ── In real app: replace with fetch('/api/orders/search?q='+raw) ──
                const results = MOCK_ORDERS.filter(o =>
                    o.phone.replace(/\D/g, '').includes(raw.replace(/\D/g, '')) ||
                    o.id.toLowerCase().includes(raw) ||
                    o.nama.toLowerCase().includes(raw)
                );
                renderResults(results, raw);
            }, 600);
        }

        function renderResults(orders, query) {
            const area = document.getElementById('results-area');
            if (!orders.length) {
                area.innerHTML = `
            <div class="card">
                <div class="empty-state">
                    <i class="fa-solid fa-box-open text-slate-300"></i>
                    <p class="font-semibold text-slate-500">Pesanan tidak ditemukan</p>
                    <p class="text-sm mt-1">Coba gunakan nomor nomor pesanan yang tepat.</p>
                </div>
            </div>`;
                return;
            }

            const rows = orders.map(o => {
                const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;
                return `
        <div class="order-row" onclick="openModal('${o.id}')">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex-shrink-0 grid place-items-center text-blue-600">
                <i class="fa-solid fa-box text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm">${o.id}</p>
                <p class="text-xs text-slate-400 truncate">${o.produk} · ${o.qty}</p>
            </div>
            <div>
                <span class="badge ${st.cls}">
                    <i class="fa-solid ${st.icon}"></i>${st.label}
                </span>
            </div>
            <i class="fa-solid fa-chevron-right text-slate-300 text-sm flex-shrink-0"></i>
        </div>`;
            }).join('');

            area.innerHTML = `
        <div class="card p-5">
            <p class="text-xs text-slate-400 mb-4 font-medium">${orders.length} pesanan ditemukan</p>
            <div class="space-y-2">${rows}</div>
        </div>`;
        }

        // ─── MODAL ───────────────────────────────────────────────────
        function openModal(orderId) {
            // In real app: fetch('/api/orders/'+orderId) then populate
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

            // Status badge
            document.getElementById('m-status-badge').innerHTML =
                `<span class="badge ${st.cls}"><i class="fa-solid ${st.icon}"></i>${st.label}</span>`;

            // Catatan
            const noteWrap = document.getElementById('m-catatan-wrap');
            if (o.catatan) {
                noteWrap.classList.remove('hidden');
                document.getElementById('m-catatan').textContent = o.catatan;
            } else {
                noteWrap.classList.add('hidden');
            }

            // Timeline
            document.getElementById('m-timeline').innerHTML = o.timeline.map(t => `
        <div class="tl-item">
            <div class="tl-dot ${t.done ? 'done' : t.active ? 'active' : ''}">
                ${t.done ? '<i class="fa-solid fa-check"></i>' : ''}
            </div>
            <p class="font-semibold text-sm ${!t.done && !t.active ? 'text-slate-300' : ''}">${t.label}</p>
            <p class="text-xs ${t.done ? 'text-slate-400' : t.active ? 'text-blue-500 font-medium' : 'text-slate-300'} mt-0.5">${t.time}</p>
        </div>
    `).join('');

            // WA link
            const msg = encodeURIComponent(`Halo TierraStone, saya ingin menanyakan status pesanan saya:\n\n🔖 *No. Order:* ${o.id}\n👤 *Nama:* ${o.nama}\n\nMohon informasinya. Terima kasih!`);
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


        window.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const q = params.get('q');
            if (q) {
                document.getElementById('search-input').value = q;
                doSearch();
            }
        });
    </script>
</body>

</html>