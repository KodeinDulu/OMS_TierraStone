<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>TierraStone – Premium Natural Stone</title>
    <link rel="icon" type="image/avif" href="{{ asset('images/logos.avif') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300;1,9..40,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#products" onclick="closeMobile()">Products</a>
        <a href="#provides" onclick="closeMobile()">Provides</a>
        <a href="#about" onclick="closeMobile()">About</a>
        <a href="{{ route('order') }}" onclick="closeMobile()">Order</a>
    </div>

    <!-- Nav -->
    <nav id="nav">
        <a href="{{ route('welcome') }}" class="nav-logo">TierraStone</a>
        <div class="nav-center">
            <a href="#products" class="nav-link">Products</a>
            <a href="#provides" class="nav-link">Provides</a>
            <a href="#about" class="nav-link">About</a>
        </div>
        <a href="{{ route('order') }}" class="nav-order">Order</a>
        <button class="nav-mobile-toggle" id="navToggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- Hero -->
    <section id="hero">
        <div class="hero-video-wrap">
            <video autoplay muted loop playsinline poster="">
                <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-video-fallback" style="background:linear-gradient(135deg,#1a1a1a 0%,#2a2a2a 100%)"></div>
        </div>
        <div class="hero-video-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-headline">Batu alam <em>pilihan</em><br>untuk setiap proyek.</h1>
            <div class="hero-bottom-row">
                <p class="hero-subtitle">Penyedia material batu alam berkualitas tinggi untuk konstruksi, landscape, dan desain interior premium.</p>
                <a href="{{ route('order') }}" class="hero-order-btn">Order Now <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="hero-scroll">
            <div class="hero-scroll-line"></div>
        </div>
    </section>

    <!-- Intro -->
    <section id="intro">
        <p class="intro-text rv">TierraStone hadir sebagai mitra terpercaya dalam memilih <em>batu alam terbaik</em> — kuat, elegan, dan tahan lama untuk setiap proyek impian Anda.</p>
    </section>

    <div class="section-separator rv"></div>

    <!-- Products -->
    <section id="products">
        <div class="products-top rv">
            <div>
                <p class="section-label">Featured</p>
                <h2 class="section-heading">Hasil <em>Proyek</em></h2>
            </div>
        </div>
        <div class="products-grid">
            <div class="product-card img-rv img-rv-d1">
                <img src="{{ asset('images/hasil.png') }}" alt="Villa Batu Alam" class="product-card-img" loading="lazy">
                <div class="product-card-overlay"></div>
                <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                <div class="product-card-body">
                    <div class="product-card-name">Lobby Granit</div>
                    <div class="product-card-sub">Residential · Yogyakarta</div>
                </div>
            </div>
            <div class="product-card img-rv img-rv-d1">
                <img src="{{ asset('images/image.png') }}" alt="Lobby Granit" class="product-card-img" loading="lazy">
                <div class="product-card-overlay"></div>
                <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                <div class="product-card-body">
                    <div class="product-card-name">Kolam renang</div>
                    <div class="product-card-sub">Residential · Yogyakarta</div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-separator rv"></div>

    <!-- Provides -->
    <section id="provides" class="section-pad">
        <div class="provides-header">
            <div class="rv">
                <p class="section-label">Materials</p>
                <h2 class="section-heading">Batu Alam <em>Kami</em></h2>
            </div>
            <p class="provides-desc rv rv-d1">Setiap batu diseleksi ketat — hanya material dengan densitas, warna, dan tekstur terbaik yang lolos kurasi tim kami.</p>
        </div>
        <div class="stone-carousel">
            @forelse($stoneTypes as $stone)
            <div class="stone-item img-rv img-rv-d{{ (($loop->index % 4) + 1) }}">
                <img src="{{ $stone->reference_image ? asset('storage/' . $stone->reference_image) : asset('images/stone-default.png') }}" alt="{{ $stone->name }}" loading="lazy">
                <div class="stone-item-overlay"></div>
                <div class="stone-item-body">
                    <div class="stone-item-name">{{ $stone->name }}</div>
                    <div class="stone-item-desc">{{ $stone->description ?? 'Deskripsi tidak tersedia' }}</div>
                    <div class="stone-item-line"></div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0;">
                <p style="color: var(--muted); font-size: 18px;">Tidak ada jenis batu yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </section>

    <div class="section-separator rv"></div>

    <!-- About -->
    <section id="about">
        <div class="about-left">
            <p class="section-label rv">About</p>
            <h2 class="section-heading rv rv-d1">Pabrik Batu Alam <em>dari Yogyakarta,</em> Indonesia.</h2>
            <p class="about-body rv rv-d2">TierraStone adalah perusahaan yang terdaftar di Indonesia dengan nama PT Priadhi Husada. Sejak tahun 1990-an, kami telah bekerja sama dengan Pemerintah Indonesia untuk proyek pemugaran Candi Borobudur. Sejak saat itu, kami dipercaya menyediakan material batu alam untuk rumah, kafe, hotel, dan villa di seluruh Indonesia.</p>
            <p class="about-body rv rv-d2" style="margin-top: -16px;">Produk kami merupakan grade ekspor — pernah melakukan ekspor ke Jerman, Belgia, Australia, dan Jepang.</p>
            <div class="about-stats rv rv-d3">
                <div>
                    <div class="about-stat-num">30+</div>
                    <div class="about-stat-label">Tahun Pengalaman</div>
                </div>
                <div>
                    <div class="about-stat-num">4</div>
                    <div class="about-stat-label">Negara Ekspor</div>
                </div>
                <div>
                    <div class="about-stat-num">30+</div>
                    <div class="about-stat-label">Jenis Material</div>
                </div>
            </div>
            <div class="rv rv-d4" style="margin-top: 28px; font-size: 13px; font-weight: 300; color: rgba(255,255,255,.35); line-height: 1.7;">
                <div style="margin-bottom: 4px;">
                    <i class="fa-solid fa-location-dot" style="margin-right: 6px; font-size: 11px;"></i>
                    Jl Magelang km 15, 55515 Yogyakarta, Indonesia
                </div>
                <div>
                    <i class="fa-solid fa-envelope" style="margin-right: 6px; font-size: 11px;"></i>
                    tierrastone.id@gmail.com
                </div>
            </div>
        </div>
        <div class="about-right">
            <div class="stone-3d-wrapper">
                <div class="stone-3d" id="stone3d">
                    <img src="https://imagedelivery.net/6Q4HLLMjcXxpmSYfQ3vMaw/333ecafa-8d04-4a3c-1d1b-654eb23ff000/900px" alt="3D Stone">
                    <div class="stone-shine"></div>
                </div>
                <div class="stone-hint">Drag to rotate</div>
            </div>
        </div>
    </section>

    <div class="section-separator rv"></div>

    <!-- CTA -->
    <section id="cta">
        <p class="section-label rv">Mulai Sekarang</p>
        <h2 class="cta-heading rv rv-d1">Siap wujudkan<br>proyek <em>impian</em> Anda?</h2>
        <p class="cta-sub rv rv-d2">Konsultasi gratis — respons via WhatsApp jam kerja 08.00–17.00 WIB</p>
        <div class="cta-buttons rv rv-d3">
            <a href="{{ route('order') }}" class="cta-btn-primary">Buat Pesanan <i class="fa-solid fa-arrow-right"></i></a>
            <a href="{{ route('orders.track') }}" class="cta-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Lacak Pesanan</a>
        </div>
        <p class="cta-note rv rv-d4">
            <i class="fa-brands fa-whatsapp" style="margin-right:4px"></i>
            Tersertifikasi · Pengiriman Nasional · Stok Ready
        </p>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-copy">&copy; 2026 TierraStone. All rights reserved.</div>
        <div class="footer-right">
            <a href="#products" class="footer-link">Products</a>
            <a href="#provides" class="footer-link">Provides</a>
            <a href="#about" class="footer-link">About</a>
        </div>
    </footer>

    <script>
        (function() {
            'use strict';

            // ── References ──
            const nav = document.getElementById('nav');
            const toggle = document.getElementById('navToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const hero = document.getElementById('hero');

            // ── Mobile Menu ──
            toggle.addEventListener('click', () => {
                toggle.classList.toggle('open');
                mobileMenu.classList.toggle('open');
                document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
            });

            window.closeMobile = function() {
                toggle.classList.remove('open');
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            };

            // ── Scroll: Nav + Parallax + Overlay (single listener) ──
            let scrollTicking = false;

            window.addEventListener('scroll', () => {
                if (!scrollTicking) {
                    requestAnimationFrame(() => {
                        const scrollY = window.scrollY;

                        // Nav scroll state
                        nav.classList.toggle('scrolled', scrollY > 60);

                        // Hero parallax & overlay
                        if (hero && scrollY < window.innerHeight) {
                            const videoWrap = hero.querySelector('.hero-video-wrap');
                            const overlay = hero.querySelector('.hero-video-overlay');
                            if (videoWrap) videoWrap.style.transform = `translateY(${scrollY * 0.5}px)`;
                            if (overlay) overlay.style.opacity = 0.35 + (scrollY / window.innerHeight) * 0.4;
                        }

                        scrollTicking = false;
                    });
                    scrollTicking = true;
                }
            }, {
                passive: true
            });

            // ── Scroll Reveal (single observer) ──
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('visible'), 50);
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.rv, .img-rv, .line-reveal, .section-separator').forEach(el => {
                revealObserver.observe(el);
            });

            // ── Lazy Load Image Fade ──
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('loaded');
                            imageObserver.unobserve(entry.target);
                        }
                    });
                });
                document.querySelectorAll('img[loading="lazy"]').forEach(img => imageObserver.observe(img));
            }

            // ── Smooth Scroll for Anchor Links ──
            function smoothScrollTo(target, duration) {
                duration = duration || 1000;
                const start = window.pageYOffset;
                const targetPos = target.offsetTop - 80;
                const distance = targetPos - start;
                let startTime = null;

                function easeInOutCubic(t, b, c, d) {
                    t /= d / 2;
                    if (t < 1) return c / 2 * t * t * t + b;
                    t -= 2;
                    return c / 2 * (t * t * t + 2) + b;
                }

                function step(currentTime) {
                    if (!startTime) startTime = currentTime;
                    const elapsed = currentTime - startTime;
                    window.scrollTo(0, easeInOutCubic(elapsed, start, distance, duration));
                    if (elapsed < duration) requestAnimationFrame(step);
                }

                requestAnimationFrame(step);
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const id = this.getAttribute('href');
                    if (id === '#') return;
                    e.preventDefault();
                    const target = document.querySelector(id);
                    if (target) {
                        smoothScrollTo(target);
                        history.pushState(null, null, id);
                    }
                });
            });

            // ── 3D Stone Rotation ──
            (function() {
                const stone = document.getElementById('stone3d');
                if (!stone) return;

                let isDragging = false;
                let currentX = 0,
                    currentY = 0;
                let rotationX = 0,
                    rotationY = 0;
                let velocityX = 0,
                    velocityY = 0;
                let autoRotateTimer;

                stone.classList.add('auto-rotating');

                function updateStone() {
                    stone.style.transform = `rotateX(${rotationX}deg) rotateY(${rotationY}deg)`;
                    const shine = stone.querySelector('.stone-shine');
                    if (shine) {
                        shine.style.setProperty('--shine-x', `${50 + rotationY / 3.6}%`);
                        shine.style.setProperty('--shine-y', `${50 + rotationX / 3.6}%`);
                    }
                }

                function getXY(e) {
                    const t = e.touches ? e.touches[0] : e;
                    return {
                        x: t.clientX,
                        y: t.clientY
                    };
                }

                function onStart(e) {
                    isDragging = true;
                    stone.classList.remove('auto-rotating');
                    clearTimeout(autoRotateTimer);
                    const p = getXY(e);
                    currentX = p.x;
                    currentY = p.y;
                    velocityX = 0;
                    velocityY = 0;
                }

                function onMove(e) {
                    if (!isDragging) return;
                    e.preventDefault();
                    const p = getXY(e);
                    velocityX = (p.x - currentX) * 0.5;
                    velocityY = (p.y - currentY) * 0.5;
                    rotationY += velocityX;
                    rotationX = Math.max(-90, Math.min(90, rotationX - velocityY));
                    currentX = p.x;
                    currentY = p.y;
                    updateStone();
                }

                function onEnd() {
                    isDragging = false;
                    (function momentum() {
                        if (Math.abs(velocityX) > 0.1 || Math.abs(velocityY) > 0.1) {
                            velocityX *= 0.95;
                            velocityY *= 0.95;
                            rotationY += velocityX;
                            rotationX = Math.max(-90, Math.min(90, rotationX - velocityY));
                            updateStone();
                            requestAnimationFrame(momentum);
                        } else {
                            autoRotateTimer = setTimeout(() => stone.classList.add('auto-rotating'), 3000);
                        }
                    })();
                }

                stone.addEventListener('mousedown', onStart);
                document.addEventListener('mousemove', onMove);
                document.addEventListener('mouseup', onEnd);
                stone.addEventListener('touchstart', onStart, {
                    passive: false
                });
                document.addEventListener('touchmove', onMove, {
                    passive: false
                });
                document.addEventListener('touchend', onEnd);
            })();

            // ── Mobile detection ──
            if ('ontouchstart' in window) document.body.classList.add('touch-device');

        })();
    </script>

</body>

</html>