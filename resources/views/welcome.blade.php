<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>TierraStone – Premium Natural Stone</title>
    <link rel="icon" type="image/avif" href="{{ asset('images/logos.avif') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300;1,9..40,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- UI/UX Improvements CSS -->
    <link rel="stylesheet" href="{{ asset('css/tierrastone-improvements.css') }}">

    <style>
        :root {
            --ink: #111111;
            --ink2: #1a1a1a;
            --body: #555555;
            --muted: #999999;
            --subtle: #bbbbbb;
            --border: #e0e0e0;
            --bg: #f5f5f3;
            --surface: #eaeae7;
            --white: #ffffff;
            --accent: #2a2a2a;

            /* Enhanced accent colors */
            --accent-primary: #8B7355;
            --accent-secondary: #A68A64;
            --accent-hover: #6D5940;

            --ff-display: 'Playfair Display', Georgia, serif;
            --ff-body: 'DM Sans', 'Helvetica Neue', sans-serif;
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
            font-size: 16px;
            scroll-padding-top: 80px;
        }

        body {
            font-family: var(--ff-body);
            background: var(--white);
            color: var(--ink);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-size: 16px;
            line-height: 1.6;
        }

        ::selection {
            background: var(--accent-primary);
            color: var(--white);
        }

        /* ══════ NAV ══════ */
        #nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all .5s cubic-bezier(.16, 1, .3, 1);
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.6) 0%,
                    rgba(0, 0, 0, 0.4) 60%,
                    transparent 100%);
        }

        #nav.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(24px) saturate(180%);
            padding: 18px 48px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .nav-logo {
            font-family: var(--ff-display);
            font-weight: 600;
            font-size: 20px;
            letter-spacing: .02em;
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            transition: color .5s;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        #nav.scrolled .nav-logo {
            color: var(--ink);
            text-shadow: none;
        }

        .nav-center {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav-link {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            position: relative;
            transition: all .3s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .nav-link:hover {
            color: #ffffff;
            transform: translateY(-1px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--accent-primary);
            transition: width .35s cubic-bezier(.16, 1, .3, 1);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        #nav.scrolled .nav-link {
            color: var(--ink);
            text-shadow: none;
        }

        #nav.scrolled .nav-link:hover {
            color: var(--ink2);
        }

        .nav-order {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .5);
            padding: 10px 28px;
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
        }

        .nav-order:hover {
            background: var(--white);
            color: var(--ink);
            border-color: var(--white);
        }

        #nav.scrolled .nav-order {
            color: var(--ink);
            border-color: var(--ink);
        }

        #nav.scrolled .nav-order:hover {
            background: var(--ink);
            color: var(--white);
            border-color: var(--ink);
        }

        .nav-mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            width: 44px;
            height: 44px;
            padding: 12px;
            position: relative;
            z-index: 110;
        }

        .nav-mobile-toggle span {
            display: block;
            width: 100%;
            height: 1.5px;
            background: var(--white);
            transition: all .35s cubic-bezier(.16, 1, .3, 1);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        #nav.scrolled .nav-mobile-toggle span {
            background: var(--ink);
        }

        .nav-mobile-toggle span:nth-child(1) {
            top: 12px;
        }

        .nav-mobile-toggle span:nth-child(2) {
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .nav-mobile-toggle span:nth-child(3) {
            bottom: 12px;
        }

        .nav-mobile-toggle.open span:nth-child(1) {
            top: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            background: var(--white);
        }

        .nav-mobile-toggle.open span:nth-child(2) {
            opacity: 0;
        }

        .nav-mobile-toggle.open span:nth-child(3) {
            bottom: 50%;
            transform: translate(-50%, 50%) rotate(-45deg);
            background: var(--white);
        }

        .mobile-menu {
            position: fixed;
            inset: 0;
            z-index: 105;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 32px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .4s ease;
        }

        .mobile-menu.open {
            opacity: 1;
            pointer-events: all;
        }

        .mobile-menu a {
            font-family: var(--ff-display);
            font-size: 32px;
            font-weight: 400;
            color: var(--white);
            text-decoration: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .4s ease, transform .4s ease;
        }

        .mobile-menu.open a {
            opacity: 1;
            transform: translateY(0);
        }

        .mobile-menu.open a:nth-child(1) {
            transition-delay: .1s;
        }

        .mobile-menu.open a:nth-child(2) {
            transition-delay: .15s;
        }

        .mobile-menu.open a:nth-child(3) {
            transition-delay: .2s;
        }

        .mobile-menu.open a:nth-child(4) {
            transition-delay: .25s;
        }

        @media (max-width: 768px) {
            #nav {
                padding: 20px 24px;
            }

            #nav.scrolled {
                padding: 16px 24px;
            }

            .nav-center,
            .nav-order {
                display: none;
            }

            .nav-mobile-toggle {
                display: block;
            }
        }

        /* ══════ HERO ══════ */
        #hero {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
            background: var(--ink);
        }

        .hero-video-wrap {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-video-wrap video,
        .hero-video-wrap .hero-video-fallback {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-video-fallback {
            background: var(--ink2);
        }

        .hero-video-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.75) 0%,
                    rgba(0, 0, 0, 0.4) 50%,
                    rgba(0, 0, 0, 0.2) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 0 48px 72px;
        }

        @media (max-width: 768px) {
            .hero-content {
                padding: 0 24px 56px;
            }
        }

        .hero-headline {
            font-family: var(--ff-display);
            font-size: clamp(42px, 7vw, 96px);
            font-weight: 400;
            line-height: 1.05;
            color: var(--white);
            letter-spacing: -.02em;
            max-width: 900px;
            opacity: 0;
            transform: translateY(40px);
            animation: heroIn .9s .3s cubic-bezier(.16, 1, .3, 1) forwards;
            text-shadow:
                0 2px 8px rgba(0, 0, 0, 0.4),
                0 4px 16px rgba(0, 0, 0, 0.3);
        }

        .hero-headline em {
            font-style: italic;
        }

        .hero-bottom-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
            gap: 32px;
            flex-wrap: wrap;
        }

        .hero-subtitle {
            font-size: 14px;
            font-weight: 400;
            line-height: 1.75;
            color: rgba(255, 255, 255, .7);
            max-width: 380px;
            opacity: 0;
            transform: translateY(20px);
            animation: heroIn .8s .55s cubic-bezier(.16, 1, .3, 1) forwards;
            backdrop-filter: blur(4px);
            background: rgba(0, 0, 0, 0.2);
            padding: 12px 20px;
            border-radius: 6px;
            display: inline-block;
        }

        .hero-order-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: var(--ff-body);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .4);
            padding: 16px 36px;
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            opacity: 0;
            transform: translateY(20px);
            animation: heroIn .8s .7s cubic-bezier(.16, 1, .3, 1) forwards;
        }

        .hero-order-btn:hover {
            background: var(--white);
            color: var(--ink);
            border-color: var(--white);
            padding-right: 44px;
        }

        .hero-order-btn i {
            font-size: 10px;
            transition: transform .3s ease;
        }

        .hero-order-btn:hover i {
            transform: translateX(4px);
        }

        .hero-scroll {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            opacity: 0;
            animation: heroIn 1s 1.1s ease forwards;
        }

        .hero-scroll-line {
            width: 1px;
            height: 48px;
            position: relative;
            overflow: hidden;
        }

        .hero-scroll-line::after {
            content: '';
            position: absolute;
            top: -100%;
            left: 0;
            width: 1px;
            height: 100%;
            background: rgba(255, 255, 255, .5);
            animation: scrollLine 2s 1.5s ease infinite;
        }

        @keyframes scrollLine {
            0% {
                top: -100%;
            }

            50% {
                top: 0;
            }

            100% {
                top: 100%;
            }
        }

        @keyframes heroIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══════ SECTION GLOBALS ══════ */
        .section-pad {
            padding: 140px 48px;
        }

        @media (max-width: 768px) {
            .section-pad {
                padding: 100px 24px;
            }
        }

        .section-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .24em;
            text-transform: uppercase;
            color: var(--accent-primary);
            margin-bottom: 24px;
            position: relative;
            display: inline-block;
        }

        .section-label::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--ink);
            opacity: 0;
            transition: all 0.6s cubic-bezier(.16, 1, .3, 1);
        }

        .section-label.visible::after {
            opacity: 0.3;
            width: 100%;
        }

        .section-heading {
            font-family: var(--ff-display);
            font-size: clamp(32px, 4.2vw, 56px);
            font-weight: 400;
            line-height: 1.2;
            color: var(--ink);
            letter-spacing: -.02em;
        }

        .section-heading em {
            font-style: italic;
        }

        /* ══════ INTRO ══════ */
        #intro {
            background: var(--white);
            padding: 100px 48px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            #intro {
                padding: 72px 24px;
            }
        }

        .intro-text {
            font-family: var(--ff-display);
            font-size: clamp(24px, 3.2vw, 42px);
            font-weight: 400;
            line-height: 1.45;
            color: var(--ink);
            text-align: center;
            max-width: 860px;
            letter-spacing: -.01em;
        }

        .intro-text em {
            font-style: italic;
            color: var(--muted);
        }

        /* Section separator */
        .section-separator {
            height: 1px;
            background: linear-gradient(to right,
                    transparent 0%,
                    var(--border) 20%,
                    var(--border) 80%,
                    transparent 100%);
            margin: 0 auto;
            max-width: 1200px;
        }

        /* ══════ PRODUCTS ══════ */
        #products {
            background: var(--white);
            padding: 0 48px 120px;
        }

        @media (max-width: 768px) {
            #products {
                padding: 0 24px 80px;
            }
        }

        .products-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 48px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            border-radius: 4px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        .product-card-img {
            width: 100%;
            height: 100%;
            min-height: 320px;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(.16, 1, .3, 1);
            filter: brightness(.92);
        }

        .product-card:hover .product-card-img {
            transform: scale(1.04);
        }

        .product-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.7) 0%,
                    rgba(0, 0, 0, 0.3) 40%,
                    rgba(0, 0, 0, 0) 70%);
            transition: background .4s ease;
        }

        .product-card:hover .product-card-overlay {
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.85) 0%,
                    rgba(0, 0, 0, 0.45) 50%,
                    rgba(0, 0, 0, 0.1) 80%);
        }

        .product-card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px;
            z-index: 2;
            transform: translateY(4px);
            transition: transform .5s cubic-bezier(.16, 1, .3, 1);
        }

        .product-card:hover .product-card-body {
            transform: translateY(0);
        }

        .product-card-name {
            font-family: var(--ff-display);
            font-size: 28px;
            font-weight: 400;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .product-card-sub {
            font-size: 13px;
            font-weight: 300;
            color: rgba(255, 255, 255, .55);
            letter-spacing: .02em;
        }

        .product-card-arrow {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 48px;
            height: 48px;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: var(--white);
            font-size: 14px;
            opacity: 0;
            transform: translateY(8px) scale(0.9);
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
        }

        .product-card:hover .product-card-arrow {
            opacity: 1;
            transform: translateY(0) scale(1);
            border-color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.15);
        }

        /* ══════ PROVIDES ══════ */
        #provides {
            background: var(--bg);
        }

        .provides-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 56px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .provides-desc {
            font-size: 15px;
            font-weight: 400;
            line-height: 1.75;
            color: var(--body);
            max-width: 420px;
        }

        .stone-carousel {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 900px) {
            .stone-carousel {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .stone-carousel {
                grid-template-columns: 1fr;
            }
        }

        .stone-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 3/4;
            border-radius: 6px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stone-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        }

        .stone-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s cubic-bezier(.16, 1, .3, 1), filter .4s;
            filter: brightness(.85) saturate(.9);
        }

        .stone-item:hover img {
            transform: scale(1.06);
            filter: brightness(.7) saturate(.85);
        }

        .stone-item-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.75) 0%,
                    rgba(0, 0, 0, 0.2) 50%,
                    transparent 70%);
            transition: background 0.4s ease;
        }

        .stone-item:hover .stone-item-overlay {
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.85) 0%,
                    rgba(0, 0, 0, 0.4) 60%,
                    rgba(0, 0, 0, 0.1) 85%);
        }

        .stone-item-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            z-index: 1;
        }

        .stone-item-name {
            font-family: var(--ff-display);
            font-size: 22px;
            font-weight: 400;
            color: var(--white);
            margin-bottom: 2px;
        }

        .stone-item-desc {
            font-size: 12px;
            font-weight: 300;
            color: rgba(255, 255, 255, .5);
        }

        .stone-item-line {
            width: 0;
            height: 2px;
            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0.8),
                    rgba(255, 255, 255, 0.3));
            margin-top: 16px;
            transition: width .6s cubic-bezier(.16, 1, .3, 1);
            border-radius: 2px;
        }

        .stone-item:hover .stone-item-line {
            width: 64px;
        }

        /* Add zoom icon */
        .stone-item::after {
            content: '\f00e';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            display: grid;
            place-items: center;
            color: white;
            font-size: 14px;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .stone-item:hover::after {
            opacity: 1;
            transform: scale(1);
        }

        /* ══════ ABOUT ══════ */
        #about {
            background: var(--ink);
            color: var(--white);
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 580px;
        }

        @media (max-width: 768px) {
            #about {
                grid-template-columns: 1fr;
            }
        }

        .about-left {
            padding: 100px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .about-left {
                padding: 64px 24px 48px;
            }
        }

        .about-left .section-label {
            color: rgba(255, 255, 255, .35);
        }

        .about-left .section-heading {
            color: var(--white);
            margin-bottom: 24px;
        }

        .about-body {
            font-size: 15px;
            font-weight: 400;
            line-height: 1.75;
            color: rgba(255, 255, 255, .5);
            max-width: 460px;
            margin-bottom: 36px;
        }

        .stone-3d-wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1200px;
            cursor: grab;
            position: relative;
            background: radial-gradient(circle at center,
                    rgba(255, 255, 255, 0.03) 0%,
                    transparent 70%);
        }

        .stone-3d-wrapper:active {
            cursor: grabbing;
        }

        .stone-3d-wrapper:hover .stone-3d img {
            filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.4)) drop-shadow(0 0 40px rgba(255, 255, 255, 0.1));
        }

        .stone-3d {
            width: 500px;
            height: 500px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.1s;
            will-change: transform;
        }

        .stone-3d img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.4));
            pointer-events: none;
            transition: filter 0.3s ease;
        }

        .stone-shine {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%),
                    rgba(255, 255, 255, 0.3) 0%,
                    transparent 60%);
            pointer-events: none;
            opacity: 0.6;
            mix-blend-mode: overlay;
        }

        .stone-hint {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.7);
            animation: hintPulse 2s ease-in-out infinite;
            background: rgba(0, 0, 0, 0.3);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes hintPulse {

            0%,
            100% {
                opacity: 0.7;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(-4px);
            }
        }

        .stone-3d-wrapper:active .stone-hint {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        @keyframes autoRotate {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }

        .stone-3d.auto-rotating {
            animation: autoRotate 20s linear infinite;
        }

        .about-stats {
            display: flex;
            gap: 40px;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, .1);
            flex-wrap: wrap;
        }

        .about-stat-num {
            font-family: var(--ff-display);
            font-size: 44px;
            font-weight: 400;
            color: var(--white);
            line-height: 1;
        }

        .about-stat-label {
            font-size: 11px;
            font-weight: 400;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .3);
            margin-top: 6px;
        }

        .about-right {
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        .about-right::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, var(--ink) 0%, transparent 30%);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .about-right {
                order: -1;
                min-height: 260px;
            }

            .about-right::after {
                background: linear-gradient(to top, var(--ink) 0%, transparent 40%);
            }

            .stone-3d {
                width: 100%;
                max-width: 400px;
                height: 400px;
            }

            .stone-hint {
                font-size: 11px;
                bottom: 20px;
                padding: 6px 14px;
            }
        }

        /* ══════ CTA ══════ */
        #cta {
            background: var(--white);
            padding: 120px 48px;
            text-align: center;
            position: relative;
        }

        @media (max-width: 768px) {
            #cta {
                padding: 80px 24px;
            }
        }

        .cta-heading {
            font-family: var(--ff-display);
            font-size: clamp(36px, 5vw, 72px);
            font-weight: 400;
            line-height: 1.1;
            color: var(--ink);
            letter-spacing: -.02em;
            margin-bottom: 20px;
        }

        .cta-heading em {
            font-style: italic;
        }

        .cta-sub {
            font-size: 15px;
            font-weight: 300;
            color: var(--body);
            margin-bottom: 40px;
            line-height: 1.7;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .cta-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: var(--ff-body);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            background: var(--ink);
            padding: 18px 44px;
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .cta-btn-primary:hover {
            background: var(--ink2);
            padding-right: 52px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
        }

        .cta-btn-primary i {
            font-size: 12px;
            transition: transform .3s ease;
        }

        .cta-btn-primary:hover i {
            transform: translateX(4px);
        }

        .cta-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: var(--ff-body);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
            border: 1.5px solid var(--border);
            padding: 18px 40px;
            transition: all .4s cubic-bezier(.16, 1, .3, 1);
            border-radius: 4px;
            background: transparent;
        }

        .cta-btn-secondary:hover {
            border-color: var(--ink);
            background: var(--bg);
            transform: translateY(-2px);
        }

        .cta-btn-secondary i {
            font-size: 12px;
        }

        .cta-note {
            margin-top: 24px;
            font-size: 12px;
            font-weight: 300;
            color: var(--muted);
        }

        /* ══════ FOOTER ══════ */
        footer {
            background: var(--ink);
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        @media (max-width: 768px) {
            footer {
                padding: 24px;
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }

        .footer-copy {
            font-size: 11px;
            font-weight: 300;
            letter-spacing: .04em;
            color: white;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .footer-link {
            font-size: 11px;
            font-weight: 300;
            color: rgba(255, 255, 255, .25);
            text-decoration: none;
            transition: color .3s;
        }

        .footer-link:hover {
            color: white;
        }

        /* ══════ SCROLL REVEAL ══════ */
        .rv {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.16, 1, .3, 1);
        }

        .rv.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .rv-d1 {
            transition-delay: .08s;
        }

        .rv-d2 {
            transition-delay: .16s;
        }

        .rv-d3 {
            transition-delay: .24s;
        }

        .rv-d4 {
            transition-delay: .32s;
        }

        .img-rv {
            opacity: 0;
            transform: translateY(48px) scale(.97);
            transition: opacity .8s ease, transform .9s cubic-bezier(.16, 1, .3, 1);
        }

        .img-rv.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .img-rv-d1 {
            transition-delay: .1s;
        }

        .img-rv-d2 {
            transition-delay: .2s;
        }

        .img-rv-d3 {
            transition-delay: .3s;
        }

        .img-rv-d4 {
            transition-delay: .4s;
        }

        .line-reveal {
            width: 0;
            height: 1px;
            background: var(--border);
            transition: width .8s cubic-bezier(.16, 1, .3, 1);
        }

        .line-reveal.visible {
            width: 100%;
        }

        /* ══════ ACCESSIBILITY ══════ */
        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent-primary);
            outline-offset: 4px;
            border-radius: 4px;
        }

        /* ══════ SCROLLBAR ══════ */
        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-track {
            background: var(--white);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--subtle);
        }

        /* ══════ REDUCED MOTION ══════ */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ══════ MOBILE OPTIMIZATIONS ══════ */
        @media (max-width: 768px) {
            body {
                font-size: 15px;
            }

            .section-heading {
                line-height: 1.15;
            }

            .hero-headline {
                line-height: 1.1;
            }

            .hero-subtitle {
                font-size: 15px;
                line-height: 1.7;
            }

            .rv {
                transform: translateY(20px);
                transition-duration: 0.5s;
            }

            .img-rv {
                transform: translateY(24px) scale(0.98);
                transition-duration: 0.6s;
            }
        }
    </style>
