<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NotHub | Öğrenci Ağı</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .auth-container { max-width: 450px; margin: 4rem auto; padding: 2.5rem; background: var(--color-white); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid var(--color-gray-light); }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--color-black); }
        .form-input { width: 100%; padding: 0.85rem; border: 1px solid var(--color-gray-light); border-radius: 8px; font-family: inherit; font-size: 1rem; transition: all 0.2s; }
        .form-input:focus { outline: none; border-color: var(--color-gold); box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1); }
        .error { color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; font-weight: 500; }
        .dashboard-container { max-width: 1200px; margin: 0 auto; padding: 3rem 5%; }
    </style>
</head>
<body class="bg-cream">
    <nav class="navbar">
        <a href="/" class="nav-brand">
            <span class="text-gold">✦</span> NotHub
        </a>
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="text-black" style="font-weight: 500; text-decoration: none;">Akış</a>
                <a href="{{ route('servers.index') }}" class="text-black" style="font-weight: 500; text-decoration: none;">Sunucular</a>
                <span class="text-gray" style="font-weight: 500; font-size: 0.95rem; margin-left: 1rem;">Hoş Geldin, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-gold" style="padding: 0.5rem 1.25rem; font-size: 0.9rem;">Çıkış</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-gold" style="padding: 0.5rem 1.25rem;">Giriş Yap</a>
                <a href="{{ route('register') }}" class="btn btn-gold" style="padding: 0.5rem 1.25rem;">Kayıt Ol</a>
            @endauth
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
