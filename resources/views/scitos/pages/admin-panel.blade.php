@extends('layouts.admin')

@php
    $authUser = session('scitos_auth');
    $activeAdminRole = data_get($authUser, 'admin_role', 'admin');
    $adminRoles = data_get($scitos, 'auth.admin_roles', []);
    $activeRoleConfig = data_get($adminRoles, $activeAdminRole, []);
    $modules = [
        [
            'title' => 'Classroom Console',
            'access' => 'admin',
            'summary' => 'Pantau tugas, status challenge, dan alur briefing koordinator divisi.',
            'tags' => ['Classroom', 'Task Board', 'Monitoring'],
        ],
        [
            'title' => 'Gallery Console',
            'access' => 'admin',
            'summary' => 'Melihat arsip karya, media showcase, dan status koleksi gallery SCI-TOS.',
            'tags' => ['Gallery', 'Media', 'Collection'],
        ],
        [
            'title' => 'Website Insights',
            'access' => 'admin',
            'summary' => 'Membaca ringkasan modul website, halaman aktif, dan titik pengembangan berikutnya.',
            'tags' => ['Insight', 'Website', 'Overview'],
        ],
        [
            'title' => 'Content Settings',
            'access' => 'executive',
            'summary' => 'Mengatur seluruh konten beranda, detail divisi, struktur pengurus, dan informasi pendaftaran.',
            'tags' => ['Content', 'Homepage', 'Control'],
        ],
        [
            'title' => 'Divisi & Pengurus Editor',
            'access' => 'executive',
            'summary' => 'Membuka akses pengelolaan penuh untuk data divisi, koordinator, dan tree kepengurusan.',
            'tags' => ['Divisi', 'Pengurus', 'Editor'],
        ],
        [
            'title' => 'System Access Control',
            'access' => 'executive',
            'summary' => 'Mengelola seluruh fitur spesial admin dan akses penuh ke modul internal website.',
            'tags' => ['Security', 'Permission', 'Executive'],
        ],
    ];
    $openModules = collect($modules)->filter(function ($module) use ($activeAdminRole) {
        return $module['access'] === 'admin' || $activeAdminRole === 'executive';
    });
@endphp

@section('content')
<main class="admin-container">
    <div class="admin-page-shell">
        <aside class="admin-card admin-sidebar">
            <span class="admin-kicker">Backoffice</span>
            <h2 style="margin-top: 14px;">Menu Admin</h2>
            <p style="margin-top: 10px;">Panel ini dipakai untuk memantau modul website SCI-TOS dengan tampilan yang lebih ringan dan mudah dipakai.</p>

            <ul class="admin-menu">
                <li><a href="#overview">Dashboard <small>{{ $openModules->count() }} aktif</small></a></li>
                <li><a href="#roles">Role Admin <small>{{ data_get($authUser, 'admin_label') }}</small></a></li>
                <li><a href="#modules">Feature Access <small>{{ $activeAdminRole === 'executive' ? 'Full' : 'Limited' }}</small></a></li>
                <li><a href="{{ route('home') }}">Kembali ke Website <small>Home</small></a></li>
            </ul>
        </aside>

        <section class="admin-card admin-main-panel">
            <div class="admin-head" id="overview">
                <div>
                    <span class="admin-kicker">SCI-TOS Admin Panel</span>
                    <h1>Dashboard {{ data_get($authUser, 'admin_label', 'Admin') }}</h1>
                    <p>{{ data_get($activeRoleConfig, 'summary') }}</p>
                </div>

                <span class="admin-role-badge {{ $activeAdminRole === 'executive' ? 'is-executive' : '' }}">
                    {{ data_get($authUser, 'admin_label', 'Admin') }}
                </span>
            </div>

            <div class="admin-stat-grid">
                <div class="admin-card admin-stat-card">
                    <strong>{{ $openModules->count() }}</strong>
                    <span>Modul yang bisa diakses sekarang</span>
                </div>
                <div class="admin-card admin-stat-card">
                    <strong>{{ collect($modules)->where('access', 'executive')->count() }}</strong>
                    <span>Modul executive control</span>
                </div>
                <div class="admin-card admin-stat-card">
                    <strong>{{ count(data_get($activeRoleConfig, 'permissions', [])) }}</strong>
                    <span>Hak akses pada level ini</span>
                </div>
            </div>

            <div class="admin-section" id="roles">
                <h3>Role Admin</h3>
                <div class="admin-role-grid">
                    @foreach ($adminRoles as $key => $roleConfig)
                        <div class="admin-card admin-role-card {{ $key === 'executive' ? 'is-executive' : '' }}">
                            <span class="admin-kicker">{{ $roleConfig['label'] }}</span>
                            <p style="margin-top: 14px;">{{ $roleConfig['summary'] }}</p>
                            <ul>
                                @foreach ($roleConfig['permissions'] as $permission)
                                    <li>{{ $permission }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="admin-section" id="modules">
                <h3>Feature Access</h3>
                <div class="admin-module-grid">
                    @foreach ($modules as $module)
                        @php
                            $isOpen = $module['access'] === 'admin' || $activeAdminRole === 'executive';
                        @endphp
                        <div class="admin-card admin-module-card">
                            <div style="display: flex; justify-content: space-between; gap: 16px; align-items: flex-start;">
                                <div>
                                    <span class="admin-kicker">{{ $module['access'] === 'executive' ? 'Executive Only' : 'Admin Access' }}</span>
                                    <h3 style="margin-top: 12px;">{{ $module['title'] }}</h3>
                                </div>
                                <span class="admin-access {{ $isOpen ? 'is-open' : 'is-restricted' }}">
                                    {{ $isOpen ? 'Available' : 'Restricted' }}
                                </span>
                            </div>

                            <p>{{ $module['summary'] }}</p>

                            <div class="admin-module-meta">
                                @foreach ($module['tags'] as $tag)
                                    <span class="admin-tag">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <ul>
                                <li>{{ $isOpen ? 'Modul ini bisa dibuka pada level akses Anda.' : 'Modul ini hanya dibuka untuk executive admin.' }}</li>
                                <li>{{ $module['access'] === 'executive' ? 'Dipakai untuk kontrol penuh dan pengaturan inti website.' : 'Dipakai untuk pemantauan operasional dan fitur spesial yang sudah diizinkan.' }}</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
