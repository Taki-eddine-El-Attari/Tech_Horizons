<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre }}</title>
    <link rel="icon" href="{{ asset('/images/logos/logo.png') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/auth.css'])
</head>
<body>
    <div class="container">
        <div class="login-wrap">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h3>{{ $titreAuth }}</h3>
            <form action="{{ $action }}" class="login-form" method="POST" novalidate>
                @csrf
                {{ $slot }}
                <div class="form-group">
                    <button type="submit" class="btn-primary">{{ $submitMessage }}</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
