@extends('layouts.scitos')

@php
    $divisionGroups = data_get($scitos, 'division_groups', []);
    $divisions = collect(data_get($scitos, 'divisions', []));
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">Divisi SCI-TOS</div>
        <h1 class="hero-title">Ikon divisi sebagai pintu masuk ke karakter, skill, dan mentor masing-masing.</h1>
        <p class="hero-desc">
            Halaman ini dirancang sebagai map interaktif SCI-TOS. Setiap card divisi bisa dibuka untuk melihat detail fokus belajar, output utama, dan koordinator yang membimbing.
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ $divisions->count() }}</strong>
                <span>Divisi utama</span>
            </div>
            <div class="cyber-card">
                <strong>Popup Detail</strong>
                <span>Setiap card bisa diklik untuk melihat penjelasan lengkap</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $divisions->sum(fn ($division) => count($division['leaders'] ?? [])) }}</strong>
                <span>Koordinator dan sub koordinator aktif</span>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="split-grid">
            @foreach ($divisionGroups as $group)
                <div class="cyber-card info-box">
                    <strong>{{ $group['name'] }}</strong>
                    <p>{{ $group['description'] }}</p>
                    <ul style="margin-top: 16px;">
                        @foreach ($group['items'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>

    @foreach ($divisionGroups as $group)
        @php
            $groupItems = $divisions->where('group', $group['name'])->values();
        @endphp

        <section class="section container">
            <div class="section-header">
                <div class="badge">{{ $group['name'] }}</div>
                <h2 class="section-title">{{ $group['name'] === 'Science Core' ? 'Rumpun Sains' : 'Rumpun Teknologi' }}</h2>
                <p class="section-desc">{{ $group['description'] }}</p>
            </div>

            <div class="division-icon-grid">
                @foreach ($groupItems as $division)
                    <button
                        type="button"
                        class="cyber-card division-icon-card"
                        data-modal-target="division-modal-{{ $division['slug'] }}"
                    >
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
                        <span class="division-card-hint">Klik untuk detail</span>
                    </button>
                @endforeach
            </div>
        </section>
    @endforeach

    @foreach ($divisions as $division)
        <div class="modal-shell" id="division-modal-{{ $division['slug'] }}" aria-hidden="true">
            <div class="cyber-card modal-card">
                <button type="button" class="modal-close" data-modal-close aria-label="Tutup detail divisi">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>

                <div class="modal-head">
                    <div class="division-icon-frame">
                        <img src="{{ asset($division['icon']) }}" alt="{{ $division['name'] }}">
                    </div>
                    <div>
                        <div class="badge" style="margin-bottom: 12px;">{{ $division['group'] }}</div>
                        <h2 class="section-title" style="font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 0;">{{ $division['name'] }}</h2>
                        <p>{{ $division['description'] }}</p>
                    </div>
                </div>

                <div class="modal-content-grid">
                    <div class="leaders-grid">
                        <div class="cyber-card modal-panel">
                            <h3>Fokus Divisi</h3>
                            <p>{{ $division['focus'] }}</p>
                        </div>

                        <div class="cyber-card modal-panel">
                            <h3>Aktivitas Utama</h3>
                            <ul class="modal-list">
                                @foreach ($division['activities'] as $activity)
                                    <li>{{ $activity }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="cyber-card modal-panel">
                            <h3>Output yang Ditargetkan</h3>
                            <ul class="modal-list">
                                @foreach ($division['outputs'] as $output)
                                    <li>{{ $output }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="leaders-grid">
                        <div class="cyber-card modal-panel">
                            <h3>{{ count($division['leaders']) > 1 ? 'Tim Koordinator' : 'Koordinator Divisi' }}</h3>
                            <p style="margin-bottom: 18px;">
                                {{ count($division['leaders']) > 1
                                    ? 'Divisi ini dikelola oleh beberapa koordinator. Jika foto belum tersedia, card akan menampilkan notifikasi bahwa gambar belum ditambahkan.'
                                    : 'Profil koordinator ditampilkan tanpa background. Jika foto belum tersedia, card akan memberi pemberitahuan yang rapi.' }}
                            </p>

                            <div class="leaders-grid">
                                @foreach ($division['leaders'] as $leader)
                                    @include('scitos.partials.person-card', [
                                        'person' => array_merge($leader, ['division' => $division['name']]),
                                        'showBio' => true,
                                        'showDivision' => true,
                                        'special' => data_get($leader, 'special_card', false),
                                        'photoLabel' => 'Gambar koordinator belum ditambahkan.',
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const modals = document.querySelectorAll('.modal-shell');

        const closeModal = (modal) => {
            if (!modal) {
                return;
            }

            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            body.classList.remove('modal-open');
        };

        const openModal = (modalId) => {
            const modal = document.getElementById(modalId);

            if (!modal) {
                return;
            }

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            body.classList.add('modal-open');
        };

        document.querySelectorAll('[data-modal-target]').forEach((button) => {
            button.addEventListener('click', () => openModal(button.dataset.modalTarget));
        });

        document.querySelectorAll('[data-modal-close]').forEach((button) => {
            button.addEventListener('click', () => closeModal(button.closest('.modal-shell')));
        });

        modals.forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal-shell.is-open').forEach((modal) => closeModal(modal));
            }
        });
    });
</script>
@endpush
