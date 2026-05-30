@extends('layouts.app')

@section('title', 'Keamanan - Cerdas Karir')

@push('styles')
<style>
    .security-container { max-width: 1000px; margin: 3rem auto; padding: 0 2rem; display: grid; grid-template-columns: 240px 1fr; gap: 2rem; }
    .profile-sidebar { background: white; border-radius: 16px; padding: 2rem; text-align: center; height: fit-content; }
    .avatar-img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--sky); }
    .profile-name { font-size: 1.2rem; color: var(--navy); margin-bottom: 0.2rem; }
    .profile-pos { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--teal); font-weight: 600; margin-bottom: 0.3rem; }
    .profile-email { font-size: 0.82rem; color: var(--muted); margin-bottom: 1.5rem; }
    .profile-nav { text-align: left; }
    .profile-nav a { display: flex; align-items: center; gap: 0.7rem; padding: 0.7rem 0.8rem; border-radius: 8px; font-size: 0.9rem; color: var(--muted); text-decoration: none; transition: all 0.2s; margin-bottom: 0.3rem; }
    .profile-nav a:hover, .profile-nav a.active { background: var(--beige); color: var(--navy); font-weight: 500; }
    .profile-nav a .material-symbols-outlined { font-size: 18px; }
    .security-main { background: white; border-radius: 16px; padding: 2.5rem; }
    .security-main h2 { font-size: 1.6rem; color: var(--navy); margin-bottom: 0.3rem; }
    .security-main .subtitle { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }
    .security-card { background: var(--beige); border-radius: 12px; padding: 1.8rem; margin-bottom: 1.5rem; }
    .security-card h3 { font-size: 1rem; color: var(--navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; font-family: 'Libre Caslon Text', serif; }
    .security-card h3 .material-symbols-outlined { font-size: 18px; color: var(--teal); }
    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 0.4rem; }
    .form-group input { width: 100%; padding: 0.75rem 1rem; border: 1.5px solid var(--sky); border-radius: 8px; font-size: 0.9rem; font-family: 'Hanken Grotesk', sans-serif; transition: border-color 0.2s; background: white; }
    .form-group input:focus { outline: none; border-color: var(--teal); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .security-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; }
</style>
@endpush

@section('content')
<div class="security-container">

    <div class="profile-sidebar">
        <div style="position:relative;width:100px;margin:0 auto 1rem">
            <img class="avatar-img"
                src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=2F4156&color=fff&size=100' }}"
                alt="{{ auth()->user()->name }}">
        </div>
        <h3 class="profile-name">{{ auth()->user()->name }}</h3>
        <div class="profile-pos">{{ auth()->user()->current_position ?? 'User' }}</div>
        <div class="profile-email">{{ auth()->user()->email }}</div>
        <nav class="profile-nav">
            <a href="{{ route('profile.index') }}">
                <span class="material-symbols-outlined">person</span> Informasi Pribadi
            </a>
            <a href="{{ route('profile.security') }}" class="active">
                <span class="material-symbols-outlined">lock</span> Keamanan
            </a>
        </nav>
    </div>

    <div class="security-main">
        <h2>Pengaturan Keamanan</h2>
        <p class="subtitle">Kelola kata sandi dan autentikasi untuk melindungi akun Anda.</p>

        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:0.7rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.85rem;">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div style="background:#f8d7da;color:#721c24;padding:0.7rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.85rem;">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update-password') }}">
            @csrf @method('PUT')

            <div class="security-card">
                <h3>
                    <span class="material-symbols-outlined">key</span>
                    Ganti Password
                </h3>
                <div class="form-group">
                    <label>Password Saat Ini</label>
                    <input type="password" name="current_password" placeholder="••••••••" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" placeholder="Min. 8 karakter" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required>
                    </div>
                </div>
            </div>

            {{-- tombol di luar card krem, di dalam card putih --}}
            <div class="security-actions">
                <button type="button" onclick="window.location.reload()" class="btn btn-outline">Batalkan Perubahan</button>
                <button type="submit" class="btn btn-primary">Perbarui Keamanan</button>
            </div>

        </form>
    </div>

</div>
@endsection