@php
    $links = $links ?? [];
    $class = $class ?? '';
    $icons = [
        'instagram' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect><circle cx="12" cy="12" r="4.3"></circle><circle cx="18" cy="6" r="1"></circle></svg>',
        'tiktok' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M15.5 3c.43 2.07 1.66 3.47 3.5 4.13V9.9a8.58 8.58 0 0 1-3.44-.83v5.47A5.55 5.55 0 1 1 10 9v2.84a2.73 2.73 0 1 0 2.74 2.7V3h2.76Z"></path></svg>',
        'youtube' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.58 7.19a2.96 2.96 0 0 0-2.08-2.1C17.66 4.6 12 4.6 12 4.6s-5.66 0-7.5.49a2.96 2.96 0 0 0-2.08 2.1A31.3 31.3 0 0 0 2 12a31.3 31.3 0 0 0 .42 4.81 2.96 2.96 0 0 0 2.08 2.1c1.84.49 7.5.49 7.5.49s5.66 0 7.5-.49a2.96 2.96 0 0 0 2.08-2.1A31.3 31.3 0 0 0 22 12a31.3 31.3 0 0 0-.42-4.81ZM10 15.5v-7l6 3.5-6 3.5Z"></path></svg>',
        'github' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 .7a12 12 0 0 0-3.8 23.4c.6.12.82-.26.82-.58v-2.03c-3.34.73-4.04-1.42-4.04-1.42-.55-1.39-1.34-1.76-1.34-1.76-1.09-.76.08-.75.08-.75 1.21.08 1.85 1.24 1.85 1.24 1.07 1.84 2.8 1.3 3.48 1 .1-.78.42-1.3.76-1.6-2.67-.3-5.47-1.34-5.47-5.97 0-1.32.47-2.41 1.24-3.27-.12-.3-.54-1.54.12-3.22 0 0 1-.32 3.3 1.25a11.43 11.43 0 0 1 6 0c2.3-1.57 3.3-1.25 3.3-1.25.66 1.68.24 2.92.12 3.22.77.86 1.24 1.95 1.24 3.27 0 4.64-2.8 5.67-5.48 5.97.43.37.82 1.1.82 2.21v3.28c0 .32.22.7.82.58A12 12 0 0 0 12 .7Z"></path></svg>',
        'linkedin' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.94 8.5H3.56V20h3.38V8.5Zm.22-3.53c0-1.07-.8-1.97-1.91-1.97-1.1 0-1.91.9-1.91 1.97 0 1.06.8 1.96 1.88 1.96h.03c1.13 0 1.91-.9 1.91-1.96ZM20 13.04C20 9.68 18.2 8.1 15.8 8.1c-1.93 0-2.8 1.06-3.29 1.8V8.5H9.13c.05.92 0 11.5 0 11.5h3.38v-6.42c0-.34.03-.68.13-.92.27-.68.88-1.38 1.92-1.38 1.36 0 1.9 1.04 1.9 2.56V20H20v-6.96Z"></path></svg>',
    ];
    $labels = [
        'instagram' => 'Instagram',
        'tiktok' => 'TikTok',
        'youtube' => 'YouTube',
        'github' => 'GitHub',
        'linkedin' => 'LinkedIn',
    ];
@endphp

<div class="social-links {{ $class }}">
    @foreach ($links as $platform => $url)
        @php
            $isDisabled = blank($url) || $url === '#';
        @endphp

        @if ($isDisabled)
            <span class="social-link is-disabled" title="{{ $labels[$platform] }} belum ditautkan" aria-hidden="true">
                {!! $icons[$platform] ?? '' !!}
            </span>
        @else
            <a href="{{ $url }}" target="_blank" rel="noreferrer" class="social-link" aria-label="{{ $labels[$platform] }}">
                {!! $icons[$platform] ?? '' !!}
            </a>
        @endif
    @endforeach
</div>
