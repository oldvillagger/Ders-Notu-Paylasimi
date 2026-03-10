@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="section-title" style="font-size: 1.8rem; margin-bottom: 2rem;">Giriş Yap</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-input" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" style="font-size: 0.9rem; color: var(--color-gray);">Beni Hatırla</label>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
            <a href="{{ route('register') }}" class="text-gold" style="text-decoration: none; font-size: 0.9rem; font-weight: 500;">Hesabın yok mu? Kayıt Ol</a>
            <button class="btn btn-gold" type="submit">Giriş Yap</button>
        </div>
    </form>
</div>
@endsection
