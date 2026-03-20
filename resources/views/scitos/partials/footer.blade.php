@php
    $brand = data_get($scitos, 'brand');
    $socials = data_get($scitos, 'socials', []);
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>
                    <img src="{{ asset(data_get($brand, 'logo')) }}" alt="Logo">
                    {{ data_get($brand, 'name') }}
                </h3>
                <p>{{ data_get($brand, 'subtitle') }}. Wadah riset, sains, kreasi digital, dan classroom berbasis divisi bagi para siswa.</p>
            </div>

            <div>
                <h4 class="footer-title">Navigasi</h4>
                <div class="footer-links">
                    <a href="{{ route('tentang') }}">Tentang Kami</a>
                    <a href="{{ route('prestasi') }}">Prestasi</a>
                    <a href="{{ route('divisi') }}">Divisi</a>
                    <a href="{{ route('pengurus') }}">Pengurus</a>
                    <a href="{{ route('gallery') }}">SCI-TOS Gallery</a>
                    <a href="{{ route('classroom') }}">Classroom</a>
                    <a href="{{ route('gabung') }}">Gabung</a>
                </div>
            </div>

            <div>
                <h4 class="footer-title">Sosial Media</h4>
                <div class="footer-links">
                    @foreach ($socials as $social)
                        <a href="{{ $social['url'] }}" @if ($social['url'] !== '#') target="_blank" rel="noreferrer" @endif>{{ $social['label'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Ekstrakurikuler {{ data_get($brand, 'name') }} SMAN 4 Bekasi. All rights reserved.</p>
        </div>
    </div>
</footer>
