@extends('layouts.scitos')

@php
    $galleryItems = collect(data_get($scitos, 'gallery.items', []));
@endphp

@section('content')
<main>
    <section class="hero page-hero container">
        <div class="badge">SCI-TOS Gallery</div>
        <h1 class="hero-title">Etalase karya anggota SCI-TOS dalam format foto dan video.</h1>
        <p class="hero-desc">
            {{ data_get($scitos, 'gallery.summary') }}
        </p>
        <div class="page-meta">
            <div class="cyber-card">
                <strong>{{ $galleryItems->count() }}</strong>
                <span>Item gallery</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $galleryItems->where('type', 'Video')->count() }}</strong>
                <span>Highlight video</span>
            </div>
            <div class="cyber-card">
                <strong>{{ $galleryItems->where('type', 'Foto')->count() }}</strong>
                <span>Visual statis dan poster</span>
            </div>
        </div>
    </section>

    <section class="section container">
        <div class="gallery-feature">
            @foreach ($galleryItems->take(2) as $item)
                <article class="cyber-card gallery-card {{ $item['type'] === 'Video' ? 'is-video' : '' }}">
                    <div class="gallery-media" style="height: 320px;">
                        <img src="{{ asset($item['media']) }}" alt="{{ $item['title'] }}">
                    </div>
                    <div class="gallery-meta">
                        <span>{{ $item['type'] }}</span>
                        <span>{{ $item['category'] }}</span>
                        <span>{{ $item['year'] }}</span>
                    </div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <p style="margin-top: 12px;">{{ $item['creator'] }} • {{ $item['division'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section container">
        <div class="section-header">
            <div class="badge">Koleksi Lengkap</div>
            <h2 class="section-title">Seluruh karya yang sudah ditampilkan saat ini.</h2>
            <p class="section-desc">Format foto dan video ditampilkan dalam satu sistem visual yang sama agar karya anggota terasa terkurasi dan mudah dibaca.</p>
        </div>

        <div class="gallery-grid">
            @foreach ($galleryItems as $item)
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
                    <p style="margin-top: 12px;">{{ $item['creator'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
</main>
@endsection
