@extends('layouts.scitos')

@php
    $brand = data_get($scitos, 'brand');
@endphp

@section('content')
<main>
    <section class="section coming-shell container">
        <div class="cyber-card coming-card">
            <div class="coming-status">{{ $comingBadge }}</div>
            <h1 class="section-title" style="max-width: 720px; margin-inline: auto;">{{ $comingTitle }}</h1>
            <p>{{ $comingDescription }}</p>
            <div class="section-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                <a href="{{ data_get($brand, 'instagram') }}" target="_blank" rel="noreferrer" class="btn btn-secondary">Pantau Instagram</a>
            </div>
        </div>
    </section>
</main>
@endsection
