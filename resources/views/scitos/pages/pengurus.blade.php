@extends('layouts.scitos')

@php
    $board = data_get($scitos, 'board', []);
    $divisions = collect(data_get($scitos, 'divisions', []));
    $coordinatorGroups = $divisions
        ->flatMap(function ($division) {
            return collect($division['leaders'] ?? [])->map(function ($leader) use ($division) {
                return array_merge($leader, [
                    'division' => $division['name'],
                    'group_label' => $division['slug'] === 'esports' ? 'Esports Unit' : $division['group'],
                ]);
            });
        })
        ->groupBy('group_label');
@endphp

@section('content')
<style>
    /* Styling Khusus Halaman Kepengurusan (Family Tree) */
    .page-hero {
        padding-top: 140px;
        padding-bottom: 60px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-bottom: 1px dashed var(--border-dim);
    }

    .page-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        width: 100%;
        margin-top: 48px;
    }

    .meta-card {
        padding: 24px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .meta-card strong {
        font-family: "Space Mono", monospace;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--neon-pink);
        line-height: 1;
        margin-bottom: 8px;
        text-shadow: 4px 4px 0px rgba(255, 0, 85, 0.2);
    }

    .meta-card span {
        font-size: 0.85rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    /* Family Tree Hierarchy */
    .family-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
    }

    .tree-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 32px;
        width: 100%;
        z-index: 2;
    }

    /* Glowing Connector Lines */
    .tree-line {
        width: 2px;
        height: 60px;
        background: linear-gradient(to bottom, transparent, var(--neon-cyan), transparent);
        margin: 8px auto;
        position: relative;
        z-index: 1;
    }

    .tree-line::after {
        content: '';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 10px; height: 10px;
        background: var(--bg-body);
        border: 2px solid var(--neon-cyan);
        border-radius: 50%;
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    /* Cluster Grids */
    .tree-cluster-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
        width: 100%;
        margin-top: 20px;
    }

    .tree-cluster {
        padding: 40px;
        border-top: 2px solid var(--neon-purple); /* Aksen warna beda untuk grup */
    }

    .tree-cluster-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 1px dashed var(--border-dim);
        padding-bottom: 16px;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .tree-cluster-head span {
        font-family: "Space Mono", monospace;
        font-size: 0.85rem;
        color: var(--neon-cyan);
        display: block;
        margin-bottom: 4px;
    }

    .tree-cluster-head h3 {
        font-size: 1.8rem;
        color: var(--text-title);
        margin: 0;
    }

    .tree-cluster-head p {
        background: rgba(255, 255, 255, 0.05);
        padding: 6px 14px;
        border-radius: var(--radius-pill);
        font-size: 0.85rem;
        font-family: "Space Mono", monospace;
        color: var(--text-muted);
        margin: 0;
        border: 1px solid var(--border-dim);
    }

    .tree-member-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }

    /* Profile Card Custom Layout - Memaksa Foto di Atas */
    .profile-card {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        gap: 12px;
    }

    /* Pindahkan kontainer gambar atau gambar ke urutan paling atas */
    .profile-card > :has(img),
    .profile-card > img {
        order: -1 !important;
        margin-bottom: 8px;
    }

    /* Percantik tampilan foto profil agar konsisten */
    .profile-card img {
        width: 100px !important;
        height: 100px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        border: 2px solid var(--neon-cyan) !important;
        box-shadow: 0 0 15px rgba(0, 240, 255, 0.3) !important;
    }

    /* Memastikan container sosmed (biasanya berupa flex row) berada di tengah */
    .profile-card .social-links,
    .profile-card .socials,
    .profile-card [class*="flex"],
    .profile-card > div:last-child {
        justify-content: center !important;
        width: 100%;
    }

    /* Sembunyikan elemen bio jika ada yang terlewat */
    .profile-card .bio,
    .profile-card .description {
        display: none !important;
    }

    /* Container for the person cards to ensure they match the cyber theme */
    .tree-root-card, .tree-vice-card {
        width: 100%;
        max-width: 320px;
    }

    @media (max-width: 768px) {
        .tree-cluster { padding: 24px; }
        .tree-cluster-head { flex-direction: column; align-items: flex-start; }
    }
</style>

