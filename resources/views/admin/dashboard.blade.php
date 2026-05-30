@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- TOPBAR --}}
    <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border:1px solid #c4c6cd;border-radius:12px;background:#ffffff;margin-bottom:1rem">
        <div>
            <h1 style="font-family:'Libre Caslon Text',serif;font-size:1.5rem;font-weight:700;color:#182b3f;margin-bottom:2px">Dashboard</h1>
            <div style="font-size:0.78rem;color:#888;letter-spacing:0.03em">{{ now()->format('d M Y') }}</div>
        </div>
        <span style="background:#bee6f9;color:#426878;font-size:0.72rem;font-weight:700;letter-spacing:0.04em;padding:4px 12px;border-radius:20px">Admin</span>
    </div>

    {{-- STAT CARDS --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem">
        @foreach([
            ['group',   'Total User',    $stats['users'],    '#182b3f', '#e8edf2', '#182b3f'],
            ['quiz',    'Total Quiz',    $stats['quizzes'],  '#3d6374', '#e3ecf0', '#3d6374'],
            ['article', 'Total Artikel', $stats['articles'], '#6a9aaf', '#deedf5', '#4a7d96'],
        ] as [$icon, $label, $val, $accent, $iconBg, $iconColor])
        <div style="background:#ffffff;border:1px solid #c4c6cd;border-radius:12px;padding:1.25rem 1.5rem;position:relative;overflow:hidden">
            <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $accent }};border-radius:12px 12px 0 0"></div>
            <div style="width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:{{ $iconBg }};margin-bottom:1rem">
                <span class="material-symbols-outlined" style="font-size:20px;color:{{ $iconColor }}">{{ $icon }}</span>
            </div>
            <div style="font-family:'Libre Caslon Text',serif;font-size:2rem;font-weight:700;color:#182b3f;line-height:1;margin-bottom:6px">{{ $val }}</div>
            <div style="font-size:0.78rem;color:#44474c;font-weight:600;letter-spacing:0.04em">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- QUICK ACTIONS --}}
    <div style="background:#ffffff;border:1px solid #c4c6cd;border-radius:12px;padding:1.25rem 1.5rem">
        <h3 style="font-family:'Libre Caslon Text',serif;color:#182b3f;margin-bottom:1.25rem;display:flex;align-items:center;gap:8px;font-size:1rem">
            <span class="material-symbols-outlined" style="font-size:18px;color:#182b3f">bolt</span>
            Quick Actions
        </h3>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap">
            <a href="{{ route('admin.quizzes.create') }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:0.55rem 1.2rem;border-radius:8px;background:#182b3f;color:white;font-family:'Hanken Grotesk',sans-serif;font-size:0.82rem;font-weight:700;letter-spacing:0.03em;text-decoration:none">
                <span class="material-symbols-outlined" style="font-size:16px">add_circle</span>
                Tambah Quiz
            </a>
            <a href="{{ route('admin.articles.create') }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:0.55rem 1.2rem;border-radius:8px;background:#3d6374;color:white;font-family:'Hanken Grotesk',sans-serif;font-size:0.82rem;font-weight:700;letter-spacing:0.03em;text-decoration:none">
                <span class="material-symbols-outlined" style="font-size:16px">post_add</span>
                Tambah Artikel
            </a>
        </div>
    </div>

@endsection