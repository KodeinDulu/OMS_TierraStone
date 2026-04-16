<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Lacak Pesanan – TierraStone</title>
    <link rel="icon" type="image/avif" href="{{ asset('images/logos.avif') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/order-track.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300;1,9..40,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <nav class="nav">
        <div class="nav-inner">
            <a href="{{ route('welcome') }}" class="nav-logo">TierraStone</a>
            <div class="nav-right">
                <a href="{{ route('order') }}" class="nav-cta">
                    <i class="fa-solid fa-pen-to-square"></i> Buat Pesanan
                </a>
                <a href="{{ route('welcome') }}" class="nav-link">
                    <i class="fa-solid fa-arrow-left"></i> Beranda
                </a>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="page-header-label">Tracking Pesanan</div>
        <h1>Lacak <em>Pesanan</em> Anda</h1>
        <p>Masukkan nomor order atau nomor WhatsApp untuk melihat status pesanan.</p>
    </div>

    <div class="main">
        <div class="search-card">
            <div class="search-wrap">
                <input type="text" id="search-input" placeholder="Cari: ORD-20260001" onkeydown="if(event.key==='Enter') doSearch()">
                <button onclick="doSearch()" title="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="search-hint">
                <i class="fa-solid fa-circle-info"></i>
                Gunakan nomor pesanan yang Anda terima via WhatsApp dari tim kami atau nomor WhatsAppmu.
            </div>
        </div>
        <div id="results-area"></div>
    </div>

    <!-- MODAL -->
    <div id="modal-overlay" onclick="closeModalOutside(event)">
        <div id="modal-box">
            <div class="modal-header">
                <div>
                    <div class="modal-label">Detail Pesanan</div>
                    <h2 id="m-order-id" class="modal-title">—</h2>
                </div>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="m-divider"></div>
            <div class="modal-body">
                <div class="modal-status-row">
                    <div id="m-status-badge"></div>
                    <span id="m-date" class="modal-date"></span>
                </div>
                <div class="info-grid">
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
                <div id="m-catatan-wrap" class="modal-note" style="display:none">
                    <div class="modal-note-label"><i class="fa-solid fa-note-sticky" style="margin-right:5px"></i>Catatan</div>
                    <p id="m-catatan" class="modal-note-text"></p>
                </div>
                <div>
                    <div class="tl-heading">Riwayat Status</div>
                    <div class="timeline" id="m-timeline"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer>
        <div class="footer-logo">TierraStone</div>
        <div class="footer-copy">&copy; 2026 TierraStone. All rights reserved.</div>
    </footer> -->

    <script>
        const STATUS_CONFIG = {
            pending: {
                label: 'Pending',
                icon: 'fa-clock',
                cls: 'badge-pending'
            },
            production: {
                label: 'Production',
                icon: 'fa-industry',
                cls: 'badge-production'
            },
            on_progress: {
                label: 'On Progress',
                icon: 'fa-hammer',
                cls: 'badge-on_working'
            },
            ready_to_deliver: {
                label: 'Ready to Deliver',
                icon: 'fa-box-open',
                cls: 'badge-ready_to_send'
            },
            rejected: {
                label: 'Rejected',
                icon: 'fa-xmark',
                cls: 'badge-rejected'
            },
            done: {
                label: 'Done',
                icon: 'fa-circle-check',
                cls: 'badge-done'
            },
        };

        const STATUS_FLOW = ['pending', 'production', 'on_progress', 'ready_to_deliver', 'done'];

        let cachedOrders = [];

        function doSearch() {
            const raw = document.getElementById('search-input').value.trim();
            const area = document.getElementById('results-area');
            if (!raw) {
                area.innerHTML = '';
                return;
            }

            // Skeleton loading
            area.innerHTML = `
            <div class="results-card" style="display:flex; flex-direction:column; gap:12px; padding:24px">
                ${[1,2].map(() => `
                <div style="display:flex; align-items:center; gap:14px">
                    <div class="skeleton" style="width:42px; height:42px; flex-shrink:0"></div>
                    <div style="flex:1; display:flex; flex-direction:column; gap:7px">
                        <div class="skeleton" style="height:13px; width:38%"></div>
                        <div class="skeleton" style="height:11px; width:55%"></div>
                    </div>
                    <div class="skeleton" style="height:24px; width:90px"></div>
                </div>`).join('')}
            </div>`;

            fetch(`{{ route('orders.track') }}?q=${encodeURIComponent(raw)}`)
                .then(res => res.json())
                .then(orders => {
                    cachedOrders = orders;
                    renderResults(orders);
                })
                .catch(() => {
                    area.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="empty-title">Terjadi kesalahan</div>
                        <div class="empty-desc">Gagal memuat data. Coba lagi nanti.</div>
                    </div>`;
                });
        }

        function renderResults(orders) {
            const area = document.getElementById('results-area');
            if (!orders.length) {
                area.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon"><i class="fa-solid fa-box-open"></i></div>
                    <div class="empty-title">Pesanan tidak ditemukan</div>
                    <div class="empty-desc">Pastikan nomor order atau nomor whatsapp sudah benar.</div>
                </div>`;
                return;
            }

            const rows = orders.map((o, i) => {
                const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;
                const qtyText = o.qty_sqm ? `${o.qty_sqm} m²` : `${o.qty_pcs} pcs`;
                return `
            <div class="order-row" onclick="openModal(${i})">
                <div class="order-icon"><i class="fa-solid fa-box"></i></div>
                <div class="order-info">
                    <div class="order-id">${o.id}</div>
                    <div class="order-meta">${o.produk} · ${qtyText}</div>
                </div>
                <span class="badge ${st.cls}"><i class="fa-solid ${st.icon}"></i>${st.label}</span>
                <i class="fa-solid fa-chevron-right order-chevron"></i>
            </div>`;
            }).join('');

            area.innerHTML = `
            <div class="results-card">
                <div class="results-count">${orders.length} pesanan ditemukan</div>
                <div class="results-list">${rows}</div>
            </div>`;
        }

        function buildTimeline(status) {
            const currentIdx = STATUS_FLOW.indexOf(status);
            // Rejected — special case
            if (status === 'rejected') {
                return STATUS_FLOW.map((s, i) => {
                    if (i === 0) return {
                        label: STATUS_CONFIG[s].label,
                        done: true,
                        active: false
                    };
                    return {
                        label: s === 'done' ? 'Rejected' : STATUS_CONFIG[s].label,
                        done: false,
                        active: s === 'done'
                    };
                });
            }
            return STATUS_FLOW.map((s, i) => ({
                label: STATUS_CONFIG[s].label,
                done: i <= currentIdx,
                active: i === currentIdx,
            }));
        }

        function openModal(index) {
            const o = cachedOrders[index];
            if (!o) return;
            const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;

            document.getElementById('m-order-id').textContent = o.id;
            document.getElementById('m-date').textContent = o.tanggal;
            document.getElementById('m-nama').textContent = o.nama;
            document.getElementById('m-phone').textContent = o.phone;
            document.getElementById('m-produk').textContent = o.produk;

            // Qty display
            const qtyText = o.qty_sqm ? `${o.qty_sqm} m²` : `${o.qty_pcs} pcs`;
            document.getElementById('m-qty').textContent = qtyText;

            // Dimensi & finishing di tile yang tersedia
            document.getElementById('m-kota').textContent = o.dimensi;
            document.getElementById('m-tipe').textContent = o.finishing;

            // Update tile labels to match data
            document.querySelector('#m-kota').closest('.info-tile').querySelector('.info-tile-label').textContent = 'Dimensi';
            document.querySelector('#m-tipe').closest('.info-tile').querySelector('.info-tile-label').textContent = 'Finishing';

            document.getElementById('m-status-badge').innerHTML =
                `<span class="badge ${st.cls}"><i class="fa-solid ${st.icon}" style="margin-right:4px"></i>${st.label}</span>`;


            // Catatan
            const noteWrap = document.getElementById('m-catatan-wrap');
            if (o.catatan) {
                noteWrap.style.display = 'block';
                document.getElementById('m-catatan').textContent = o.catatan;
            } else {
                noteWrap.style.display = 'none';
            }

            // Items list (if multiple)
            const itemsHtml = o.items.map((it, idx) => `
    <div style="padding:12px; background:var(--surface,#fafaf8); border:1px solid var(--border,#e5e2dc); border-radius:10px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px">
            <strong style="font-size:14px">${idx + 1}. ${it.stone}</strong>
            <span style="font-size:13px; font-weight:600">
                ${(it.qty_sqm != null && it.qty_sqm > 0) ? it.qty_sqm + ' m²' : it.qty_pcs + ' pcs'}
            </span>
        </div>
        <div style="display:flex; gap:8px; flex-wrap:wrap">
            ${it.dimensi !== '—' ? `<span style="font-size:12px; color:var(--muted,#888)">📐 ${it.dimensi}</span>` : ''}
            ${it.finishing !== '—' ? `<span style="font-size:12px; color:var(--muted,#888)">✨ ${it.finishing}</span>` : ''}
        </div>
    </div>
`).join('');

            // Timeline
            const timeline = buildTimeline(o.status);
            document.getElementById('m-timeline').innerHTML =
                timeline.map(t => `
                <div class="tl-item">
                    <div class="tl-dot ${t.done ? 'done' : t.active ? 'active' : ''}">
                        ${t.done ? '<i class="fa-solid fa-check"></i>' : ''}
                    </div>
                    <p class="tl-label ${!t.done && !t.active ? 'dim' : ''}">${t.label}</p>
                    <p class="tl-time ${!t.done && !t.active ? 'dim-time' : ''}">${t.done ? '✓' : '—'}</p>
                </div>`).join('') + itemsHtml;

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
            const q = new URLSearchParams(window.location.search).get('q');
            if (q) {
                document.getElementById('search-input').value = q;
                doSearch();
            }
        });
    </script>
</body>

</html>