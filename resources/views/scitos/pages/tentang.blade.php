@extends('layouts.scitos')

@php
    $brand = data_get($scitos, 'brand');
    $history = data_get($scitos, 'history', []);
    $emblems = data_get($scitos, 'emblems', []);
    $quickFacts = data_get($scitos, 'quick_facts', []);
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">Tentang SCI-TOS</div>
        <h1 class="hero-title">Satu ekosistem yang mempertemukan sains dan teknologi.</h1>
        <p class="hero-desc">
            SCI-TOS lahir dari penyatuan KIR BIMAFIKI dan APLIKASI 4 untuk membangun ruang belajar yang menampung rasa ingin tahu, eksperimen, dan karya digital dalam satu wadah.
        </p>
        <div class="page-meta">
            @foreach ($quickFacts as $fact)
                <div class="cyber-card">
                    <strong>{{ $fact['value'] }}</strong>
                    <span>{{ $fact['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section container">
        <div class="bento-grid">
            <div class="cyber-card bento-wide">
                <p style="font-size: 1.12rem; color: var(--text-primary); margin-bottom: 24px; font-weight: 500;">
                    SCI-TOS bukan sekadar nama ekskul. Ia adalah ruang pertemuan antara riset ilmiah, kreativitas, dan keterampilan teknologi yang tumbuh bersama dalam kultur sekolah.
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
                    <h3 style="margin-bottom: 8px;">Identitas Resmi</h3>
                    <p style="font-size: 0.95rem; color: var(--text-muted);">
                        Berdiri resmi pada 24 Agustus 2019 dan berlokasi di {{ data_get($brand, 'location') }}, SCI-TOS menjadi titik temu eksplorasi akademik dan teknologi di SMAN 4 Bekasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="section-header">
            <div class="badge">Makna Lambang</div>
            <h2 class="section-title">Simbol yang membawa karakter SCI-TOS.</h2>
            <p class="section-desc">Setiap elemen pada lambang menyimpan identitas, sejarah, dan semangat organisasi.</p>
        </div>

        <div class="bento-grid">
            @foreach ($emblems as $item)
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
</main>
@endsection
