<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Webhook Store'))</title>
    @if(app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script src="{{ asset('build/assets/app.js') }}" type="module"></script>
    @endif
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('webhooks.index') }}">
                🔗 {{ __('Webhook Store') }}
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('webhooks.index') }}">{{ __('Dashboard') }}</a>
                <span class="navbar-text">
                    Endpoint: <code class="text-warning">/webhook</code>
                </span>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-0">
                        <strong>{{ __('Webhook Store') }}</strong> - {{ __('Development webhook capture system') }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">
                        {{ __('Developed with') }} <span class="text-danger">♥</span>
                        {{ __('by') }}
                        Leandro Ferreira
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
