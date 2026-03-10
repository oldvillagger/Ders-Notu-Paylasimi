<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NotHub | Öğrenci Not Paylaşım Ağı</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar">
            <a href="/" class="nav-brand">
                <span class="text-gold">✦</span> NotHub
            </a>
            <div class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-gold">Akışa Dön</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-gold">Giriş Yap</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-gold">Kayıt Ol</a>
                        @endif
                    @endauth
                @else
                    <!-- Fallback if auth routes not installed yet -->
                    <a href="/login" class="btn btn-outline-gold">Giriş Yap</a>
                    <a href="/register" class="btn btn-gold">Kayıt Ol</a>
                @endif
            </div>
        </nav>

        <section class="hero">
            <h1>Öğrenciler İçin Dijital Not Pazaryeri ve İletişim Merkezi</h1>
            <p>Ders notlarını paylaş, sat, veya sınıf arkadaşlarınla keşfet. Kendi çalışma grubunu kur ve başarıya birlikte ulaş.</p>
            <div class="hero-buttons">
                 @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-gold" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Hemen Katıl</a>
                 @else
                    <a href="/register" class="btn btn-gold" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Hemen Katıl</a>
                 @endif
                 <a href="#nasil-calisir" class="btn btn-outline-gold" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Keşfet</a>
            </div>
        </section>

        <section id="nasil-calisir" class="features">
            <h2 class="section-title">Neden NotHub?</h2>
            <div class="grid-3">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Sınıfa Özel Akış</h3>
                    <p>Sadece kendi bölümünün veya sınıfının notlarını Instagram tarzı dinamik bir akışta gör. İlgi çekici ders içeriklerini kaçırma.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💎</div>
                    <h3>Notlarını Sat & Kazan</h3>
                    <p>Özenle tuttuğun ders notlarını sadece ücretsiz paylaşmakla kalma, pazar yerinde satışa çıkararak bütçene katkı sağla.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Çalışma Grupları</h3>
                    <p>Kendi özel sunucunu oluştur, arkadaşlarını davet et. Sadece grubuna özel dosyalar paylaş ve birlikte çalış.</p>
                </div>
            </div>
        </section>
        
        <footer style="background: var(--color-black); color: var(--color-white); text-align: center; padding: 3rem 1rem;">
            <h3>NotHub Premium Öğrenci Ağı</h3>
            <p style="color: var(--color-gray); margin-top: 1rem;">© {{ date('Y') }} Tüm hakları saklıdır.</p>
        </footer>
    </body>
</html>
