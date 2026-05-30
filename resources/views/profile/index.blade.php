@extends('layouts.app')

@section('title', 'Profil Saya - Cerdas Karir')

@push('styles')
<style>
    .profile-container { max-width: 1000px; margin: 3rem auto; padding: 0 2rem; display: grid; grid-template-columns: 240px 1fr; gap: 2rem; }
    .profile-sidebar { background: white; border-radius: 16px; padding: 2rem; text-align: center; height: fit-content; }
    .avatar-wrap { position: relative; width: 100px; margin: 0 auto 1rem; }
    .avatar-img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--sky); }
    .avatar-edit { position: absolute; bottom: 0; right: 0; width: 28px; height: 28px; background: var(--navy); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.8rem; cursor: pointer; }
    .profile-name { font-size: 1.2rem; color: var(--navy); margin-bottom: 0.2rem; }
    .profile-pos { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--teal); font-weight: 600; margin-bottom: 0.3rem; }
    .profile-email { font-size: 0.82rem; color: var(--muted); margin-bottom: 1.5rem; }
    .profile-nav { text-align: left; }
    .profile-nav a { display: flex; align-items: center; gap: 0.7rem; padding: 0.7rem 0.8rem; border-radius: 8px; font-size: 0.9rem; color: var(--muted); text-decoration: none; transition: all 0.2s; margin-bottom: 0.3rem; }
    .profile-nav a:hover, .profile-nav a.active { background: var(--beige); color: var(--navy); font-weight: 500; }
    .profile-nav a .material-symbols-outlined { font-size: 18px; }
    .profile-main { background: white; border-radius: 16px; padding: 2.5rem; }
    .profile-main h2 { font-size: 1.6rem; color: var(--navy); margin-bottom: 0.3rem; }
    .profile-main .subtitle { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }
    .form-group label { display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 0.4rem; }
    .form-group input, .form-group textarea {
        width: 100%; padding: 0.75rem 1rem; border: 1.5px solid var(--sky); border-radius: 8px;
        font-size: 0.9rem; font-family: 'Hanken Grotesk', sans-serif; transition: border-color 0.2s;
        background: var(--beige);
    }
    .form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--teal); background: white; }
    .form-group textarea { height: 120px; resize: vertical; }
    .profile-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; }
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-sidebar">
        <div class="avatar-wrap">
            <img class="avatar-img"
                src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2F4156&color=fff&size=100' }}"
                alt="{{ $user->name }}">
            <label for="avatar-upload" class="avatar-edit">
                <span class="material-symbols-outlined" style="font-size:14px">edit</span>
            </label>
        </div>
        <h3 class="profile-name">{{ $user->name }}</h3>
        <div class="profile-pos">{{ $user->current_position ?? 'User' }}</div>
        <div class="profile-email">{{ $user->email }}</div>
        <nav class="profile-nav">
            <a href="{{ route('profile.index') }}" class="active">
                <span class="material-symbols-outlined">person</span> Informasi Pribadi
            </a>
            <a href="{{ route('profile.security') }}">
                <span class="material-symbols-outlined">lock</span> Keamanan
            </a>
        </nav>
    </div>

    <div class="profile-main">
        <h2>Informasi Pribadi</h2>
        <p class="subtitle">Perbarui profil Anda untuk meningkatkan visibilitas karir Anda.</p>

        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:0.7rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.85rem;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="file" id="avatar-upload" name="avatar" style="display:none" accept="image/*">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ $user->email }}" disabled style="opacity:0.6">
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+62 812 ...">
                </div>
                <div class="form-group">
                    <label>Jabatan Saat Ini</label>
                    <input type="text" name="current_position" value="{{ old('current_position', $user->current_position) }}" placeholder="e.g. Senior Developer">
                </div>
            </div>
            <div class="form-group">
                <label>Biografi Singkat</label>
                <textarea name="bio" placeholder="Ceritakan tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
            </div>
            <div class="profile-actions">
                <button type="button" onclick="window.location.reload()" class="btn btn-outline">Batalkan Perubahan</button>
                <button type="submit" class="btn btn-primary">Simpan Profil</button>
            </div>
        </form>
    </div>
</div>
@endsection