</head>

<body>

    <!-- ═══ MOBILE MENU ═══ -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#products" onclick="closeMobile()">Products</a>
        <a href="#provides" onclick="closeMobile()">Provides</a>
        <a href="#about" onclick="closeMobile()">About</a>
        <a href="{{ route('order') }}" onclick="closeMobile()">Order</a>
    </div>

    <!-- ═══ NAV ═══ -->
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

    <!-- ═══ HERO ═══ -->
    <section id="hero">
        <div class="hero-video-wrap">
            <video autoplay muted loop playsinline poster="">
                <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-video-fallback" style="background:linear-gradient(135deg,#1a1a1a 0%,#2a2a2a 100%)"></div>
        </div>
        <div class="hero-video-overlay"></div>

        <div class="hero-content">
            <h1 class="hero-headline">
                Batu alam <em>pilihan</em><br>untuk setiap proyek.
            </h1>
            <div class="hero-bottom-row">
                <p class="hero-subtitle">
                    Penyedia material batu alam berkualitas tinggi untuk konstruksi, landscape, dan desain interior premium.
                </p>
                <a href="{{ route('order') }}" class="hero-order-btn">
                    Order Now <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="hero-scroll">
            <div class="hero-scroll-line"></div>
        </div>
    </section>

    <!-- ═══ INTRO TEXT ═══ -->
    <section id="intro">
        <p class="intro-text rv">
            TierraStone hadir sebagai mitra terpercaya dalam memilih <em>batu alam terbaik</em> — kuat, elegan, dan tahan lama untuk setiap proyek impian Anda.
        </p>
    </section>

    <!-- ADD: Section Separator -->
    <div class="section-separator rv"></div>

    <!-- ═══ PRODUCTS — Featured Projects ═══ -->
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

    </section>

    <!-- ADD: Section Separator -->
    <div class="section-separator rv"></div>

    <!-- ═══ PROVIDES — Stone Types ═══ -->
    <section id="provides" class="section-pad">
        <div class="provides-header">
            <div class="rv">
                <p class="section-label">Materials</p>
                <h2 class="section-heading">Batu Alam <em>Kami</em></h2>
            </div>
            <p class="provides-desc rv rv-d1">
                Setiap batu diseleksi ketat — hanya material dengan densitas, warna, dan tekstur terbaik yang lolos kurasi tim kami.
            </p>
        </div>

        <div class="stone-carousel">
            <div class="stone-item img-rv img-rv-d1">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Marmer" loading="lazy">
                <div class="stone-item-overlay"></div>
                <div class="stone-item-body">
                    <div class="stone-item-name">Marmer Premium</div>
                    <div class="stone-item-desc">Interior mewah</div>
                    <div class="stone-item-line"></div>
                </div>
            </div>
            <div class="stone-item img-rv img-rv-d2">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Granit" loading="lazy">
                <div class="stone-item-overlay"></div>
                <div class="stone-item-body">
                    <div class="stone-item-name">Granit Alam</div>
                    <div class="stone-item-desc">Outdoor & dapur</div>
                    <div class="stone-item-line"></div>
                </div>
            </div>
            <div class="stone-item img-rv img-rv-d3">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Andesit" loading="lazy">
                <div class="stone-item-overlay"></div>
                <div class="stone-item-body">
                    <div class="stone-item-name">Batu Andesit</div>
                    <div class="stone-item-desc">Fasad & dinding</div>
                    <div class="stone-item-line"></div>
                </div>
            </div>
            <div class="stone-item img-rv img-rv-d4">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Landscape" loading="lazy">
                <div class="stone-item-overlay"></div>
                <div class="stone-item-body">
                    <div class="stone-item-name">Batu Landscape</div>
                    <div class="stone-item-desc">Taman & kolam</div>
                    <div class="stone-item-line"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ADD: Section Separator -->
    <div class="section-separator rv"></div>

    <!-- ═══ ABOUT ═══ -->
    <section id="about">
        <div class="about-left">
            <p class="section-label rv">About</p>
            <h2 class="section-heading rv rv-d1">Pabrik Batu Alam <em>dari Yogyakarta,</em> Indonesia.</h2>
            <p class="about-body rv rv-d2">
                TierraStone adalah perusahaan yang terdaftar di Indonesia dengan nama PT Priadhi Husada. Sejak tahun 1990-an, kami telah bekerja sama dengan Pemerintah Indonesia untuk proyek pemugaran Candi Borobudur. Sejak saat itu, kami dipercaya menyediakan material batu alam untuk rumah, kafe, hotel, dan villa di seluruh Indonesia.
            </p>
            <p class="about-body rv rv-d2" style="margin-top: -16px;">
                Produk kami merupakan grade ekspor — pernah melakukan ekspor ke Jerman, Belgia, Australia, dan Jepang.
            </p>
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

    <!-- ADD: Section Separator -->
    <div class="section-separator rv"></div>

    <!-- ═══ CTA ═══ -->
    <section id="cta">
        <p class="section-label rv">Mulai Sekarang</p>
        <h2 class="cta-heading rv rv-d1">
            Siap wujudkan<br>proyek <em>impian</em> Anda?
        </h2>
        <p class="cta-sub rv rv-d2">Konsultasi gratis — respons via WhatsApp jam kerja 08.00–17.00 WIB</p>
        <div class="cta-buttons rv rv-d3">
            <a href="{{ route('order') }}" class="cta-btn-primary">
                Buat Pesanan <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="{{ route('orders.track') }}" class="cta-btn-secondary">
                <i class="fa-solid fa-magnifying-glass"></i> Lacak Pesanan
            </a>
        </div>
        <p class="cta-note rv rv-d4">
            <i class="fa-brands fa-whatsapp" style="margin-right:4px"></i>
            Tersertifikasi · Pengiriman Nasional · Stok Ready
        </p>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="footer-copy">&copy; 2026 TierraStone. All rights reserved.</div>
        <div class="footer-right">
            <a href="#products" class="footer-link">Products</a>
            <a href="#provides" class="footer-link">Provides</a>
            <a href="#about" class="footer-link">About</a>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', scrollY > 60);
        }, {
            passive: true
        });

        const toggle = document.getElementById('navToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('open');
            mobileMenu.classList.toggle('open');
            document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
        });

        function closeMobile() {
            toggle.classList.remove('open');
            mobileMenu.classList.remove('open');
            document.body.style.overflow = '';
        }

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        });

        document.querySelectorAll('.rv, .img-rv, .line-reveal, .section-separator').forEach(el => {
            revealObserver.observe(el);
        });

        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const hero = document.getElementById('hero');
                    if (hero) {
                        const scrolled = window.scrollY;
                        const overlay = hero.querySelector('.hero-video-overlay');
                        if (overlay && scrolled < window.innerHeight) {
                            overlay.style.opacity = 0.35 + (scrolled / window.innerHeight) * 0.35;
                        }
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }, {
            passive: true
        });

        (function initStone3D() {
            const stone = document.getElementById('stone3d');
            if (!stone) return;

            let isDragging = false;
            let currentX = 0;
            let currentY = 0;
            let rotationX = 0;
            let rotationY = 0;
            let velocityX = 0;
            let velocityY = 0;
            let autoRotateTimeout;

            stone.classList.add('auto-rotating');

            function updateStone() {
                stone.style.transform = `rotateX(${rotationX}deg) rotateY(${rotationY}deg)`;
                const shineX = 50 + (rotationY / 3.6);
                const shineY = 50 + (rotationX / 3.6);
                const shineEl = stone.querySelector('.stone-shine');
                if (shineEl) {
                    shineEl.style.setProperty('--shine-x', `${shineX}%`);
                    shineEl.style.setProperty('--shine-y', `${shineY}%`);
                }
            }

            function onStart(e) {
                isDragging = true;
                stone.classList.remove('auto-rotating');
                clearTimeout(autoRotateTimeout);
                const clientX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                const clientY = e.type.includes('mouse') ? e.clientY : e.touches[0].clientY;
                currentX = clientX;
                currentY = clientY;
                velocityX = 0;
                velocityY = 0;
            }

            function onMove(e) {
                if (!isDragging) return;
                e.preventDefault();
                const clientX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                const clientY = e.type.includes('mouse') ? e.clientY : e.touches[0].clientY;
                const deltaX = clientX - currentX;
                const deltaY = clientY - currentY;
                velocityX = deltaX * 0.5;
                velocityY = deltaY * 0.5;
                rotationY += velocityX;
                rotationX -= velocityY;
                rotationX = Math.max(-90, Math.min(90, rotationX));
                currentX = clientX;
                currentY = clientY;
                updateStone();
            }

            function onEnd() {
                isDragging = false;
                let momentum = () => {
                    if (Math.abs(velocityX) > 0.1 || Math.abs(velocityY) > 0.1) {
                        velocityX *= 0.95;
                        velocityY *= 0.95;
                        rotationY += velocityX;
                        rotationX -= velocityY;
                        rotationX = Math.max(-90, Math.min(90, rotationX));
                        updateStone();
                        requestAnimationFrame(momentum);
                    } else {
                        autoRotateTimeout = setTimeout(() => {
                            stone.classList.add('auto-rotating');
                        }, 3000);
                    }
                };
                requestAnimationFrame(momentum);
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
        // ══════ ENHANCED SMOOTH SCROLL REVEAL ══════
        (function initSmoothScroll() {
            // Intersection Observer dengan threshold dinamis
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add visible class with slight delay for smoother effect
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, 50);
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all reveal elements
            document.querySelectorAll('.rv, .img-rv, .line-reveal, .section-separator').forEach(el => {
                revealObserver.observe(el);
            });
        })();

        // ══════ SMOOTH SCROLL FOR ANCHOR LINKS ══════
        // ══════ ULTRA SMOOTH SCROLL ══════
        function smoothScrollTo(target, duration = 1000) {
            const start = window.pageYOffset;
            const targetPosition = target.offsetTop - 80;
            const distance = targetPosition - start;
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const run = easeInOutCubic(timeElapsed, start, distance, duration);
                window.scrollTo(0, run);
                if (timeElapsed < duration) requestAnimationFrame(animation);
            }

            function easeInOutCubic(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t * t + b;
                t -= 2;
                return c / 2 * (t * t * t + 2) + b;
            }

            requestAnimationFrame(animation);
        }

        // Apply to all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                e.preventDefault();
                const target = document.querySelector(targetId);

                if (target) {
                    smoothScrollTo(target);
                    history.pushState(null, null, targetId);
                }
            });
        });

        // ══════ PARALLAX EFFECT FOR HERO VIDEO (Optional) ══════
        let parallaxTicking = false;
        window.addEventListener('scroll', () => {
            if (!parallaxTicking) {
                requestAnimationFrame(() => {
                    const hero = document.getElementById('hero');
                    if (hero) {
                        const scrolled = window.scrollY;
                        const videoWrap = hero.querySelector('.hero-video-wrap');

                        if (scrolled < window.innerHeight && videoWrap) {
                            // Subtle parallax effect
                            videoWrap.style.transform = `translateY(${scrolled * 0.5}px)`;
                        }

                        // Enhanced overlay opacity
                        const overlay = hero.querySelector('.hero-video-overlay');
                        if (overlay && scrolled < window.innerHeight) {
                            overlay.style.opacity = 0.35 + (scrolled / window.innerHeight) * 0.4;
                        }
                    }
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        }, {
            passive: true
        });

        // ══════ LAZY LOAD IMAGE FADE IN ══════
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // ══════ NAVBAR SCROLL ENHANCEMENT ══════
        const nav = document.getElementById('nav');
        let lastScrollTop = 0;
        let scrollTimeout;

        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);

            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add/remove scrolled class with smoother transition
            nav.classList.toggle('scrolled', scrollTop > 60);

            // Optional: Hide navbar on scroll down, show on scroll up
            // Uncomment if you want this behavior
            /*
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                nav.style.transform = 'translateY(-100%)';
            } else {
                nav.style.transform = 'translateY(0)';
            }
            */

            lastScrollTop = scrollTop;
        }, {
            passive: true
        });

        // ══════ PERFORMANCE: Debounce Resize Events ══════
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // Any resize-dependent calculations here
                console.log('Window resized');
            }, 250);
        }, {
            passive: true
        });

        // ══════ PREVENT SCROLL JANK ON MOBILE ══════
        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');
        }
    </script>
</body>

</html>