<main>
    <section class="page-hero container">
        <div class="badge">Kepengurusan SCI-TOS</div>
        <h1 class="hero-title" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 1000px;">
            <span class="text-gradient">Family Tree</span> kepengurusan yang menjaga ritme organisasi.
        </h1>
        <p class="hero-desc">
            Struktur periode {{ data_get($board, 'period') }} ditata seperti jaringan server kerja: pembina sebagai root, executive lead, node operasional, dan koordinator divisi yang menjaga setiap jalur pembelajaran tetap aktif dan menyala.
        </p>
        
        <div class="page-meta">
            <div class="cyber-card meta-card">
                <strong>{{ data_get($board, 'period') }}</strong>
                <span>Periode Aktif</span>
            </div>
            <div class="cyber-card meta-card">
                <strong>{{ 1 + count(data_get($board, 'vice_chairs', [])) + collect(data_get($board, 'clusters', []))->sum(fn ($cluster) => count($cluster['items'] ?? [])) }}</strong>
                <span>Executive & Node Operasional</span>
            </div>
            <div class="cyber-card meta-card">
                <strong>{{ $coordinatorGroups->flatten(1)->count() }}</strong>
                <span>Koordinator Divisi</span>
            </div>
        </div>
    </section>

    <!-- Struktur Inti (Root) -->
    <section class="section container">
        <div class="section-header">
            <div class="badge">Root Node</div>
            <h2 class="section-title">Dari pembina hingga eksekutif.</h2>
            <p class="section-desc">Jalur komando utama yang memastikan seluruh divisi dan program kerja tereksekusi dengan visi yang terarah.</p>
        </div>

        <div class="family-tree">
            <!-- Pembina -->
            <div class="tree-row">
                <div class="tree-root-card">
                    @include('scitos.partials.person-card', [
                        'person' => data_get($board, 'advisor'),
                        'showBio' => false,
                        'cardClass' => 'cyber-card profile-card',
                        'photoLabel' => 'Foto pembina belum ditambahkan.',
                    ])
                </div>
            </div>

            <div class="tree-line"></div>

            <!-- Ketua Umum -->
            <div class="tree-row">
                <div class="tree-root-card">
                    @include('scitos.partials.person-card', [
                        'person' => data_get($board, 'chair'),
                        'showBio' => false,
                        'cardClass' => 'cyber-card profile-card',
                        'photoLabel' => 'Foto ketua umum belum ditambahkan.',
                    ])
                </div>
            </div>

            <div class="tree-line"></div>

            <!-- Wakil Ketua -->
            <div class="tree-row">
                @foreach (data_get($board, 'vice_chairs', []) as $viceChair)
                    <div class="tree-vice-card">
                        @include('scitos.partials.person-card', [
                            'person' => $viceChair,
                            'showBio' => false,
                            'cardClass' => 'cyber-card profile-card',
                            'photoLabel' => 'Foto wakil ketua belum ditambahkan.',
                        ])
                    </div>
                @endforeach
            </div>

            <div class="tree-line" style="height: 80px; background: linear-gradient(to bottom, var(--neon-cyan), transparent);"></div>

            <!-- Cluster Operasional (BPH dll) -->
            <div class="tree-cluster-grid">
                @foreach (data_get($board, 'clusters', []) as $cluster)
                    <div class="cyber-card tree-cluster" style="border-top-color: var(--neon-pink);">
                        <div class="tree-cluster-head">
                            <div>
                                <span>// {{ $cluster['subtitle'] }}</span>
                                <h3>{{ $cluster['title'] }}</h3>
                            </div>
                            <p>[ {{ count($cluster['items']) }} NODE AKTIF ]</p>
                        </div>

                        <div class="tree-member-grid">
                            @foreach ($cluster['items'] as $member)
                                @include('scitos.partials.person-card', [
                                    'person' => $member,
                                    'showBio' => false,
                                    'cardClass' => 'cyber-card profile-card',
                                    'photoLabel' => 'Foto profil belum ditambahkan.',
                                ])
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Koordinator Divisi -->
    <section class="section container">
        <div class="section-header">
            <div class="badge">Branch Nodes</div>
            <h2 class="section-title">Koordinator Divisi.</h2>
            <p class="section-desc">Mentor dan pengarah jalan utama yang mengelola ritme latihan, eksekusi tugas kreatif, dan manajemen project karya di masing-masing divisi.</p>
        </div>

        <div class="tree-cluster-grid">
            @foreach ($coordinatorGroups as $groupLabel => $members)
                <div class="cyber-card tree-cluster">
                    <div class="tree-cluster-head">
                        <div>
                            <span>/> cluster_group</span>
                            <h3>{{ $groupLabel }}</h3>
                        </div>
                        <p>[ {{ $members->count() }} KOORDINATOR ]</p>
                    </div>

                    <div class="tree-member-grid">
                        @foreach ($members as $member)
                            @include('scitos.partials.person-card', [
                                'person' => $member,
                                'showDivision' => true,
                                'showBio' => false,
                                'special' => data_get($member, 'special_card', false),
                                'cardClass' => 'cyber-card profile-card',
                                'photoLabel' => 'Foto koordinator belum ditambahkan.',
                            ])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection