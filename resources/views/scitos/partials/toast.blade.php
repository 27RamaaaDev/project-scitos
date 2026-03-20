@if (session('status'))
    <div class="toast-stack" aria-live="polite" aria-atomic="true">
        <div class="session-toast" data-session-toast>
            <div class="session-toast-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6 9 17l-5-5"></path>
                </svg>
            </div>
            <div class="session-toast-body">
                <strong>SCI-TOS</strong>
                <p>{{ session('status') }}</p>
            </div>
        </div>
    </div>
@endif
