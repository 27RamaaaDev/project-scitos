<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle ?? data_get($scitos, 'meta.default_title') }}</title>
    <meta
        name="description"
        content="{{ $pageDescription ?? data_get($scitos, 'meta.default_description') }}"
    >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #05050a;
            --bg-card: rgba(16, 16, 24, 0.6);
            --bg-card-solid: #101018;
            --bg-card-soft: rgba(18, 18, 28, 0.82);
            --neon-cyan: #00f0ff;
            --neon-pink: #ff0055;
            --neon-purple: #9d00ff;
            --border-dim: rgba(255, 255, 255, 0.1);
            --border-active: var(--neon-cyan);
            --text-title: #ffffff;
            --text-primary: #e2e8f0;
            --text-muted: #8b949e;
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-pill: 9999px;
            --transition-bounce: 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            --transition-fast: 0.2s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            background-color: var(--bg-body);
        }

        body {
            color: var(--text-primary);
            font-family: "Inter", sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            background-image:
                radial-gradient(circle at 15% 30%, rgba(0, 240, 255, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 70%, rgba(255, 0, 85, 0.08) 0%, transparent 40%),
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 40px 40px, 40px 40px;
            background-position: top center;
            background-attachment: fixed;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: var(--transition-fast);
        }

        h1, h2, h3, h4, h5 {
            font-family: "Plus Jakarta Sans", sans-serif;
            color: var(--text-title);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .font-mono {
            font-family: "Space Mono", monospace;
        }

        .container {
            width: min(1180px, 100% - 48px);
            margin: 0 auto;
        }

        .navbar-wrapper {
            position: fixed;
            top: 24px;
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 100;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 10, 15, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-dim);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            width: min(1240px, calc(100% - 48px));
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), inset 0 -2px 0 rgba(0, 240, 255, 0.2);
            transition: var(--transition-fast);
        }

        .navbar:hover {
            border-color: rgba(0, 240, 255, 0.3);
            box-shadow: 0 10px 40px rgba(0, 240, 255, 0.1), inset 0 -2px 0 var(--neon-cyan);
        }

        .nav-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-profile-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed var(--border-dim);
            color: var(--text-muted);
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
        }

        .nav-profile-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(0, 240, 255, 0.2), transparent);
            opacity: 0;
            transition: var(--transition-fast);
        }

        .nav-profile-btn:hover,
        .nav-profile-btn.is-active {
            border-style: solid;
            border-color: var(--neon-cyan);
            color: var(--neon-cyan);
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.4);
        }

        .nav-profile-btn:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .nav-profile-btn:hover::before,
        .nav-profile-btn.is-active::before {
            opacity: 1;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1rem;
            color: var(--text-title);
            font-family: "Plus Jakarta Sans", sans-serif;
            padding-right: 16px;
            border-right: 2px dotted var(--border-dim);
        }

        .nav-brand img {
            height: 28px;
            width: auto;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.2));
        }

        .nav-links {
            display: flex;
            gap: 18px;
            font-size: 0.78rem;
            color: var(--text-primary);
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-links a {
            position: relative;
            padding: 4px 0;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--neon-pink);
            transition: var(--transition-bounce);
        }

        .nav-links a:hover,
        .nav-links a.is-active {
            color: var(--text-title);
        }

        .nav-links a:hover::after,
        .nav-links a.is-active::after {
            width: 100%;
        }

        .nav-actions {
            gap: 12px;
        }

        .nav-profile-initial {
            position: relative;
            z-index: 2;
            font-family: "Space Mono", monospace;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .auth-pill {
            display: flex;
            flex-direction: column;
            padding: 8px 14px;
            border-radius: var(--radius-pill);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-dim);
            min-width: 150px;
        }

        .auth-pill strong {
            font-size: 0.82rem;
            line-height: 1.2;
            color: var(--text-title);
        }

        .auth-pill span {
            font-size: 0.68rem;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            font-family: "Space Mono", monospace;
            margin-top: 4px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 24px;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: var(--radius-sm);
            transition: var(--transition-bounce);
            cursor: pointer;
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            position: relative;
        }

        .btn-primary {
            background: var(--text-title);
            color: var(--bg-body);
            border: 1px solid var(--text-title);
        }

        .btn-primary:hover {
            transform: translate(-4px, -4px);
            box-shadow: 4px 4px 0 var(--neon-cyan);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
            border: 1px solid var(--border-dim);
        }

        .btn-secondary:hover,
        .btn-secondary.is-active {
            border-color: var(--neon-pink);
            color: #fff;
            box-shadow: 4px 4px 0 var(--neon-pink);
        }

        .btn-secondary:hover {
            transform: translate(-4px, -4px);
        }

        @keyframes hologram {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .btn-ai {
            background: linear-gradient(90deg, #00f0ff, #9d00ff, #ff0055, #00f0ff);
            background-size: 300% 300%;
            animation: hologram 4s linear infinite;
            color: #fff;
            border: none;
            border-radius: var(--radius-pill);
            padding: 10px 20px;
            font-family: "Plus Jakarta Sans", sans-serif;
            text-transform: none;
            font-weight: 700;
        }

        .btn-ai:hover,
        .btn-ai.is-active {
            box-shadow: 0 10px 25px rgba(157, 0, 255, 0.5);
        }

        .btn-ai:hover {
            transform: scale(1.05) translateY(-2px);
        }

        .btn-ai svg {
            width: 18px;
            height: 18px;
        }

        .section {
            padding: 140px 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 72px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--neon-cyan);
            border: 1px solid rgba(0, 240, 255, 0.3);
            border-radius: 4px;
            background: rgba(0, 240, 255, 0.05);
            margin-bottom: 24px;
            font-family: "Space Mono", monospace;
        }

        .badge::before {
            content: ">";
            margin-right: 8px;
            color: var(--neon-pink);
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 16px;
            color: #fff;
        }

        .section-desc {
            font-size: 1.125rem;
            color: var(--text-muted);
            max-width: 600px;
        }

        .section-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .cyber-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-dim);
            border-radius: var(--radius-md);
            transition: var(--transition-bounce);
            position: relative;
        }

        .cyber-card::after {
            content: "+";
            position: absolute;
            top: 10px;
            right: 15px;
            color: var(--border-dim);
            font-family: monospace;
            font-size: 1.2rem;
            transition: var(--transition-fast);
        }

        .cyber-card:hover {
            transform: translate(-6px, -6px);
            border-color: var(--neon-cyan);
            box-shadow: 6px 6px 0 rgba(0, 240, 255, 0.6);
            background: var(--bg-card-solid);
        }

        .cyber-card:hover::after {
            color: var(--neon-cyan);
        }

        .cyber-card:nth-child(even):hover {
            border-color: var(--neon-pink);
            box-shadow: 6px 6px 0 rgba(255, 0, 85, 0.6);
        }

        .cyber-card:nth-child(even):hover::after {
            color: var(--neon-pink);
        }

        .cyber-card:nth-child(3n):hover {
            border-color: var(--neon-purple);
            box-shadow: 6px 6px 0 rgba(157, 0, 255, 0.6);
        }

        .cyber-card:nth-child(3n):hover::after {
            color: var(--neon-purple);
        }

        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding-top: 100px;
            position: relative;
        }

        .hero-title {
            font-size: clamp(3.5rem, 8vw, 6rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.04em;
            margin-bottom: 24px;
            max-width: 900px;
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .hero-desc {
            font-size: clamp(1.1rem, 2vw, 1.25rem);
            color: var(--text-primary);
            max-width: 600px;
            margin-bottom: 40px;
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            margin-bottom: 80px;
        }

        .stats-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            width: 100%;
        }

        .stat-box {
            padding: 32px 24px;
            text-align: center;
        }

        .stat-val {
            font-family: "Space Mono", monospace;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            display: inline-block;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .stat-lbl {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .page-hero {
            min-height: auto;
            align-items: flex-start;
            text-align: left;
            padding-top: 180px;
            padding-bottom: 40px;
        }

        .page-hero .hero-title {
            max-width: 780px;
            font-size: clamp(3rem, 7vw, 4.8rem);
        }

        .page-hero .hero-desc {
            max-width: 760px;
            margin-bottom: 28px;
        }

        .page-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            width: 100%;
        }

        .page-meta .cyber-card {
            padding: 20px 22px;
            min-width: 220px;
        }

        .page-meta strong {
            display: block;
            font-family: "Space Mono", monospace;
            font-size: 1rem;
            color: var(--text-title);
            margin-bottom: 6px;
        }

        .page-meta span {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }

        .bento-wide {
            grid-column: span 8;
            padding: 48px;
        }

        .bento-side {
            grid-column: span 4;
            padding: 48px 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .bento-side img {
            width: 120px;
            height: 120px;
            margin-bottom: 24px;
            filter: drop-shadow(0 0 30px rgba(0, 240, 255, 0.3));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0); }
        }

        .history-list {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            border-left: 2px dashed var(--border-dim);
            padding-left: 24px;
        }

        .history-item {
            position: relative;
        }

        .history-item::before {
            content: "";
            position: absolute;
            left: -31px;
            top: 6px;
            width: 12px;
            height: 12px;
            background: var(--neon-cyan);
            border-radius: 2px;
            box-shadow: 0 0 10px var(--neon-cyan);
        }

        .h-year {
            font-family: "Space Mono", monospace;
            font-size: 0.85rem;
            color: var(--neon-cyan);
            margin-bottom: 4px;
            display: block;
        }

        .h-title {
            font-weight: 700;
            color: #fff;
            font-size: 1.1rem;
        }

        .bento-quarter {
            grid-column: span 6;
            padding: 32px;
            display: flex;
            flex-direction: column;
        }

        .icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: #fff;
            border: 1px solid var(--border-dim);
            transition: var(--transition-bounce);
        }

        .cyber-card:hover .icon-wrap {
            background: var(--neon-cyan);
            color: #000;
            border-color: var(--neon-cyan);
            transform: rotate(-10deg) scale(1.1);
        }

        .bento-quarter h3 {
            font-size: 1.2rem;
            margin-bottom: 12px;
        }

        .bento-quarter p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .preview-panel {
            padding: 32px;
        }

        .preview-panel h3 {
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .preview-panel p {
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--neon-cyan);
            font-family: "Space Mono", monospace;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .section-link::after {
            content: "->";
            color: var(--neon-pink);
        }

        .section-link:hover {
            color: #fff;
        }

        .terminal-window {
            background: #0a0a0f;
            border: 1px solid var(--border-dim);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
        }

        .terminal-header {
            background: #151520;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-dim);
        }

        .terminal-dots {
            display: flex;
            gap: 8px;
            margin-right: 20px;
        }

        .terminal-dots span {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .terminal-dots span:nth-child(1) { background: #ff5f56; }
        .terminal-dots span:nth-child(2) { background: #ffbd2e; }
        .terminal-dots span:nth-child(3) { background: #27c93f; }

        .terminal-title {
            font-family: "Space Mono", monospace;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .achievement-row {
            display: flex;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.05);
            transition: var(--transition-fast);
        }

        .achievement-row:last-child {
            border-bottom: none;
        }

        .achievement-row:hover {
            background: rgba(0, 240, 255, 0.05);
            padding-left: 32px;
        }

        .a-index {
            width: 40px;
            font-size: 1rem;
            color: var(--neon-cyan);
            font-family: "Space Mono", monospace;
            font-weight: 700;
            margin-right: 16px;
        }

        .a-index::before {
            content: "[";
            color: var(--text-muted);
            font-weight: normal;
        }

        .a-index::after {
            content: "]";
            color: var(--text-muted);
            font-weight: normal;
        }

        .a-text {
            flex: 1;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .terminal-note {
            margin-top: 24px;
            color: var(--text-muted);
            text-align: center;
            font-size: 0.95rem;
        }

        .div-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: auto;
            padding-top: 24px;
        }

        .div-tag {
            padding: 6px 12px;
            background: transparent;
            border: 1px dashed var(--border-dim);
            border-radius: 4px;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-family: "Space Mono", monospace;
            transition: var(--transition-fast);
        }

        .cyber-card:hover .div-tag {
            border-color: currentColor;
            color: inherit;
        }

        .division-detail-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .division-detail-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .division-detail-card {
            padding: 24px;
        }

        .division-detail-card img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid var(--border-dim);
            background: rgba(255, 255, 255, 0.03);
        }

        .division-detail-card h3 {
            margin-bottom: 10px;
        }

        .division-detail-card p {
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .division-detail-card ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .division-detail-card li {
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px dashed var(--border-dim);
            font-size: 0.78rem;
            font-family: "Space Mono", monospace;
            color: var(--text-primary);
        }

        .split-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .info-stack {
            display: grid;
            gap: 16px;
        }

        .info-box {
            padding: 24px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        .info-box p,
        .info-box li {
            color: var(--text-muted);
        }

        .info-box ul {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .board-wrapper {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }

        .board-box {
            padding: 32px;
            display: flex;
            flex-direction: column;
        }

        .board-pembina {
            grid-column: 5 / 9;
            text-align: center;
        }

        .board-pembina .board-header {
            justify-content: center;
        }

        .board-pembina li {
            align-items: center !important;
        }

        .board-bph {
            grid-column: 1 / -1;
        }

        .board-koor {
            grid-column: span 4;
        }

        .board-header {
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-dim);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .board-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .list-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .board-list li {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid var(--border-dim);
            border-radius: 8px;
            padding: 14px 18px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
        }

        .board-list li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--text-muted);
            transition: var(--transition-fast);
        }

        .board-list li:hover {
            transform: translateX(8px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .board-box.board-pembina li:hover::before { background: #fff; }
        .board-box.board-bph li:hover::before { background: var(--neon-cyan); }
        .board-box.board-koor li:hover::before { background: var(--neon-pink); }

        .role-badge {
            font-size: 0.7rem;
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.05);
            padding: 2px 8px;
            border-radius: 4px;
        }

        .board-list li:hover .role-badge {
            color: #fff;
        }

        .member-name {
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .mini-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .mini-board .cyber-card {
            padding: 28px;
        }

        .mini-board h3 {
            margin-bottom: 14px;
        }

        .mini-board p,
        .mini-board li {
            color: var(--text-muted);
        }

        .mini-board ul {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .cta-container {
            background: repeating-linear-gradient(
                45deg,
                rgba(0, 240, 255, 0.03),
                rgba(0, 240, 255, 0.03) 10px,
                rgba(0, 0, 0, 0) 10px,
                rgba(0, 0, 0, 0) 20px
            ), var(--bg-card-solid);
            border: 1px solid var(--neon-cyan);
            border-radius: var(--radius-lg);
            padding: 80px 24px;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 0 40px rgba(0, 240, 255, 0.1);
            position: relative;
        }

        .cta-container::after {
            content: "";
            position: absolute;
            top: -1px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }

        .cta-container h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 16px;
        }

        .cta-container p {
            color: var(--text-primary);
            margin-bottom: 40px;
            font-size: 1.1rem;
            max-width: 600px;
            margin-inline: auto;
        }

        .coming-shell {
            min-height: calc(100vh - 320px);
            display: flex;
            align-items: center;
        }

        .coming-card {
            max-width: 780px;
            margin: 0 auto;
            padding: 56px 40px;
            text-align: center;
        }

        .coming-status {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            color: var(--neon-cyan);
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.8rem;
        }

        .coming-status::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--neon-cyan);
            box-shadow: 0 0 12px var(--neon-cyan);
        }

        .coming-card p {
            max-width: 560px;
            margin: 0 auto 30px;
            color: var(--text-muted);
        }

        .footer {
            margin-top: 100px;
            padding: 60px 0 40px;
            background: #000;
            border-top: 1px dashed var(--border-dim);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 60px;
        }

        .footer-brand h3 {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            margin-bottom: 16px;
        }

        .footer-brand img {
            height: 32px;
            filter: grayscale(100%) brightness(200%);
        }

        .footer-brand p {
            color: var(--text-muted);
            max-width: 300px;
            font-size: 0.95rem;
        }

        .footer-title {
            font-size: 1rem;
            color: #fff;
            margin-bottom: 24px;
            font-family: "Space Mono", monospace;
        }

        .footer-title::before {
            content: "/> ";
            color: var(--neon-pink);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--neon-cyan);
            padding-left: 8px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid var(--border-dim);
            font-family: "Space Mono", monospace;
        }

        .footer-bottom p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        body.modal-open {
            overflow: hidden;
        }

        .toast-stack {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 160;
            pointer-events: none;
        }

        .session-toast {
            min-width: min(360px, calc(100vw - 32px));
            max-width: 420px;
            padding: 14px 16px;
            border-radius: 24px;
            background: rgba(9, 11, 17, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 24px 40px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            gap: 14px;
            pointer-events: auto;
            transform: translateY(-18px) scale(0.96);
            opacity: 0;
            animation: toast-in 0.28s ease forwards;
        }

        .session-toast.is-hiding {
            animation: toast-out 0.32s ease forwards;
        }

        .session-toast-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(0, 240, 255, 0.18), rgba(157, 0, 255, 0.16));
            color: var(--neon-cyan);
        }

        .session-toast-icon svg {
            width: 20px;
            height: 20px;
        }

        .session-toast-body strong {
            display: block;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 0.92rem;
            color: var(--text-title);
        }

        .session-toast-body p {
            margin-top: 2px;
            color: var(--text-primary);
            font-size: 0.88rem;
            line-height: 1.45;
        }

        @keyframes toast-in {
            from {
                opacity: 0;
                transform: translateY(-18px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes toast-out {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateY(-16px) scale(0.96);
            }
        }

        .hero-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-dim);
            margin-bottom: 28px;
            color: var(--text-primary);
            text-align: center;
        }

        .hero-status strong {
            color: var(--text-title);
        }

        .hero-status span {
            font-family: "Space Mono", monospace;
            font-size: 0.78rem;
            color: var(--neon-cyan);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .highlight-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .highlight-card {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mini-label,
        .journey-step {
            font-family: "Space Mono", monospace;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--neon-cyan);
        }

        .highlight-card h3,
        .journey-card h3,
        .gallery-card h3,
        .task-card h3,
        .tree-cluster h3 {
            font-size: 1.15rem;
        }

        .highlight-card p,
        .journey-card p,
        .gallery-card p,
        .task-card p,
        .tree-cluster p {
            color: var(--text-muted);
        }

        .journey-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .journey-card {
            padding: 28px;
        }

        .journey-card h3 {
            margin: 10px 0 12px;
        }

        .division-icon-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .division-icon-card {
            width: 100%;
            padding: 28px;
            text-align: left;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 18px;
            color: inherit;
            font: inherit;
        }

        .division-icon-card::before {
            content: "";
            position: absolute;
            inset: auto auto 0 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(0, 240, 255, 0.6), transparent);
            opacity: 0;
            transition: var(--transition-fast);
        }

        .division-icon-card:hover::before {
            opacity: 1;
        }

        .division-icon-top {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .division-icon-frame {
            width: 74px;
            height: 74px;
            border-radius: 20px;
            border: 1px solid var(--border-dim);
            background: radial-gradient(circle at 50% 20%, rgba(0, 240, 255, 0.18), rgba(255, 255, 255, 0.03));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            flex-shrink: 0;
        }

        .division-icon-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 0 18px rgba(0, 240, 255, 0.18));
        }

        .division-icon-meta strong {
            display: block;
            font-size: 1.1rem;
            color: var(--text-title);
        }

        .division-icon-meta span {
            display: inline-flex;
            margin-top: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-dim);
            font-size: 0.7rem;
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }

        .division-card-hint {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: "Space Mono", monospace;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--neon-cyan);
        }

        .division-card-hint::after {
            content: "+ detail";
            color: var(--neon-pink);
        }

        .modal-shell {
            position: fixed;
            inset: 0;
            background: rgba(3, 4, 10, 0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            z-index: 180;
        }

        .modal-shell.is-open {
            display: flex;
        }

        .modal-card {
            width: min(1040px, 100%);
            max-height: calc(100vh - 48px);
            overflow: auto;
            padding: 32px;
        }

        .modal-close {
            margin-left: auto;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid var(--border-dim);
            background: rgba(255, 255, 255, 0.04);
            color: var(--text-primary);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
        }

        .modal-close:hover {
            color: var(--text-title);
            border-color: var(--neon-pink);
            box-shadow: 0 0 0 4px rgba(255, 0, 85, 0.12);
        }

        .modal-head {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
        }

        .modal-head .division-icon-frame {
            width: 92px;
            height: 92px;
            border-radius: 24px;
        }

        .modal-head p {
            color: var(--text-muted);
            max-width: 680px;
            margin-top: 10px;
        }

        .modal-content-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
        }

        .modal-panel {
            padding: 24px;
        }

        .modal-panel h3 {
            margin-bottom: 14px;
        }

        .modal-panel p {
            color: var(--text-muted);
        }

        .modal-list {
            list-style: none;
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .modal-list li {
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        .leaders-grid {
            display: grid;
            gap: 18px;
        }

        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .social-link {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--border-dim);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.04);
            transition: var(--transition-fast);
        }

        .social-link:hover {
            transform: translateY(-2px);
            border-color: var(--neon-cyan);
            color: var(--neon-cyan);
            box-shadow: 0 8px 18px rgba(0, 240, 255, 0.15);
        }

        .social-link.is-disabled {
            opacity: 0.38;
            cursor: not-allowed;
        }

        .social-link svg {
            width: 18px;
            height: 18px;
        }

        .person-card {
            padding: 22px;
            display: grid;
            grid-template-columns: 92px 1fr;
            gap: 18px;
            align-items: center;
        }

        .person-card::after {
            display: none;
        }

        .person-card.is-special {
            background:
                radial-gradient(circle at top left, rgba(0, 240, 255, 0.12), transparent 40%),
                radial-gradient(circle at bottom right, rgba(157, 0, 255, 0.16), transparent 42%),
                rgba(14, 16, 25, 0.95);
            border-color: rgba(0, 240, 255, 0.36);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.04), 0 20px 40px rgba(0, 0, 0, 0.22);
        }

        .person-media {
            width: 92px;
            height: 92px;
            border-radius: 24px;
            border: 1px solid var(--border-dim);
            background: rgba(255, 255, 255, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .person-media img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .profile-missing {
            width: calc(100% - 16px);
            min-height: calc(100% - 16px);
            border-radius: 18px;
            border: 1px dashed rgba(255, 255, 255, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 12px;
            color: var(--text-muted);
            font-size: 0.72rem;
            line-height: 1.5;
        }

        .person-badge {
            display: inline-flex;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--border-dim);
            font-family: "Space Mono", monospace;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .person-name {
            font-size: 1.02rem;
            margin-bottom: 6px;
        }

        .person-role,
        .person-division,
        .person-bio {
            color: var(--text-muted);
        }

        .person-division {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-family: "Space Mono", monospace;
            margin-top: 8px;
        }

        .person-bio {
            margin-top: 10px;
            font-size: 0.92rem;
        }

        .family-tree {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .tree-row {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .tree-line {
            width: 2px;
            height: 36px;
            background: linear-gradient(180deg, rgba(0, 240, 255, 0.6), rgba(255, 255, 255, 0.04));
            margin: 0 auto;
        }

        .tree-cluster-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .tree-cluster {
            padding: 28px;
        }

        .tree-cluster-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .tree-cluster-head span {
            font-family: "Space Mono", monospace;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--neon-cyan);
        }

        .tree-member-grid {
            display: grid;
            gap: 18px;
        }

        .tree-member-grid .person-card {
            grid-template-columns: 80px 1fr;
            padding: 18px;
        }

        .tree-member-grid .person-media {
            width: 80px;
            height: 80px;
            border-radius: 20px;
        }

        .gallery-feature {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 24px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .gallery-card {
            padding: 20px;
        }

        .gallery-media {
            position: relative;
            height: 220px;
            border-radius: 18px;
            border: 1px solid var(--border-dim);
            background:
                radial-gradient(circle at top left, rgba(0, 240, 255, 0.14), transparent 42%),
                rgba(255, 255, 255, 0.03);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            overflow: hidden;
        }

        .gallery-media img {
            width: 70%;
            height: 70%;
            object-fit: contain;
            filter: drop-shadow(0 0 24px rgba(0, 240, 255, 0.12));
        }

        .gallery-card.is-video .gallery-media::after {
            content: "PLAY";
            position: absolute;
            right: 16px;
            bottom: 16px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255, 0, 85, 0.12);
            border: 1px solid rgba(255, 0, 85, 0.24);
            font-family: "Space Mono", monospace;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            color: #fff;
        }

        .gallery-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 14px;
        }

        .gallery-meta span,
        .task-meta span {
            display: inline-flex;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-dim);
            font-size: 0.72rem;
            color: var(--text-muted);
            font-family: "Space Mono", monospace;
        }

        .classroom-grid {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 24px;
        }

        .workflow-stack,
        .task-stack {
            display: grid;
            gap: 18px;
        }

        .task-card {
            padding: 22px;
        }

        .task-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .task-status {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border: 1px solid var(--border-dim);
        }

        .task-status-priority {
            color: var(--neon-pink);
            border-color: rgba(255, 0, 85, 0.3);
        }

        .task-status-open {
            color: var(--neon-cyan);
            border-color: rgba(0, 240, 255, 0.3);
        }

        .task-status-weekly {
            color: #a8ff78;
            border-color: rgba(168, 255, 120, 0.28);
        }

        .task-status-review {
            color: #ffdd7e;
            border-color: rgba(255, 221, 126, 0.28);
        }

        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 14px 0 16px;
        }

        .login-shell {
            max-width: 980px;
            margin: 0 auto;
            display: grid;
            gap: 24px;
        }

        .login-choice-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .login-choice {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .login-choice.is-active {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 0 1px rgba(0, 240, 255, 0.25), 0 20px 40px rgba(0, 0, 0, 0.18);
        }

        .form-card {
            padding: 32px;
        }

        .form-grid {
            display: grid;
            gap: 18px;
        }

        .field-group {
            display: grid;
            gap: 8px;
        }

        .field-group label {
            font-family: "Space Mono", monospace;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }

        .input-field,
        .field-group select {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--border-dim);
            background: rgba(255, 255, 255, 0.04);
            padding: 14px 16px;
            color: var(--text-primary);
            font-size: 0.96rem;
            font-family: "Inter", sans-serif;
        }

        .input-field:focus,
        .field-group select:focus {
            outline: none;
            border-color: rgba(0, 240, 255, 0.45);
            box-shadow: 0 0 0 4px rgba(0, 240, 255, 0.1);
        }

        .input-help,
        .field-error {
            color: var(--text-muted);
            font-size: 0.84rem;
        }

        .field-error {
            color: #ff9fb8;
        }

        .session-box {
            padding: 28px;
            display: grid;
            gap: 18px;
        }

        .session-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .session-grid .cyber-card {
            padding: 18px;
        }

        .session-grid strong {
            display: block;
            color: var(--text-title);
            margin-bottom: 6px;
        }

        .session-grid span {
            color: var(--text-muted);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-family: "Space Mono", monospace;
        }

        .admin-fab {
            position: fixed;
            right: 28px;
            bottom: 28px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 240, 255, 0.92), rgba(157, 0, 255, 0.88));
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.3), 0 0 0 6px rgba(255, 255, 255, 0.04);
            z-index: 110;
            transition: var(--transition-bounce);
        }

        .admin-fab:hover {
            transform: translateY(-4px) rotate(12deg);
        }

        .admin-fab svg {
            width: 26px;
            height: 26px;
        }

        .admin-panel-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .admin-panel-grid .cyber-card {
            padding: 28px;
        }

        .admin-panel-grid p {
            color: var(--text-muted);
            margin-top: 12px;
        }

        .classroom-app {
            display: grid;
            gap: 24px;
        }

        .classroom-surface {
            background: rgba(255, 255, 255, 0.94);
            color: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            box-shadow: 0 22px 50px rgba(0, 0, 0, 0.18);
        }

        .classroom-surface h2,
        .classroom-surface h3,
        .classroom-surface strong {
            color: #0f172a;
        }

        .classroom-surface p,
        .classroom-surface span,
        .classroom-surface li {
            color: #475569;
        }

        .classroom-banner {
            padding: 28px 30px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-end;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(238, 242, 255, 0.92)),
                #fff;
        }

        .classroom-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8 !important;
            font-size: 0.74rem;
            font-family: "Space Mono", monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .classroom-banner h2 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            margin-top: 14px;
        }

        .classroom-banner p {
            margin-top: 10px;
            max-width: 720px;
            line-height: 1.7;
        }

        .classroom-banner-meta {
            display: grid;
            gap: 12px;
            min-width: 240px;
        }

        .classroom-banner-meta div {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid #dbe4f0;
        }

        .classroom-banner-meta strong {
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 6px;
        }

        .classroom-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .classroom-layout-overview {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .classroom-overview-card {
            padding: 24px 26px;
        }

        .classroom-overview-card h3 {
            margin-top: 16px;
            font-size: 1.22rem;
        }

        .classroom-overview-card p {
            margin-top: 12px;
            line-height: 1.7;
        }

        .classroom-tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.08);
            color: #dbeafe;
            font-weight: 700;
        }

        .classroom-tab.is-active,
        .classroom-tab:hover {
            background: rgba(255, 255, 255, 0.96);
            color: #1d4ed8;
        }

        .classroom-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            align-items: start;
        }

        .classroom-sidebar {
            display: grid;
            gap: 18px;
            position: sticky;
            top: 120px;
        }

        .classroom-side-card {
            padding: 22px;
        }

        .classroom-side-card h3 {
            font-size: 1.8rem;
            margin: 10px 0 8px;
        }

        .classroom-mini-list {
            list-style: none;
            display: grid;
            gap: 10px;
            margin-top: 12px;
        }

        .classroom-mini-list li {
            padding-left: 18px;
            position: relative;
        }

        .classroom-mini-list li small {
            display: block;
            margin-top: 4px;
            color: #94a3b8;
            font-size: 0.78rem;
        }

        .classroom-mini-list li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 10px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #60a5fa;
        }

        .classroom-main {
            display: grid;
            gap: 28px;
        }

        .stream-composer {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .stream-composer-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stream-composer-icon svg {
            width: 24px;
            height: 24px;
        }

        .stream-list,
        .classwork-topic-list {
            display: grid;
            gap: 18px;
            margin-top: 18px;
        }

        .stream-card {
            padding: 22px;
        }

        .stream-card-head {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .stream-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #e0f2fe;
            color: #0369a1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        .stream-card-type {
            display: inline-flex;
            margin-bottom: 8px;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1d4ed8 !important;
        }

        .stream-card-head h3 {
            font-size: 1.12rem;
        }

        .stream-card-desc {
            margin-top: 16px;
            line-height: 1.7;
        }

        .stream-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .stream-card-meta span {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8 !important;
            font-size: 0.76rem;
            font-weight: 700;
        }

        .stream-attachments {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .attachment-chip {
            display: inline-flex;
            align-items: center;
            padding: 9px 12px;
            border-radius: 14px;
            border: 1px solid #dbe4f0;
            background: #fff;
            color: #0f172a !important;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .attachment-chip.is-disabled {
            opacity: 0.6;
        }

        .topic-card {
            padding: 22px;
        }

        .topic-head {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
            margin-bottom: 18px;
        }

        .topic-head h3 {
            margin-top: 12px;
        }

        .topic-count {
            color: #64748b !important;
            font-weight: 700;
            font-size: 0.84rem;
        }

        .topic-task-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .topic-task-card {
            padding: 16px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .topic-task-card strong {
            display: block;
            margin-bottom: 8px;
        }

        .people-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .people-card {
            padding: 22px;
        }

        .people-card strong {
            display: block;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.74rem;
            margin-bottom: 12px;
        }

        .people-card h3 {
            margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .stats-wrapper,
            .division-detail-grid,
            .mini-board {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .highlight-grid,
            .journey-grid,
            .tree-cluster-grid,
            .gallery-grid,
            .admin-panel-grid,
            .login-choice-grid,
            .session-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .division-icon-grid,
            .gallery-feature,
            .classroom-grid,
            .modal-content-grid,
            .classroom-layout-overview,
            .classroom-layout,
            .topic-task-grid,
            .people-grid {
                grid-template-columns: 1fr;
            }

            .bento-wide,
            .bento-side,
            .bento-quarter {
                grid-column: span 12;
            }

            .bento-wide {
                padding: 32px;
            }

            .bento-side {
                flex-direction: row;
                gap: 32px;
                text-align: left;
                padding: 32px;
            }

            .bento-side img {
                margin-bottom: 0;
                width: 90px;
                height: 90px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .navbar {
                width: calc(100% - 32px);
            }

            .auth-pill {
                display: none;
            }

            .classroom-sidebar {
                position: static;
            }

            .board-pembina,
            .board-bph,
            .board-koor {
                grid-column: 1 / -1;
            }

            .list-grid,
            .split-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 8px 12px;
            }

            .nav-links {
                display: none;
            }

            .nav-brand {
                border-right: none;
                padding-right: 0;
            }

            .btn-secondary {
                display: none;
            }

            .highlight-grid,
            .journey-grid,
            .division-icon-grid,
            .tree-cluster-grid,
            .gallery-grid,
            .admin-panel-grid,
            .login-choice-grid,
            .session-grid {
                grid-template-columns: 1fr;
            }

            .bento-side {
                flex-direction: column;
                text-align: center;
            }

            .hero-cta,
            .section-actions {
                flex-direction: column;
                width: 100%;
                padding: 0 24px;
            }

            .btn,
            .section-actions .btn {
                width: 100%;
            }

            .section {
                padding: 80px 0;
            }

            .achievement-row {
                padding: 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .stats-wrapper,
            .division-detail-grid,
            .mini-board,
            .page-meta {
                grid-template-columns: 1fr;
            }

            .coming-card {
                padding: 40px 24px;
            }

            .person-card {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .person-media {
                margin: 0 auto;
            }

            .task-head {
                flex-direction: column;
            }

            .toast-stack {
                top: 16px;
                right: 16px;
            }
        }
    </style>
</head>
<body>
    @include('scitos.partials.nav')
    @include('scitos.partials.toast')

    @yield('content')

    @if (data_get(session('scitos_auth'), 'role') === 'admin')
        <a href="{{ route('admin.panel') }}" class="admin-fab" aria-label="Buka panel admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 8.92 4.6H9A1.65 1.65 0 0 0 10 3.09V3a2 2 0 0 1 4 0v.09A1.65 1.65 0 0 0 15 4.6a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9c.36.61.98.99 1.69 1H21a2 2 0 0 1 0 4h-.09c-.71.01-1.33.39-1.51 1Z"></path>
            </svg>
        </a>
    @endif

    @include('scitos.partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.querySelector('[data-session-toast]');

            if (!toast) {
                return;
            }

            window.setTimeout(() => {
                toast.classList.add('is-hiding');
            }, 3600);

            toast.addEventListener('animationend', () => {
                if (!toast.classList.contains('is-hiding')) {
                    return;
                }

                toast.parentElement?.remove();
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
