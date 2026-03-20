@extends('layouts.scitos')

@php
    $brand = data_get($scitos, 'brand');
    $authUser = session('scitos_auth');
    $quickFacts = data_get($scitos, 'quick_facts', []);
    $highlights = data_get($scitos, 'highlights', []);
    $journey = data_get($scitos, 'journey', []);
    $history = data_get($scitos, 'history', []);
    $emblems = data_get($scitos, 'emblems', []);
    $achievements = data_get($scitos, 'achievements', []);
    $divisions = data_get($scitos, 'divisions', []);
    $board = data_get($scitos, 'board', []);
    $gallery = data_get($scitos, 'gallery.items', []);
    $classroom = data_get($scitos, 'classroom', []);
    $registration = data_get($scitos, 'registration', []);
    $coordinatorCount = collect($divisions)->sum(fn ($division) => count($division['leaders'] ?? []));
@endphp

@section('content')
<main id="top">
    <section class="hero container">
        <div class="badge">Sains & Teknologi SMAN 4 Bekasi</div>

        @if ($authUser)
            <div class="hero-status">
                <span>
                    {{ data_get($authUser, 'role') === 'admin'
                        ? data_get($authUser, 'admin_label', 'Admin Mode')
                        : 'Member Mode' }}
                </span>
                <strong>{{ data_get($authUser, 'name') }}</strong>
                <p style="margin: 0; color: var(--text-muted);">
                    {{ data_get($authUser, 'role') === 'admin'
                        ? (data_get($authUser, 'admin_role') === 'executive'
                            ? 'Akses executive admin aktif dan seluruh kontrol website siap dibuka dari panel admin.'
                            : 'Akses admin biasa aktif dan fitur spesial yang diizinkan siap dibuka dari panel admin.')
                        : 'Classroom SCI-TOS siap dipakai untuk tugas dan challenge divisi.' }}
                </p>
            </div>
        @endif

        <h1 class="hero-title">{{ data_get($brand, 'tagline') }} <span class="text-gradient">Eksplorasi tanpa batas.</span></h1>
        <p class="hero-desc">
            Ruang kolaborasi bagi siswa yang ingin berkembang lewat ide, eksperimen, kompetisi, karya visual, dan sistem digital. SCI-TOS mempertemukan sains, teknologi, dokumentasi, dan mentoring dalam satu ekosistem yang hidup.
        </p>
        <div class="hero-cta">
            <a href="{{ route('gabung') }}" class="btn btn-primary">Mulai Eksplorasi</a>
            <a href="{{ route('gallery') }}" class="btn btn-secondary">Lihat Gallery</a>
        </div>

        <div class="stats-wrapper">
            @foreach ($quickFacts as $fact)
                <div class="cyber-card stat-box">
                    <span class="stat-val">{{ $fact['value'] }}</span>
                    <br>
                    <span class="stat-lbl">{{ $fact['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section container">
        <div class="section-header">
            <div class="badge">Mission Control</div>
            <h2 class="section-title">Beranda yang terasa seperti pusat operasi SCI-TOS.</h2>
            <p class="section-desc">Lebih dari ekskul, SCI-TOS dirancang seperti workspace kreatif tempat ide diuji, dibentuk, dan dipamerkan.</p>
        </div>

        <div class="highlight-grid">
            @foreach ($highlights as $item)
                <div class="cyber-card highlight-card">
                    <span class="mini-label">{{ $item['eyebrow'] }}</span>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <div class="div-tags">
                        @foreach ($item['tags'] as $tag)
                            <span class="div-tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="tentang" class="section container">
        <div class="section-header">
            <div class="badge">Tentang Kami</div>
            <h2 class="section-title">Satu ekosistem inovasi.</h2>
            <p class="section-desc">Lahir dari penyatuan visi KIR BIMAFIKI dan APLIKASI 4, lalu tumbuh menjadi ruang belajar multidisiplin.</p>
            <div class="section-actions">
                <a href="{{ route('tentang') }}" class="btn btn-secondary">Lihat Detail Tentang</a>
            </div>
        </div>

        <div class="bento-grid">
            <div class="cyber-card bento-wide">
                <p style="font-size: 1.15rem; color: var(--text-primary); margin-bottom: 24px; font-weight: 500;">
                    SCI-TOS bukan sekadar ekstrakurikuler, tetapi ruang pertemuan antara pola pikir ilmiah dan keterampilan teknologi. Anggota diajak berpikir kritis, mengerjakan proyek, mendokumentasikan proses, dan mengubah ide menjadi karya.
                </p>
                <div class="history-list">
                    @foreach ($history as $item)
                        <div class="history-item">
                            <span class="h-year">{{ $item['label'] }}</span>
                            <span class="h-title">{{ $item['title'] }}</span>
                            <p style="font-size: 0.95rem; color: var(--text-muted); margin-top: 6px;">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="cyber-card bento-side">
                <img src="{{ asset(data_get($brand, 'logo')) }}" alt="Lambang SCI-TOS">
                <div>
                    <h3 style="margin-bottom: 8px;">Identitas Visual</h3>
                    <p style="font-size: 0.95rem; color: var(--text-muted);">Logo merepresentasikan kecerdasan, konektivitas sirkuit, dan energi tanpa batas yang menghubungkan banyak bakat dalam satu sistem.</p>
                </div>
            </div>

            @foreach (array_slice($emblems, 0, 2) as $item)
                <div class="cyber-card bento-quarter">
                    <div class="icon-wrap">
                        {!! $item['icon'] !!}
                    </div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section container">
        <div class="section-header">
            <div class="badge">System Flow</div>
            <h2 class="section-title">Cara belajar yang bergerak dari ide ke output.</h2>
            <p class="section-desc">SCI-TOS dibangun dengan alur eksplorasi yang mendorong anggota untuk terus bergerak, bukan hanya hadir.</p>
        </div>

        <div class="journey-grid">
            @foreach ($journey as $step)
                <div class="cyber-card journey-card">
                    <span class="journey-step">{{ $step['step'] }}</span>
                    <h3>{{ $step['title'] }}</h3>
                    <p>{{ $step['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="prestasi" class="section container">
        <div class="section-header">
            <div class="badge">Pencapaian</div>
            <h2 class="section-title">Jejak karya & kompetisi.</h2>
            <p class="section-desc">Preview pencapaian yang menunjukkan konsistensi SCI-TOS di panggung akademik, sains, dan kreativitas digital.</p>
            <div class="section-actions">
                <a href="{{ route('prestasi') }}" class="btn btn-secondary">Lihat Semua Prestasi</a>
            </div>
        </div>

        <div class="terminal-window">
            <div class="terminal-header">
                <div class="terminal-dots">
                    <span></span><span></span><span></span>
                </div>
                <div class="terminal-title">~/sci-tos/prestasi_preview.sh</div>
            </div>
            <div>
                @foreach (array_slice($achievements, 0, 6) as $index => $achievement)
                    <div class="achievement-row">
                        <div class="a-index">{{ sprintf('%02d', $index + 1) }}</div>
                        <div class="a-text">{{ $achievement }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <p class="terminal-note">Menampilkan 6 highlight teratas dari total {{ count($achievements) }} pencapaian SCI-TOS.</p>
    </section>

    <section id="divisi" class="section container">
        <div class="section-header">
            <div class="badge">Struktur Divisi</div>
            <h2 class="section-title">Sembilan fokus, satu tujuan.</h2>
            <p class="section-desc">Setiap divisi punya ritme, skill, dan mentor yang berbeda, tetapi semuanya terhubung dalam sistem SCI-TOS yang sama.</p>
            <div class="section-actions">
                <a href="{{ route('divisi') }}" class="btn btn-secondary">Buka Semua Divisi</a>
            </div>
        </div>

        <div class="division-icon-grid">
            @foreach (array_slice($divisions, 0, 6) as $division)
                <a href="{{ route('divisi') }}" class="cyber-card division-icon-card">
                    <div class="division-icon-top">
                        <div class="division-icon-frame">
                            <img src="{{ asset($division['icon']) }}" alt="{{ $division['name'] }}">
                        </div>
                        <div class="division-icon-meta">
                            <strong>{{ $division['name'] }}</strong>
                            <span>{{ $division['group'] }}</span>
                        </div>
                    </div>
                    <p>{{ $division['summary'] }}</p>
                    <span class="division-card-hint">Klik di menu divisi</span>
                </a>
            @endforeach
        </div>
    </section>

    <section id="gallery" class="section container">
        <div class="section-header">
            <div class="badge">SCI-TOS Gallery</div>
            <h2 class="section-title">Karya visual, dokumentasi, dan video anggota.</h2>
            <p class="section-desc">Gallery menjadi etalase output SCI-TOS, mulai dari poster, prototype, UI, dokumentasi kegiatan, hingga highlight video.</p>
            <div class="section-actions">
                <a href="{{ route('gallery') }}" class="btn btn-secondary">Masuk ke Gallery</a>
            </div>
        </div>

        <div class="gallery-grid">
            @foreach (array_slice($gallery, 0, 3) as $item)
                <article class="cyber-card gallery-card {{ $item['type'] === 'Video' ? 'is-video' : '' }}">
                    <div class="gallery-media">
                        <img src="{{ asset($item['media']) }}" alt="{{ $item['title'] }}">
                    </div>
                    <div class="gallery-meta">
                        <span>{{ $item['type'] }}</span>
                        <span>{{ $item['division'] }}</span>
                        <span>{{ $item['year'] }}</span>
                    </div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="classroom" class="section container">
        <div class="section-header">
            <div class="badge">Classroom</div>
            <h2 class="section-title">Tugas mingguan dari koordinator divisi.</h2>
            <p class="section-desc">Classroom dirancang sebagai ruang kerja digital untuk briefing, challenge, review, dan progress tracking anggota SCI-TOS.</p>
            <div class="section-actions">
                <a href="{{ route('classroom') }}" class="btn btn-secondary">Buka Classroom</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Login Sekarang</a>
            </div>
        </div>

        <div class="classroom-grid">
            <div class="workflow-stack">
                @foreach (data_get($classroom, 'steps', []) as $step)
                    <div class="cyber-card task-card">
                        <span class="journey-step">{{ $step['title'] }}</span>
                        <p style="margin-top: 10px;">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="task-stack">
                @foreach (array_slice(data_get($classroom, 'tasks', []), 0, 3) as $task)
                    <div class="cyber-card task-card">
                        <div class="task-head">
                            <div>
                                <h3>{{ $task['title'] }}</h3>
                                <p>{{ $task['summary'] }}</p>
                            </div>
                            <span class="task-status task-status-{{ \Illuminate\Support\Str::slug($task['status']) }}">{{ $task['status'] }}</span>
                        </div>
                        <div class="task-meta">
                            <span>{{ $task['division'] }}</span>
                            <span>{{ $task['deadline'] }}</span>
                            <span>{{ $task['format'] }}</span>
                        </div>
                        <p>Koordinator: {{ $task['coordinator'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="pengurus" class="section container">
        <div class="section-header">
            <div class="badge">Pengurus</div>
            <h2 class="section-title">Orang-orang yang menjaga sistem tetap bergerak.</h2>
            <p class="section-desc">Kepengurusan SCI-TOS dibentuk seperti jaringan kerja: pembina, executive lead, dan koordinator divisi bergerak saling terhubung.</p>
            <div class="section-actions">
                <a href="{{ route('pengurus') }}" class="btn btn-secondary">Lihat Family Tree</a>
            </div>
        </div>

        <div class="tree-cluster-grid">
            @include('scitos.partials.person-card', [
                'person' => data_get($board, 'advisor'),
                'showBio' => true,
                'cardClass' => 'tree-preview-card',
                'photoLabel' => 'Foto pembina belum ditambahkan.',
            ])

            @include('scitos.partials.person-card', [
                'person' => data_get($board, 'chair'),
                'showBio' => true,
                'cardClass' => 'tree-preview-card',
                'photoLabel' => 'Foto ketua umum belum ditambahkan.',
            ])

            @include('scitos.partials.person-card', [
                'person' => array_merge(data_get($divisions, '3.leaders.0', []), ['division' => data_get($divisions, '3.name')]),
                'showBio' => true,
                'showDivision' => true,
                'cardClass' => 'tree-preview-card',
                'special' => true,
                'photoLabel' => 'Foto koordinator programming & jaringan belum ditambahkan.',
            ])
        </div>

        <p class="terminal-note">{{ $coordinatorCount }} koordinator aktif membina divisi dan sub-unit SCI-TOS pada periode {{ data_get($board, 'period') }}.</p>
    </section>

    <section id="gabung" class="section container">
        <div class="cta-container">
            <h2>Siap memulai eksperimen pertamamu?</h2>
            <p>{{ data_get($registration, 'summary') }}</p>
            <a href="{{ route('gabung') }}" class="btn btn-primary" style="padding: 16px 32px; font-size: 1rem;">
                Detail Pendaftaran
            </a>
        </div>
    </section>
</main>
@endsection
