<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle ?? 'Admin SCI-TOS' }}</title>
    <meta name="description" content="{{ $pageDescription ?? data_get($scitos, 'meta.default_description') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f4f5f7;
            --admin-surface: #ffffff;
            --admin-surface-soft: #f8f9fb;
            --admin-border: #e4e7ec;
            --admin-text: #111827;
            --admin-muted: #667085;
            --admin-primary: #2f4858;
            --admin-accent: #0f172a;
            --admin-success: #0f9d58;
            --admin-warning: #f59e0b;
            --admin-shadow: 0 18px 32px rgba(15, 23, 42, 0.06);
            --admin-radius: 20px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--admin-bg);
            color: var(--admin-text);
            font-family: "Inter", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--admin-border);
        }

        .admin-topbar-inner {
            width: min(1320px, calc(100% - 32px));
            margin: 0 auto;
            min-height: 84px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .admin-brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #d1d5db;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .admin-brand-mark img {
            width: 74%;
            height: 74%;
            object-fit: contain;
        }

        .admin-brand-text span {
            display: block;
            font-size: 0.76rem;
            font-weight: 600;
            color: var(--admin-muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .admin-brand-text strong {
            display: block;
            font-size: 1.04rem;
            color: var(--admin-accent);
        }

        .admin-topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .admin-topbar-center {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            flex: 1;
        }

        .admin-toplink {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: var(--admin-surface-soft);
            border: 1px solid transparent;
            color: var(--admin-muted);
            font-size: 0.84rem;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .admin-toplink:hover {
            background: #fff;
            border-color: var(--admin-border);
            color: var(--admin-accent);
        }

        .admin-toplink::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #cbd5e1;
            transition: 0.2s ease;
        }

        .admin-toplink:hover::before {
            background: var(--admin-primary);
        }

        .admin-chip {
            display: inline-flex;
            align-items: center;
            padding: 10px 14px;
            border-radius: 999px;
            background: var(--admin-surface-soft);
            border: 1px solid var(--admin-border);
            font-size: 0.86rem;
            color: var(--admin-text);
            gap: 8px;
        }

        .admin-chip span {
            color: var(--admin-muted);
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 42px;
            padding: 0 16px;
            border-radius: 12px;
            border: 1px solid var(--admin-border);
            background: var(--admin-surface);
            color: var(--admin-text);
            font-weight: 600;
            cursor: pointer;
            box-shadow: none;
            transition: 0.2s ease;
        }

        .admin-btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--admin-shadow);
        }

        .admin-btn-primary {
            background: var(--admin-accent);
            color: #fff;
            border-color: var(--admin-accent);
        }

        .admin-container {
            width: min(1320px, calc(100% - 32px));
            margin: 28px auto 56px;
        }

        .admin-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: var(--admin-radius);
            box-shadow: var(--admin-shadow);
        }

        .admin-page-shell {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }

        .admin-sidebar {
            padding: 22px;
            position: sticky;
            top: 100px;
        }

        .admin-kicker {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eef2f6;
            color: var(--admin-primary);
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .admin-sidebar h2,
        .admin-main-panel h1,
        .admin-main-panel h3 {
            color: var(--admin-accent);
            line-height: 1.2;
        }

        .admin-sidebar p,
        .admin-main-panel p,
        .admin-main-panel li {
            color: var(--admin-muted);
        }

        .admin-menu {
            list-style: none;
            display: grid;
            gap: 10px;
            margin-top: 22px;
        }

        .admin-menu a,
        .admin-menu span {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: var(--admin-surface-soft);
            border: 1px solid transparent;
            font-weight: 600;
            color: var(--admin-text);
        }

        .admin-menu a:hover {
            border-color: var(--admin-border);
            background: #fff;
        }

        .admin-main-panel {
            padding: 28px;
        }

        .admin-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .admin-head h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            margin-top: 10px;
        }

        .admin-head p {
            max-width: 720px;
            margin-top: 12px;
            font-size: 1rem;
            line-height: 1.7;
        }

        .admin-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: #eef7f0;
            color: var(--admin-success);
            font-weight: 700;
        }

        .admin-role-badge.is-executive {
            background: #eef2ff;
            color: #4338ca;
        }

        .admin-stat-grid,
        .admin-module-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .admin-stat-card,
        .admin-module-card,
        .admin-role-card {
            padding: 22px;
        }

        .admin-stat-card strong {
            display: block;
            font-size: 1.6rem;
            color: var(--admin-accent);
            margin-bottom: 10px;
        }

        .admin-stat-card span {
            color: var(--admin-muted);
            font-size: 0.92rem;
        }

        .admin-section {
            margin-top: 28px;
        }

        .admin-section h3 {
            font-size: 1.2rem;
            margin-bottom: 16px;
        }

        .admin-role-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .admin-role-card ul,
        .admin-module-card ul {
            list-style: none;
            display: grid;
            gap: 10px;
            margin-top: 16px;
        }

        .admin-role-card li,
        .admin-module-card li {
            padding: 10px 12px;
            border-radius: 12px;
            background: var(--admin-surface-soft);
            border: 1px solid var(--admin-border);
        }

        .admin-role-card.is-executive {
            border-color: #c7d2fe;
            background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        }

        .admin-module-card {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .admin-module-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .admin-tag {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--admin-surface-soft);
            border: 1px solid var(--admin-border);
            color: var(--admin-muted);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .admin-access {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .admin-access.is-open {
            background: #eef7f0;
            color: var(--admin-success);
        }

        .admin-access.is-restricted {
            background: #fff7ed;
            color: var(--admin-warning);
        }

        .toast-stack {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 70;
        }

        .session-toast {
            min-width: min(360px, calc(100vw - 32px));
            max-width: 420px;
            padding: 14px 16px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--admin-border);
            box-shadow: var(--admin-shadow);
            display: flex;
            align-items: center;
            gap: 14px;
            transform: translateY(-18px) scale(0.96);
            opacity: 0;
            animation: admin-toast-in 0.28s ease forwards;
        }

        .session-toast.is-hiding {
            animation: admin-toast-out 0.32s ease forwards;
        }

        .session-toast-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf2f7;
            color: var(--admin-primary);
            flex-shrink: 0;
        }

        .session-toast-body strong {
            display: block;
            color: var(--admin-accent);
        }

        .session-toast-body p {
            color: var(--admin-muted);
            margin-top: 2px;
            font-size: 0.88rem;
        }

        @keyframes admin-toast-in {
            from { opacity: 0; transform: translateY(-18px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes admin-toast-out {
            from { opacity: 1; transform: translateY(0) scale(1); }
            to { opacity: 0; transform: translateY(-16px) scale(0.96); }
        }

        @media (max-width: 980px) {
            .admin-page-shell,
            .admin-role-grid,
            .admin-stat-grid,
            .admin-module-grid {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                position: static;
            }

            .admin-topbar-inner {
                flex-wrap: wrap;
                padding: 14px 0;
            }

            .admin-topbar-center {
                order: 3;
                width: 100%;
                justify-content: flex-start;
            }

            .admin-topbar-actions {
                margin-left: auto;
            }
        }

        @media (max-width: 640px) {
            .admin-topbar-inner {
                width: calc(100% - 24px);
                align-items: flex-start;
            }

            .admin-container {
                width: calc(100% - 24px);
            }

            .admin-topbar-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .admin-toplink {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    @include('scitos.partials.toast')

    <header class="admin-topbar">
        <div class="admin-topbar-inner">
            <a href="{{ route('admin.panel') }}" class="admin-brand">
                <span class="admin-brand-mark">
                    <img src="{{ asset(data_get($scitos, 'brand.logo')) }}" alt="Logo SCI-TOS">
                </span>
                <span class="admin-brand-text">
                    <span>SCI-TOS</span>
                    <strong>Admin</strong>
                </span>
            </a>

            <nav class="admin-topbar-center" aria-label="Admin navigation">
                <a href="#overview" class="admin-toplink">Overview</a>
                <a href="#roles" class="admin-toplink">Role Admin</a>
                <a href="#modules" class="admin-toplink">Feature Access</a>
            </nav>

            <div class="admin-topbar-actions">
                <div class="admin-chip">
                    <strong>{{ data_get(session('scitos_auth'), 'name') }}</strong>
                    <span>{{ data_get(session('scitos_auth'), 'admin_label', 'Admin') }}</span>
                </div>
                <a href="{{ route('home') }}" class="admin-btn">Kembali ke Website</a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="admin-btn admin-btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </header>

    @yield('content')

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
</body>
</html>
