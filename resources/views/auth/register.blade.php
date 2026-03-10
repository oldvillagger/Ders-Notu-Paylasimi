@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="section-title" style="font-size: 1.8rem; margin-bottom: 2rem;">Kayıt Ol</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Ad Soyad</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Bölüm / Sınıf</label>
            <input type="text" name="course" class="form-input" placeholder="Örn: Bilgisayar Mühendisliği 2. Sınıf" value="{{ old('course') }}" required>
            @error('course') <div class="error">{{ $message }}</div> @enderror
            <p style="font-size:0.8rem; color:var(--color-gray); margin-top:4px;">Not akışınız bu sınıf bilgisine göre filtrelenecektir.</p>
        </div>
        <div class="form-group">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-input" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Şifre Tekrar</label>
            <input type="password" name="password_confirmation" class="form-input" required>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
            <a href="{{ route('login') }}" class="text-gold" style="text-decoration: none; font-size: 0.9rem; font-weight: 500;">Zaten üye misin?</a>
            <button class="btn btn-gold" type="submit">Kayıt Ol</button>
        </div>
    </form>
</div>
@endsection
