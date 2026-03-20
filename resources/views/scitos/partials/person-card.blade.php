@php
    $person = $person ?? [];
    $cardClass = $cardClass ?? '';
    $showBio = $showBio ?? false;
    $showDivision = $showDivision ?? false;
    $photoLabel = $photoLabel ?? 'Gambar belum ditambahkan.';
    $special = $special ?? data_get($person, 'special_card', false);
@endphp

<article class="cyber-card person-card {{ $cardClass }} {{ $special ? 'is-special' : '' }}">
    <div class="person-media">
        @if (data_get($person, 'photo'))
            <img src="{{ asset(data_get($person, 'photo')) }}" alt="{{ data_get($person, 'name') }}">
        @else
            <div class="profile-missing">{{ $photoLabel }}</div>
        @endif
    </div>

    <div class="person-body">
        @if (data_get($person, 'badge'))
            <span class="person-badge">{{ data_get($person, 'badge') }}</span>
        @endif

        <h3 class="person-name">{{ data_get($person, 'name') }}</h3>
        <p class="person-role">{{ data_get($person, 'role') }}</p>

        @if ($showDivision && data_get($person, 'division'))
            <p class="person-division">{{ data_get($person, 'division') }}</p>
        @endif

        @if ($showBio && data_get($person, 'bio'))
            <p class="person-bio">{{ data_get($person, 'bio') }}</p>
        @endif

        @include('scitos.partials.social-links', ['links' => data_get($person, 'socials', [])])
    </div>
</article>
