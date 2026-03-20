@extends('layouts.scitos')

@php
    $registration = data_get($scitos, 'registration', []);
    $brand = data_get($scitos, 'brand');
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">Gabung SCI-TOS</div>
        <h1 class="hero-title">Masuk ke ruang yang penuh eksperimen, ide, dan karya nyata.</h1>
        <p class="hero-desc">
            Pendaftaran biasanya dibuka saat awal semester ganjil. Halaman ini merangkum waktu, lokasi, dan langkah terbaik untuk mengenal SCI-TOS lebih dekat.
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ data_get($registration, 'period') }}</strong>
                <span>Periode pendaftaran</span>
            </div>
            <div class="cyber-card">
                <strong>{{ data_get($registration, 'moment') }}</strong>
                <span>Momen pembukaan</span>
            </div>
            <div class="cyber-card">
                <strong>{{ data_get($registration, 'location') }}</strong>
                <span>Lokasi utama</span>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="split-grid">
            <div class="info-stack">
                <div class="cyber-card info-box">
                    <strong>Ringkasan pendaftaran</strong>
                    <p>{{ data_get($registration, 'summary') }}</p>
                </div>
                <div class="cyber-card info-box">
                    <strong>Langkah awal</strong>
                    <ul>
                        @foreach (data_get($registration, 'steps', []) as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="cta-container" style="max-width: none; width: 100%;">
                <h2>Siap jadi bagian dari SCI-TOS?</h2>
                <p>Ikuti kanal resmi untuk mendapatkan pembaruan pembukaan pendaftaran, pengenalan divisi, dan agenda ekskul berikutnya.</p>
                <a href="{{ data_get($brand, 'instagram') }}" target="_blank" rel="noreferrer" class="btn btn-primary" style="padding: 16px 32px; font-size: 1rem;">
                    {{ data_get($registration, 'cta_label') }}
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
