@extends('layouts.auth')

@section('title', 'Daftar - Cerdas Karir')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
@endpush

@section('content')
<div class="auth-left">
    <div class="auth-left-content">
        <div class="auth-brand">Cerdas Karir</div>
        <h2>Mulai Perjalanan Profesionalmu</h2>
        <p>Bergabunglah dengan ribuan profesional yang telah menemukan jalur karir ideal mereka melalui data intelligence dan bimbingan terstruktur.</p>
        <div class="auth-feature">
            <div class="auth-feature-icon"><span class="material-symbols-outlined">my_location</span></div>
            <div class="auth-feature-text">
                <strong>Career Quiz Berbasis AI</strong>
                <span>Temukan kekuatan terpendammu dengan analisis mendalam.</span>
            </div>
        </div>
        <div class="auth-feature">
            <div class="auth-feature-icon"><span class="material-symbols-outlined">map</span></div>
            <div class="auth-feature-text">
                <strong>Roadmap Karir Personal</strong>
                <span>Langkah demi langkah menuju posisi impianmu.</span>
            </div>
        </div>
        <div class="auth-feature">
            <div class="auth-feature-icon"><span class="material-symbols-outlined">article</span></div>
            <div class="auth-feature-text">
                <strong>Akses Eksklusif Artikel</strong>
                <span>Wawasan terbaru dari pakar industri setiap minggu.</span>
            </div>
        </div>
    </div>
</div>

<div class="auth-right">
    <div class="auth-form-box">
        <h1>Buat Akun Baru</h1>
        <p class="subtitle">Lengkapi data di bawah untuk memulai.</p>

        @if($errors->any())
            <div style="background:#f8d7da;color:#721c24;padding:0.8rem;border-radius:8px;margin-bottom:1rem;font-size:0.85rem;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min. 8 karakter" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a>.</label>
            </div>
            <button type="submit" class="btn-auth">BUAT AKUN SEKARANG</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection