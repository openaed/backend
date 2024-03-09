<nav class="navbar sticky-top navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ config('app.url') }}">
            <img src="{{ asset('images/logos/openaed.png') }}" alt="Logo" class="d-inline-block align-text-top"
                height="50vh">&nbsp;<span class="ms-2 fs-4">{{ config('app.name') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav ms-auto">
                <a class="nav-link @if (Route::is('aedinfo')) active @endif" href="{{ route('aedinfo') }}">Wat is
                    een AED?</a>
                <a class="nav-link @if (Route::is('docs')) active @endif" href="{{ route('docs') }}">API
                    documentatie</a>
                <a class="nav-link @if (Route::is('statistics')) active @endif"
                    href="{{ route('statistics') }}">Statistieken</a>
                <a class="nav-link @if (Route::is('contact')) active @endif"
                    href="{{ route('contact') }}">Contact</a>
                <a target="_blank" href="https://github.com/openaed/backend" class="nav-link"><i
                        class="bi bi-github"></i></a>
            </div>
        </div>
    </div>
</nav>
