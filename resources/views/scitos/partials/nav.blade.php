@php
    $brand = data_get($scitos, 'brand');
    $authUser = session('scitos_auth');
    $menuItems = [
        ['route' => 'tentang', 'label' => 'Tentang'],
        ['route' => 'prestasi', 'label' => 'Prestasi'],
        ['route' => 'divisi', 'label' => 'Divisi'],
        ['route' => 'pengurus', 'label' => 'Pengurus'],
        ['route' => 'gallery', 'label' => 'Gallery'],
        ['route' => 'classroom', 'label' => 'Classroom'],
    ];
@endphp

<div class="navbar-wrapper">
    <nav class="navbar">
        <div class="nav-group">
            <a
                href="{{ route('login') }}"
                class="nav-profile-btn {{ request()->routeIs('login') ? 'is-active' : '' }}"
                aria-label="Login Profile"
                @if (request()->routeIs('login')) aria-current="page" @endif
            >
                @if ($authUser)
                    <span class="nav-profile-initial">
                        {{ data_get($authUser, 'role') === 'admin' ? (data_get($authUser, 'admin_role') === 'executive' ? 'E' : 'A') : 'M' }}
                    </span>
                @else
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: relative; z-index: 2;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                @endif
            </a>

            <a href="{{ route('home') }}" class="nav-brand">
                <img src="{{ asset(data_get($brand, 'logo')) }}" alt="Logo">
                {{ data_get($brand, 'name') }}
            </a>
        </div>

        <div class="nav-links">
            @foreach ($menuItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="{{ request()->routeIs($item['route']) ? 'is-active' : '' }}"
                    @if (request()->routeIs($item['route'])) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="nav-group nav-actions">
            @if ($authUser)
                <div class="auth-pill">
                    <strong>{{ data_get($authUser, 'name') }}</strong>
                    <span>{{ data_get($authUser, 'role') === 'admin' ? data_get($authUser, 'admin_label', 'Mode Admin') : 'Mode Anggota' }}</span>
                </div>
            @endif

            <a
                href="{{ route('gabung') }}"
                class="btn btn-secondary {{ request()->routeIs('gabung') ? 'is-active' : '' }}"
                @if (request()->routeIs('gabung')) aria-current="page" @endif
            >
                Gabung
            </a>
            <a
                href="{{ route('ai-chat') }}"
                class="btn btn-ai {{ request()->routeIs('ai-chat') ? 'is-active' : '' }}"
                aria-label="Tanya AI Chatbot"
                @if (request()->routeIs('ai-chat')) aria-current="page" @endif
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                    <path d="M5 3v4"></path>
                    <path d="M7 5H3"></path>
                </svg>
                Tanya AI
            </a>
        </div>
    </nav>
</div>
