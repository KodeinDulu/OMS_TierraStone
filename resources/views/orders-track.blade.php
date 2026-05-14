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

            <!-- TOPBAR -->
            <div class="modal-topbar">
                <div class="modal-breadcrumb">
                    <button class="modal-back-btn" onclick="closeModal()"><i class="fa-solid fa-arrow-left"></i></button>
                    <span class="modal-breadcrumb-text">Orders list <span class="modal-breadcrumb-sep">/</span> Details</span>
                </div>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <!-- ORDER HEADER -->
            <div class="modal-order-header">
                <div>
                    <div class="modal-order-label">Nomor Pesanan</div>
                    <h2 id="m-order-id" class="modal-order-id">—</h2>
                    <p id="m-date" class="modal-order-date"></p>
                </div>
                <div id="m-status-badge"></div>
            </div>

            <div class="m-divider"></div>

            <!-- BODY: 2 COLUMNS -->
            <div class="modal-body">

                <!-- LEFT -->
                <div class="modal-left">

                    <!-- CATATAN (opsional) -->
                    <div id="m-catatan-wrap" class="modal-note" style="display:none">
                        <i class="fa-solid fa-thumbtack modal-note-icon"></i>
                        <div>
                            <div class="modal-note-label">Catatan</div>
                            <p id="m-catatan" class="modal-note-text"></p>
                        </div>
                    </div>

                    <!-- ITEM CARDS -->
                    <div class="modal-section">
                        <div class="modal-section-title">Detail Produk</div>
                        <div id="m-items-list"></div>
                    </div>

                    <!-- GLOBAL TIMELINE -->
                    <div class="modal-timeline-section">
                        <div class="modal-timeline-label">Status Pengerjaan</div>
                        <div id="m-global-timeline"></div>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="modal-right">

                    <!-- Customer -->
                    <div class="modal-section">
                        <div class="modal-section-title">Customer</div>
                        <div class="modal-customer-wrap">
                            <div class="modal-customer-avatar" id="m-avatar">—</div>
                            <div>
                                <div class="modal-customer-name" id="m-nama">—</div>
                                <div class="modal-customer-phone" id="m-phone">—</div>
                            </div>
                        </div>
                        <div id="m-address-wrap" style="display:none; align-items:flex-start; gap:6px; margin-top:10px;">
                            <i class="fa-solid fa-location-dot" style="font-size:13px; margin-right:4px; margin-top:2px; opacity:.5;"></i>
                            <span id="m-address" style="font-size:13px; opacity:.6; line-height:1.5;"></span>
                        </div>
                    </div>

                    <!-- Info Pesanan -->
                    <div class="modal-section" style="margin-top:16px;">
                        <div class="modal-section-title">Info Pesanan</div>
                        <div style="display:flex; flex-direction:column; gap:8px; margin-top:8px;">
                            <div style="display:flex; justify-content:space-between; font-size:13px;">
                                <span style="opacity:.6;"><i class="fa-solid fa-box" style="margin-right:6px;"></i>Total Item</span>
                                <span id="m-total-items" style="font-weight:500;">—</span>
                            </div>
                            <div id="m-sqm-row" style="display:none; justify-content:space-between; font-size:13px;">
                                <span style="opacity:.6;"><i class="fa-solid fa-ruler-combined" style="margin-right:6px;"></i>Total Luas</span>
                                <span id="m-total-sqm" style="font-weight:500;">—</span>
                            </div>
                            <div id="m-pcs-row" style="display:none; justify-content:space-between; font-size:13px;">
                                <span style="opacity:.6;"><i class="fa-solid fa-cubes" style="margin-right:6px;"></i>Total Qty</span>
                                <span id="m-total-pcs" style="font-weight:500;">—</span>
                            </div>
                            <div id="m-est-row" style="display:none; justify-content:space-between; font-size:13px;">
                                <span style="opacity:.6;"><i class="fa-solid fa-calendar-check" style="margin-right:6px;"></i>Est. Selesai</span>
                                <span id="m-est-date" style="font-weight:500;">—</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        const STATUS_CONFIG = {
            indent: {
                label: 'Indent',
                icon: 'fa-hourglass-start',
                cls: 'badge-pending'
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
            on_delivery: {
                label: 'On Delivery',
                icon: 'fa-truck',
                cls: 'badge-production'
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

        const STATUS_FLOW = ['indent', 'on_progress', 'ready_to_deliver', 'on_delivery', 'done'];

        let cachedOrders = [];

        function doSearch() {
            const raw = document.getElementById('search-input').value.trim();
            const area = document.getElementById('results-area');
            if (!raw) {
                area.innerHTML = '';
                return;
            }

            area.innerHTML = `
                <div class="results-card" style="display:flex;flex-direction:column;gap:10px;padding:20px">
                    ${[1,2].map(() => `
                    <div style="display:flex;align-items:center;gap:14px;padding:14px 16px;border:0.5px solid var(--border2);border-radius:10px;">
                        <div class="skeleton" style="width:40px;height:40px;flex-shrink:0;border-radius:10px;"></div>
                        <div style="flex:1;display:flex;flex-direction:column;gap:7px">
                            <div class="skeleton" style="height:12px;width:38%;border-radius:4px;"></div>
                            <div class="skeleton" style="height:10px;width:55%;border-radius:4px;"></div>
                        </div>
                        <div class="skeleton" style="height:26px;width:100px;border-radius:20px;"></div>
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
                    <div class="empty-desc">Pastikan nomor order atau nomor WhatsApp sudah benar.</div>
                </div>`;
                return;
            }

            const rows = orders.map((o, i) => {
                const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;
                const qtyText = o.qty_sqm ? `${o.qty_sqm} m²` : `${o.qty_pcs} pcs`;
                return `
                <div class="order-row" onclick="openModal(${i})">
                    <div class="order-icon"><i class="fa-solid fa-gem"></i></div>
                    <div class="order-info">
                        <div class="order-id">${o.id}</div>
                        <div class="order-meta">${o.produk} · ${qtyText}</div>
                    </div>
                    <span class="badge ${st.cls}"><span class="badge-dot"></span>${st.label}</span>
                    <i class="fa-solid fa-chevron-right order-chevron"></i>
                </div>`;
            }).join('');

            area.innerHTML = `
            <div class="results-card">
                <div class="results-count">${orders.length} pesanan ditemukan</div>
                <div class="results-list">${rows}</div>
            </div>`;
        }

        function buildTimelineHtml(status, statusHistory = []) {
            const currentIdx = STATUS_FLOW.indexOf(status);
            const isRejected = status === 'rejected';

            // Buat map: status => changed_at
            const historyMap = {};
            statusHistory.forEach(h => {
                historyMap[h.status] = h.changed_at;
            });

            const steps = STATUS_FLOW.map((s, i) => {
                if (isRejected) {
                    return {
                        key: s,
                        label: s === 'done' ? 'Rejected' : STATUS_CONFIG[s].label,
                        done: i === 0,
                        active: false,
                        reject: s === 'done',
                    };
                }
                return {
                    key: s,
                    label: STATUS_CONFIG[s].label,
                    done: i < currentIdx,
                    active: i === currentIdx,
                    reject: false,
                };
            });

            const stepsHtml = steps.map((t, i) => {
                let dotCls = '';
                let labelCls = 'dim';
                if (t.reject) {
                    dotCls = 'reject';
                    labelCls = '';
                } else if (t.done) {
                    dotCls = 'done';
                    labelCls = 'done-lbl';
                } else if (t.active) {
                    dotCls = 'active';
                    labelCls = 'active';
                }

                const icon = t.done ? '<i class="fa-solid fa-check"></i>' :
                    t.reject ? '<i class="fa-solid fa-xmark"></i>' :
                    t.active ? '<i class="fa-solid fa-circle" style="font-size:7px"></i>' : '';

                // Tampilkan timestamp kalau ada di history
                const timestamp = historyMap[t.reject ? 'rejected' : t.key];
                const timeHtml = (t.done || t.active || t.reject) && timestamp ?
                    `<span style="font-size:11px; opacity:0.5; display:block;">${timestamp}</span>` :
                    '';

                const lineCls = i < steps.length - 1 ?
                    `itl-line ${steps[i].done ? 'done' : steps[i].active ? 'active' : ''}` :
                    '';

                return `
<div class="itl-step">
    <div class="itl-dot ${dotCls}">${icon}</div>
    <div style="display:flex; flex-direction:column; gap:2px;">
        <span class="itl-label ${labelCls}">${t.label}</span>
        ${timeHtml}
    </div>
</div>
       ${i < steps.length - 1 ? `<div class="${lineCls}"></div>` : ''}`;
            }).join('');

            return `<div class="item-timeline">${stepsHtml}</div>`;
        }

        function getInitial(name) {
            return (name || '?').trim().charAt(0).toUpperCase();
        }

        function openModal(index) {
            const o = cachedOrders[index];
            if (!o) return;
            const st = STATUS_CONFIG[o.status] || STATUS_CONFIG.pending;

            document.getElementById('m-order-id').textContent = o.id;
            document.getElementById('m-date').textContent = 'Dibuat ' + o.tanggal;
            document.getElementById('m-nama').textContent = o.nama;
            document.getElementById('m-phone').textContent = o.phone;
            document.getElementById('m-avatar').textContent = getInitial(o.nama);

            document.getElementById('m-status-badge').innerHTML =
                `<span class="badge ${st.cls}"><span class="badge-dot"></span>${st.label}</span>`;

            // Catatan
            const noteWrap = document.getElementById('m-catatan-wrap');
            if (o.catatan) {
                noteWrap.style.display = 'flex';
                document.getElementById('m-catatan').textContent = o.catatan;
            } else {
                noteWrap.style.display = 'none';
            }

            // Alamat
            const addrWrap = document.getElementById('m-address-wrap');
            if (o.address) {
                addrWrap.style.display = 'flex';
                addrWrap.style.alignItems = 'flex-start';
                document.getElementById('m-address').textContent = o.address;
            } else {
                addrWrap.style.display = 'none';
            }

            // Total items
            document.getElementById('m-total-items').textContent = o.items.length + ' item';

            // Total sqm
            const totalSqm = o.items.reduce((s, it) => s + (parseFloat(it.qty_sqm) || 0), 0);
            const sqmRow = document.getElementById('m-sqm-row');
            if (totalSqm > 0) {
                sqmRow.style.display = 'flex';
                document.getElementById('m-total-sqm').textContent = totalSqm.toFixed(2) + ' m²';
            } else {
                sqmRow.style.display = 'none';
            }

            // Total pcs
            const totalPcs = o.items.reduce((s, it) => s + (parseInt(it.qty_pcs) || 0), 0);
            const pcsRow = document.getElementById('m-pcs-row');
            if (totalPcs > 0) {
                pcsRow.style.display = 'flex';
                document.getElementById('m-total-pcs').textContent = totalPcs + ' pcs';
            } else {
                pcsRow.style.display = 'none';
            }

            // Estimated finish date
            const estRow = document.getElementById('m-est-row');
            if (o.estimated_finish_date) {
                estRow.style.display = 'flex';
                document.getElementById('m-est-date').textContent = o.estimated_finish_date;
            } else {
                estRow.style.display = 'none';
            }

            // Item cards
            document.getElementById('m-items-list').innerHTML = o.items.map(it => {
                const qtyVal = (it.qty_sqm != null && parseFloat(it.qty_sqm) > 0) ? parseFloat(it.qty_sqm).toFixed(2) : it.qty_pcs;
                const qtyUnit = (it.qty_sqm != null && parseFloat(it.qty_sqm) > 0) ? 'm²' : 'pcs';
                const metaParts = [];
                if (it.dimensi && it.dimensi !== '—') metaParts.push(`<span><i class="fa-solid fa-ruler-combined"></i> ${it.dimensi}</span>`);
                if (it.finishing && it.finishing !== '—') metaParts.push(`<span><i class="fa-solid fa-wand-magic-sparkles"></i> ${it.finishing}</span>`);
                if (it.unit_price) metaParts.push(`<span><i class="fa-solid fa-tag"></i> ${Number(it.unit_price).toLocaleString('id-ID', {style:'currency', currency:'IDR', maximumFractionDigits:0})}</span>`);

                return `
        <div class="item-card">
            <div class="item-card-header">
                <div class="item-card-icon"><i class="fa-solid fa-gem"></i></div>
                <div class="item-card-info">
                    <div class="item-card-name">${it.stone}</div>
                    ${metaParts.length ? `<div class="item-card-meta">${metaParts.join('')}</div>` : ''}
                </div>
                <div class="item-card-qty-wrap">
                    <div class="item-card-qty">${qtyVal}</div>
                    <div class="item-card-qty-unit">${qtyUnit}</div>
                </div>
            </div>
        </div>`;
            }).join('');

            document.getElementById('m-global-timeline').innerHTML = buildTimelineHtml(o.status, o.status_history || []);

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