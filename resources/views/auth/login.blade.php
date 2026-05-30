@extends('layouts.auth')

@section('title', 'Masuk - Cerdas Karir')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
@endpush

@section('content')
<div class="auth-left">
    <div class="auth-left-content">
        <div class="auth-brand">Cerdas Karir</div>
        <h2>Mulai Perjalanan Profesionalmu</h2>
        <p>Masuk untuk akses roadmap karir pribadimu dan temukan peluang yang sesuai dengan keahlian unikmu.</p>
        <div class="auth-feature">
            <div class="auth-feature-icon"><span class="material-symbols-outlined">my_location</span></div>
            <div class="auth-feature-text">
                <strong>Personalized AI Roadmap</strong>
                <span>Temukan jalur karir yang dirancang khusus untuk Anda.</span>
            </div>
        </div>
        <div class="auth-feature">
            <div class="auth-feature-icon"><span class="material-symbols-outlined">trending_up</span></div>
            <div class="auth-feature-text">
                <strong>Analisis Tren Pasar</strong>
                <span>Wawasan real-time tentang kebutuhan industri masa kini.</span>
            </div>
        </div>
    </div>
</div>

<div class="auth-right">
    <div class="auth-form-box">
        <h1>Selamat datang kembali</h1>
        <p class="subtitle">Masuk ke akunmu untuk melanjutkan.</p>

        @if($errors->any())
            <div style="background:#f8d7da;color:#721c24;padding:0.8rem;border-radius:8px;margin-bottom:1rem;font-size:0.85rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            <div class="form-group">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <label>Password</label>
                    <a href="#" style="font-size:0.8rem;color:var(--teal);text-decoration:none;">Lupa password?</a>
                </div>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya di perangkat ini</label>
            </div>
            <button type="submit" class="btn-auth">MASUK SEKARANG</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</div>
@endsection