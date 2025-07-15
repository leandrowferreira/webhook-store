<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Webhook Store'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</body>
</html>
