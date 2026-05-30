<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Cerdas Karir')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        :root {
            --navy:  #2F4156;
            --teal:  #567C8D;
            --sky:   #C8D9E6;
            --beige: #F5EFEB;
            --white: #FFFFFF;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4f8;
            color: #1a2a35;
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px;
            background: var(--navy);
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 50;
        }
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 0.5rem;
        }
        .sidebar-brand .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            display: block;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.72rem;
            opacity: 0.5;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-top: 0.2rem;
            display: block;
        }
        .sidebar-menu { padding: 0.5rem 0; flex: 1; }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.7rem 1.5rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.07);
            color: white;
            border-left-color: var(--sky);
        }
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--sky);
        }

        /* ── MAIN ── */
        .admin-main {
            margin-left: 240px;
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
        }
        .topbar h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--navy);
        }

        /* ── CARD ── */
        .card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        /* ── TABLE ── */
        table { width:100%; border-collapse:collapse; }
        th, td { padding:0.8rem 1rem; text-align:left; font-size:0.88rem; border-bottom:1px solid #f0f0f0; }
        th { font-weight:700; color:var(--teal); text-transform:uppercase; font-size:0.72rem; letter-spacing:0.06em; background:#fafafa; }
        tbody tr:hover { background:#fafafa; }
        tbody tr:last-child td { border-bottom:none; }

        /* ── BADGES ── */
        .badge { padding:0.2rem 0.7rem; border-radius:20px; font-size:0.75rem; font-weight:600; display:inline-block; }
        .badge-green { background:#d4edda; color:#155724; }
        .badge-gray  { background:#e9ecef; color:#495057; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-block;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all 0.2s;
            line-height: 1;
        }
        .btn-primary { background:var(--navy); color:white; }
        .btn-primary:hover { background:var(--teal); color:white; }
        .btn-teal { background:var(--teal); color:white; }
        .btn-teal:hover { background:var(--navy); color:white; }
        .btn-outline { background:white; color:var(--navy); border:1.5px solid #ddd; }
        .btn-outline:hover { border-color:var(--navy); }
        .btn-danger { background:#e74c3c; color:white; }
        .btn-danger:hover { background:#c0392b; }

        .btn-sm { padding:0.35rem 0.8rem; font-size:0.78rem; border-radius:6px; border:none; cursor:pointer; font-weight:600; font-family:'DM Sans',sans-serif; text-decoration:none; display:inline-block; transition:all 0.2s; }
        .btn-sm.btn-primary { background:var(--navy);color:white; }
        .btn-sm.btn-teal    { background:var(--teal);color:white; }
        .btn-sm.btn-danger  { background:#e74c3c;color:white; }

        /* ── ALERT ── */
        .alert-global { padding:0.8rem 1.2rem; border-radius:10px; margin-bottom:1.2rem; font-size:0.88rem; }
        .alert-global.success { background:#d4edda; color:#155724; }
        .alert-global.error   { background:#f8d7da; color:#721c24; }

        /* ── FORMS (admin global) ── */
        .form-control {
            width:100%; padding:0.7rem 1rem;
            border:1.5px solid #ddd; border-radius:8px;
            font-size:0.9rem; font-family:'DM Sans',sans-serif;
            transition:border-color 0.2s; background:white;
        }
        .form-control:focus { outline:none; border-color:var(--teal); }
        .form-label { display:block; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#888; margin-bottom:0.4rem; }
        .form-group { margin-bottom:1.1rem; }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-name">Cerdas Karir</span>
        <span class="brand-sub">Admin Panel</span>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.quizzes.index') }}"
           class="{{ request()->routeIs('admin.quizzes*') ? 'active' : '' }}">
            Kelola Quiz
        </a>
        <a href="{{ route('admin.articles.index') }}"
           class="{{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
            Kelola Artikel
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            Kelola User
        </a>
        <a href="{{ route('home') }}" target="_blank">
            Lihat Website
        </a>
    </div>
</nav>

<!-- MAIN -->
<main class="admin-main">
    @if(session('success'))
        <div class="alert-global success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-global error">⚠️ {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

@stack('scripts')
</body>
</html>