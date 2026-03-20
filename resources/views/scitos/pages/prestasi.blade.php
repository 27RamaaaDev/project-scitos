@extends('layouts.scitos')

@php
    $achievements = data_get($scitos, 'achievements', []);
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">Prestasi SCI-TOS</div>
        <h1 class="hero-title">Jejak karya, kompetisi, dan pencapaian yang terus bertambah.</h1>
        <p class="hero-desc">
            Halaman ini merangkum pencapaian SCI-TOS dari lomba akademik, riset, kreativitas visual, hingga kompetisi tingkat sekolah dan nasional.
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ count($achievements) }}</strong>
                <span>Total pencapaian tercatat</span>
            </div>
            <div class="cyber-card">
                <strong>Multi-bidang</strong>
                <span>Sains, media, debat, desain, dan olimpiade</span>
            </div>
            <div class="cyber-card">
                <strong>Berjenjang</strong>
                <span>Tingkat sekolah, kota, hingga nasional</span>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="terminal-window">
            <div class="terminal-header">
                <div class="terminal-dots">
                    <span></span><span></span><span></span>
                </div>
                <div class="terminal-title">~/sci-tos/prestasi_full_log.sh</div>
            </div>
            <div>
                @foreach ($achievements as $index => $achievement)
                    <div class="achievement-row">
                        <div class="a-index">{{ sprintf('%02d', $index + 1) }}</div>
                        <div class="a-text">{{ $achievement }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <p class="terminal-note">Setiap pencapaian menunjukkan konsistensi anggota SCI-TOS dalam belajar, berlatih, dan tampil di ruang kompetisi yang berbeda.</p>
    </section>
</main>
@endsection
