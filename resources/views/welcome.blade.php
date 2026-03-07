<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TierraStone – Premium Natural Stone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ── TOKENS ── */
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
            overflow-x: hidden;
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
            transition: width .3s ease, height .3s ease, border-color .3s;
        }

        body:has(a:hover) .cur-ring,
        body:has(button:hover) .cur-ring {
            width: 48px;
            height: 48px;
            border-color: var(--blue);
        }

        /* ── NOISE TEXTURE (very subtle) ── */
        .noise {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 200;
            opacity: .3;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
        }

        /* ── NAV ── */
        #nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 22px 56px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all .4s ease;
        }

        #nav.scrolled {
            background: rgba(245, 249, 253, .92);
            backdrop-filter: blur(20px);
            padding: 14px 56px;
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

        .nav-links {
            display: flex;
            align-items: center;
            gap: 36px;
        }

        .nav-link {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: var(--body);
            text-decoration: none;
            position: relative;
            transition: color .2s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--blue);
            transition: width .3s ease;
        }

        .nav-link:hover {
            color: var(--blue);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-cta {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: var(--white);
            background: var(--blue);
            padding: 10px 26px;
            text-decoration: none;
            border-radius: 2px;
            transition: all .25s ease;
            box-shadow: 0 4px 14px rgba(42, 125, 225, .3);
        }

        .nav-cta:hover {
            background: var(--blue2);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(42, 125, 225, .38);
        }

        .nav-mobile {
            display: none;
            align-items: center;
            gap: 14px;
        }

        @media (max-width: 768px) {
            #nav {
                padding: 18px 24px;
            }

            #nav.scrolled {
                padding: 12px 24px;
            }

            .nav-links {
                display: none;
            }

            .nav-mobile {
                display: flex;
            }
        }

        /* ── HERO ── */
        #hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 55% 45%;
            position: relative;
            overflow: hidden;
            background: var(--white);
        }

        @media (max-width: 768px) {
            #hero {
                grid-template-columns: 1fr;
            }
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 120px 72px 80px;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .hero-left {
                padding: 120px 24px 56px;
            }
        }

        /* Decorative circle behind text */
        .hero-left::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(42, 125, 225, .06) 0%, transparent 70%);
            top: 50%;
            left: -100px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
            opacity: 0;
            animation: fadeUp .6s .15s cubic-bezier(.22, 1, .36, 1) forwards;
        }

        .hero-tag-dash {
            width: 32px;
            height: 1.5px;
            background: var(--blue);
        }

        .hero-tag span {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--blue);
        }

        .hero-title {
            font-family: 'Cormorant', serif;
            font-size: clamp(58px, 6.5vw, 96px);
            font-weight: 300;
            line-height: .92;
            color: var(--ink);
            margin-bottom: 32px;
            opacity: 0;
            animation: fadeUp .75s .28s cubic-bezier(.22, 1, .36, 1) forwards;
        }

        .hero-title em {
            font-style: italic;
            color: var(--blue);
        }

        .hero-title .stroke {
            -webkit-text-stroke: 1.5px var(--stone);
            color: transparent;
        }

        .hero-sub {
            font-size: 15px;
            font-weight: 400;
            line-height: 1.8;
            color: var(--body);
            max-width: 400px;
            margin-bottom: 48px;
            opacity: 0;
            animation: fadeUp .75s .42s cubic-bezier(.22, 1, .36, 1) forwards;
        }

        .hero-btns {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .75s .55s cubic-bezier(.22, 1, .36, 1) forwards;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 28px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 2px;
            transition: all .25s ease;
        }

        .btn-blue {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 4px 16px rgba(42, 125, 225, .28);
        }

        .btn-blue:hover {
            background: var(--blue2);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(42, 125, 225, .36);
        }

        .btn-ghost {
            border: 1.5px solid var(--border);
            color: var(--body);
            background: var(--white);
        }

        .btn-ghost:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-xs);
        }

        /* Trust row */
        .hero-trust {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-top: 52px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
            opacity: 0;
            animation: fadeUp .75s .68s cubic-bezier(.22, 1, .36, 1) forwards;
            flex-wrap: wrap;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .trust-item i {
            color: var(--blue);
            font-size: 14px;
        }

        /* Hero right – image panel */
        .hero-right {
            position: relative;
            overflow: hidden;
            background: var(--surface);
        }

        @media (max-width: 768px) {
            .hero-right {
                height: 55vw;
                min-height: 260px;
            }
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: heroReveal 1.3s .05s cubic-bezier(.22, 1, .36, 1) forwards;
            clip-path: inset(0 100% 0 0);
        }

        @keyframes heroReveal {
            to {
                clip-path: inset(0 0% 0 0);
            }
        }

        /* Blue tint overlay */
        .hero-right::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(135deg, rgba(42, 125, 225, .12) 0%, transparent 60%);
        }

        .hero-right::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(to left, transparent 60%, var(--white) 100%);
        }

        /* Stat cards */
        .hero-stats {
            position: absolute;
            bottom: 40px;
            right: 32px;
            z-index: 3;
            display: flex;
            flex-direction: column;
            gap: 12px;
            opacity: 0;
            animation: fadeSlide .7s .9s ease forwards;
        }

        @media (max-width: 768px) {
            .hero-stats {
                display: none;
            }
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .stat-card {
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 20px rgba(42, 125, 225, .08);
            min-width: 160px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--blue-lt);
            display: grid;
            place-items: center;
            color: var(--blue);
            font-size: 14px;
            flex-shrink: 0;
        }

        .stat-num {
            font-family: 'Cormorant', serif;
            font-size: 26px;
            font-weight: 700;
            line-height: 1;
            color: var(--ink);
        }

        .stat-lbl {
            font-size: 10px;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 1px;
        }

        /* Scroll hint */
        .scroll-hint {
            position: absolute;
            bottom: 36px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            font-size: 9px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--stone);
            z-index: 3;
            opacity: 0;
            animation: fadeUp 1s 1.3s ease forwards;
        }

        .scroll-line {
            width: 1px;
            height: 44px;
            background: linear-gradient(to bottom, var(--blue), transparent);
            animation: scrollAnim 2s 1.6s ease infinite;
        }

        @keyframes scrollAnim {
            0% {
                transform: scaleY(0);
                transform-origin: top;
            }

            50% {
                transform: scaleY(1);
                transform-origin: top;
            }

            51% {
                transform: scaleY(1);
                transform-origin: bottom;
            }

            100% {
                transform: scaleY(0);
                transform-origin: bottom;
            }
        }

        /* ── MARQUEE ── */
        .marquee-wrap {
            overflow: hidden;
            background: var(--blue);
            padding: 13px 0;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 20s linear infinite;
        }

        .marquee-item {
            display: flex;
            align-items: center;
            gap: 28px;
            padding: 0 36px;
            white-space: nowrap;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .65);
        }

        .m-dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .4);
        }

        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* ── ABOUT ── */
        #about {
            background: var(--white);
            padding: 130px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 768px) {
            #about {
                grid-template-columns: 1fr;
                padding: 80px 0;
            }
        }

        .about-img-col {
            position: relative;
            overflow: hidden;
            min-height: 540px;
        }

        @media (max-width: 768px) {
            .about-img-col {
                min-height: 300px;
                order: -1;
            }
        }

        .about-img-col img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 8s ease;
        }

        .about-img-col:hover img {
            transform: scale(1.04);
        }

        /* Blue accent block overlapping image */
        .about-img-col::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: var(--blue);
            opacity: .12;
        }

        /* Big number watermark */
        .about-watermark {
            position: absolute;
            top: 24px;
            left: 24px;
            font-family: 'Cormorant', serif;
            font-size: 160px;
            font-weight: 700;
            line-height: 1;
            color: transparent;
            -webkit-text-stroke: 1px rgba(42, 125, 225, .12);
            pointer-events: none;
            user-select: none;
            z-index: 2;
        }

        .about-text-col {
            padding: 0 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .about-text-col {
                padding: 48px 24px;
            }
        }

        .sec-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .sec-tag-line {
            width: 24px;
            height: 1.5px;
            background: var(--blue);
        }

        .sec-tag span {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: var(--blue);
        }

        .sec-title {
            font-family: 'Cormorant', serif;
            font-size: clamp(36px, 3.5vw, 58px);
            font-weight: 300;
            line-height: 1.08;
            color: var(--ink);
            margin-bottom: 24px;
        }

        .sec-title em {
            font-style: italic;
            color: var(--blue);
        }

        .sec-body {
            font-size: 14px;
            line-height: 1.9;
            color: var(--body);
            margin-bottom: 36px;
        }

        .feat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 40px;
        }

        .feat-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            background: var(--blue-xs);
            border: 1px solid var(--blue-lt);
            border-radius: 10px;
            transition: all .2s;
        }

        .feat-item:hover {
            border-color: var(--blue);
            background: var(--blue-lt);
            transform: translateY(-2px);
        }

        .feat-item i {
            color: var(--blue);
            font-size: 13px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .feat-item span {
            font-size: 12px;
            font-weight: 600;
            color: var(--ink2);
            line-height: 1.4;
        }

        /* ── PRODUCTS ── */
        #products {
            background: var(--bg);
            padding: 120px 64px;
        }

        @media (max-width: 768px) {
            #products {
                padding: 80px 24px;
            }
        }

        .prod-header {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: flex-end;
            margin-bottom: 56px;
            gap: 24px;
        }

        @media (max-width: 600px) {
            .prod-header {
                grid-template-columns: 1fr;
            }
        }

        .prod-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 900px) {
            .prod-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {
            .prod-grid {
                grid-template-columns: 1fr;
            }
        }

        .pcard {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            background: var(--surface);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(42, 125, 225, .06);
            transition: box-shadow .3s, transform .3s;
        }

        .pcard:first-child {
            aspect-ratio: 4/5;
        }

        .pcard:not(:first-child) {
            aspect-ratio: 3/4;
        }

        .pcard:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(42, 125, 225, .15);
        }

        .pcard img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .7s cubic-bezier(.22, 1, .36, 1), filter .4s;
            filter: brightness(.88) saturate(.9);
        }

        .pcard:hover img {
            transform: scale(1.05);
            filter: brightness(.72) saturate(.85);
        }

        .pcard-overlay {
            position: absolute;
            inset: 0;
            border-radius: 16px;
            background: linear-gradient(to top, rgba(15, 25, 35, .85) 0%, rgba(15, 25, 35, .1) 55%);
            transition: background .35s;
        }

        .pcard:hover .pcard-overlay {
            background: linear-gradient(to top, rgba(15, 25, 35, .92) 0%, rgba(15, 25, 35, .35) 100%);
        }

        /* Blue accent bar on hover */
        .pcard::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--blue);
            z-index: 3;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .4s cubic-bezier(.22, 1, .36, 1);
        }

        .pcard:hover::before {
            transform: scaleX(1);
        }

        .pcard-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 2;
            padding: 24px;
            transition: transform .4s cubic-bezier(.22, 1, .36, 1);
        }

        .pcard:hover .pcard-body {
            transform: translateY(-6px);
        }

        .pcard-idx {
            font-size: 10px;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: rgba(42, 125, 225, .9);
            margin-bottom: 6px;
        }

        .pcard-name {
            font-family: 'Cormorant', serif;
            font-size: 26px;
            font-weight: 600;
            line-height: 1.1;
            color: var(--white);
            margin-bottom: 8px;
        }

        .pcard-desc {
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            line-height: 1.6;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height .4s ease, opacity .3s;
        }

        .pcard:hover .pcard-desc {
            max-height: 60px;
            opacity: 1;
        }

        .pcard-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            margin-top: 14px;
            background: var(--blue);
            padding: 7px 16px;
            border-radius: 4px;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity .3s .1s, transform .3s .1s, background .2s;
        }

        .pcard:hover .pcard-cta {
            opacity: 1;
            transform: translateY(0);
        }

        .pcard-cta:hover {
            background: var(--blue2);
        }

        /* ── CTA SECTION ── */
        #cta {
            position: relative;
            overflow: hidden;
            background: var(--white);
            padding: 140px 80px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        @media (max-width: 768px) {
            #cta {
                grid-template-columns: 1fr;
                padding: 80px 24px;
                gap: 48px;
            }
        }

        /* Geometric bg accent */
        .cta-bg {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(42, 125, 225, .07) 0%, transparent 65%);
            pointer-events: none;
        }

        .cta-bg-2 {
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(62, 207, 207, .06) 0%, transparent 65%);
            pointer-events: none;
        }

        /* Corner bracket decoration */
        .cta-bracket {
            position: absolute;
            top: 48px;
            right: 64px;
            width: 60px;
            height: 60px;
            border-top: 2px solid var(--blue-lt);
            border-right: 2px solid var(--blue-lt);
        }

        .cta-bracket-bl {
            position: absolute;
            bottom: 48px;
            left: 64px;
            width: 60px;
            height: 60px;
            border-bottom: 2px solid var(--blue-lt);
            border-left: 2px solid var(--blue-lt);
        }

        .cta-left {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-family: 'Cormorant', serif;
            font-size: clamp(48px, 5.5vw, 82px);
            font-weight: 300;
            line-height: .94;
            color: var(--ink);
        }

        .cta-title em {
            font-style: italic;
            color: var(--blue);
        }

        .cta-right {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .cta-main-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 28px;
            background: var(--blue);
            color: var(--white);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all .25s ease;
            box-shadow: 0 6px 24px rgba(42, 125, 225, .28);
        }

        .cta-main-btn:hover {
            background: var(--blue2);
            transform: translateX(6px);
            box-shadow: 0 8px 32px rgba(42, 125, 225, .38);
        }

        .cta-sec-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            border: 1.5px solid var(--border);
            color: var(--body);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all .25s ease;
            background: var(--white);
        }

        .cta-sec-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
            transform: translateX(6px);
            background: var(--blue-xs);
        }

        .cta-note {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: .05em;
            padding-top: 10px;
            border-top: 1px solid var(--border);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--ink);
            padding: 44px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        @media (max-width: 768px) {
            footer {
                padding: 36px 24px;
                flex-direction: column;
                text-align: center;
            }
        }

        .f-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--white);
        }

        .f-logo span {
            color: var(--blue);
        }

        .f-copy {
            font-size: 11px;
            color: var(--stone);
            letter-spacing: .07em;
        }

        /* ── REVEAL ── */
        .rev {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s ease, transform .65s cubic-bezier(.22, 1, .36, 1);
        }

        .rev.in {
            opacity: 1;
            transform: translateY(0);
        }

        .rev-d1 {
            transition-delay: .1s;
        }

        .rev-d2 {
            transition-delay: .2s;
        }

        .rev-d3 {
            transition-delay: .3s;
        }

        /* ── KEYFRAMES ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(28px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        ::selection {
            background: var(--blue);
            color: var(--white);
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
    <div class="cur-dot" id="cur-dot"></div>
    <div class="cur-ring" id="cur-ring"></div>

    <!-- ═══ NAV ═══ -->
    <nav id="nav">
        <a href="{{ route('welcome') }}" class="nav-logo">TIERRA<span>STONE</span></a>
        <div class="nav-links">
            <a href="#about" class="nav-link">About</a>
            <a href="#products" class="nav-link">Products</a>
            <a href="{{ route('orders.track') }}" class="nav-link">
                <i class="fa-solid fa-magnifying-glass" style="font-size:11px; margin-right:4px"></i>Lacak
            </a>
            <a href="{{ route('order') }}" class="nav-cta">Order Now</a>
        </div>
        <div class="nav-mobile">
            <a href="{{ route('orders.track') }}" style="color:var(--body); font-size:15px">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a href="{{ route('order') }}" class="nav-cta" style="font-size:11px; padding:9px 18px">Order</a>
        </div>
    </nav>

    <!-- ═══ HERO ═══ -->
    <section id="hero">
        <div class="hero-left">
            <div class="hero-tag">
                <div class="hero-tag-dash"></div>
                <span>Premium Stone Supplier · Est. 2010</span>
            </div>

            <h1 class="hero-title">
                Batu <em>Alam</em><br>
                <span class="stroke">Pilihan</span><br>
                Terbaik.
            </h1>

            <p class="hero-sub">
                Penyedia batu alam berkualitas tinggi untuk proyek konstruksi, landscape, dan desain interior. Kuat, elegan, dan tahan lama.
            </p>

            <div class="hero-btns">
                <a href="#products" class="btn btn-blue">
                    Lihat Koleksi <i class="fa-solid fa-arrow-right" style="font-size:10px"></i>
                </a>
                <a href="{{ route('orders.track') }}" class="btn btn-ghost">
                    <i class="fa-solid fa-magnifying-glass" style="font-size:10px"></i>
                    Lacak Pesanan
                </a>
            </div>

            <div class="hero-trust">
                <div class="trust-item"><i class="fa-solid fa-shield-halved"></i> Tersertifikasi</div>
                <div class="trust-item"><i class="fa-solid fa-truck-fast"></i> Kirim Nasional</div>
                <div class="trust-item"><i class="fa-solid fa-headset"></i> Konsultasi Gratis</div>
            </div>
        </div>
        

        <div class="hero-right">
            <img src="https://static.wixstatic.com/media/ef7d36_1737313009b8416182a7813401798ddf~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/smoke-grey-random-size-sliced-pebble-stone-mosaic-741523_edited.png"
                alt="TierraStone" class="hero-img">

            <div class="hero-stats">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <div>
                        <div class="stat-num">15+</div>
                        <div class="stat-lbl">Tahun Pengalaman</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-building"></i></div>
                    <div>
                        <div class="stat-num">500+</div>
                        <div class="stat-lbl">Proyek Selesai</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div>
                        <div class="stat-num">30+</div>
                        <div class="stat-lbl">Jenis Batu</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-hint">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- ═══ MARQUEE ═══ -->
    <div class="marquee-wrap">
        <div class="marquee-track">
            <div class="marquee-item"><span>Marmer Premium</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Granit Alam</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Andesit</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Landscape</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Paras Jogja</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Candi</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Palimanan</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Bush Hammer · Poles · Bakar</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Marmer Premium</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Granit Alam</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Andesit</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Landscape</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Paras Jogja</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Batu Candi</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Palimanan</span>
                <div class="m-dot"></div>
            </div>
            <div class="marquee-item"><span>Bush Hammer · Poles · Bakar</span>
                <div class="m-dot"></div>
            </div>
        </div>
    </div>

    <!-- ═══ ABOUT ═══ -->
    <section id="about">
        <div class="about-img-col rev">
            <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Stone detail">
            <div class="about-watermark">15</div>
        </div>

        <div class="about-text-col">
            <div class="sec-tag rev">
                <div class="sec-tag-line"></div><span>Tentang Kami</span>
            </div>
            <h2 class="sec-title rev rev-d1">
                Material yang<br><em>Hidup</em> dalam<br>Setiap Proyek.
            </h2>
            <p class="sec-body rev rev-d2">
                TierraStone hadir sebagai mitra terpercaya para arsitek, kontraktor, dan desainer interior dalam memilih batu alam terbaik. Setiap batu dipilih dengan standar ketat untuk memastikan kekuatan dan keindahan jangka panjang.
            </p>
            <div class="feat-grid rev rev-d2">
                <div class="feat-item">
                    <i class="fa-solid fa-certificate"></i>
                    <span>Kualitas Tersertifikasi</span>
                </div>
                <div class="feat-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span>Pengiriman Nasional</span>
                </div>
                <div class="feat-item">
                    <i class="fa-solid fa-comments"></i>
                    <span>Konsultasi Gratis</span>
                </div>
                <div class="feat-item">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Stok Selalu Ready</span>
                </div>
            </div>
            <a href="{{ route('order') }}" class="btn btn-blue rev rev-d3" style="align-self:flex-start">
                Mulai Konsultasi <i class="fa-solid fa-arrow-right" style="font-size:10px"></i>
            </a>
        </div>
    </section>

    <!-- ═══ PRODUCTS ═══ -->
    <section id="products">
        <div class="prod-header">
            <div>
                <div class="sec-tag rev">
                    <div class="sec-tag-line"></div><span>Koleksi Produk</span>
                </div>
                <h2 class="sec-title rev rev-d1" style="margin-bottom:0">Produk <em>Unggulan</em></h2>
            </div>
            <a href="{{ route('order') }}" class="btn btn-ghost rev" style="align-self:flex-end; font-size:11px; white-space:nowrap">
                Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size:9px"></i>
            </a>
        </div>

        <div class="prod-grid">
            <div class="pcard rev">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Marmer">
                <div class="pcard-overlay"></div>
                <div class="pcard-body">
                    <div class="pcard-idx">01 / Marmer</div>
                    <div class="pcard-name">Marmer<br>Premium</div>
                    <div class="pcard-desc">Koleksi marmer eksklusif untuk lantai dan dinding interior mewah.</div>
                    <a href="{{ route('order') }}?product=Marmer+Premium" class="pcard-cta">
                        Pesan <i class="fa-solid fa-arrow-right" style="font-size:9px"></i>
                    </a>
                </div>
            </div>
            <div class="pcard rev rev-d1">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Granit">
                <div class="pcard-overlay"></div>
                <div class="pcard-body">
                    <div class="pcard-idx">02 / Granit</div>
                    <div class="pcard-name">Granit<br>Alam</div>
                    <div class="pcard-desc">Daya tahan luar biasa untuk area outdoor dan dapur.</div>
                    <a href="{{ route('order') }}?product=Granit+Alam" class="pcard-cta">
                        Pesan <i class="fa-solid fa-arrow-right" style="font-size:9px"></i>
                    </a>
                </div>
            </div>
            <div class="pcard rev rev-d2">
                <img src="https://static.wixstatic.com/media/ef7d36_87da53ee99ff44238a005f84bacfa038~mv2.png/v1/fill/w_538,h_538,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/granite-stone_110707071.png" alt="Landscape">
                <div class="pcard-overlay"></div>
                <div class="pcard-body">
                    <div class="pcard-idx">03 / Landscape</div>
                    <div class="pcard-name">Batu<br>Landscape</div>
                    <div class="pcard-desc">Mempercantik taman dan kolam dengan nuansa alami.</div>
                    <a href="{{ route('order') }}?product=Batu+Landscape" class="pcard-cta">
                        Pesan <i class="fa-solid fa-arrow-right" style="font-size:9px"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA ═══ -->
    <section id="cta">
        <div class="cta-bg"></div>
        <div class="cta-bg-2"></div>
        <div class="cta-bracket"></div>
        <div class="cta-bracket-bl"></div>

        <div class="cta-left rev">
            <div class="sec-tag" style="margin-bottom:28px">
                <div class="sec-tag-line"></div><span>Mulai Sekarang</span>
            </div>
            <h2 class="cta-title">
                Siap Wujudkan<br>Proyek <em>Impian</em><br>Anda?
            </h2>
        </div>

        <div class="cta-right rev rev-d2">
            <a href="{{ route('order') }}" class="cta-main-btn">
                <span>Buat Pesanan</span>
                <i class="fa-solid fa-arrow-right" style="font-size:11px"></i>
            </a>
            <a href="{{ route('orders.track') }}" class="cta-sec-btn">
                <span>Lacak Pesanan</span>
                <i class="fa-solid fa-magnifying-glass" style="font-size:11px"></i>
            </a>
            <p class="cta-note">
                <i class="fa-brands fa-whatsapp" style="color:var(--blue); margin-right:5px"></i>
                Respons via WhatsApp jam kerja 08.00–17.00 WIB
            </p>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="f-logo">TIERRA<span>STONE</span></div>
        <div class="f-copy">&copy; 2026 OMS TierraStone. All rights reserved.</div>
    </footer>

    <script>
        // Custom cursor
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

        // Nav scroll
        const nav = document.getElementById('nav');
        window.addEventListener('scroll', () => nav.classList.toggle('scrolled', scrollY > 50), {
            passive: true
        });

        // Scroll reveal
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: .12
        });
        document.querySelectorAll('.rev').forEach(el => io.observe(el));
    </script>
</body>

</html>