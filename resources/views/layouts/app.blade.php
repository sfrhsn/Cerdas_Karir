<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cerdas Karir')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Hanken+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        :root {
            --primary:                #182b3f;
            --secondary:              #3d6374;
            --tertiary:               #1c2c36;
            --surface:                #fef8f4;
            --surface-container:      #f3ede9;
            --surface-low:            #f8f2ee;
            --surface-lowest:         #ffffff;
            --surface-high:           #ede7e3;
            --surface-highest:        #e7e1dd;
            --secondary-container:    #bee6f9;
            --on-secondary-container: #426878;
            --outline-variant:        #c4c6cd;
            --on-surface:             #1d1b19;
            --on-surface-variant:     #44474c;
            --on-primary:             #ffffff;
            --on-secondary:           #ffffff;
            --on-tertiary:            #ffffff;
            --on-tertiary-variant:    #394953;
            --secondary-fixed:        #c1e8fc;
            --on-secondary-fixed:     #001f29;
            --inverse-primary:        #b5c8e2;
            /* Legacy aliases untuk halaman lama */
            --navy:  #182b3f;
            --teal:  #3d6374;
            --sky:   #c8d9e6;
            --beige: #fef8f4;
            --muted: #44474c;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Hanken Grotesk', sans-serif;
            background: var(--surface);
            color: var(--on-surface);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Libre Caslon Text', serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* ── NAVBAR — prefix ck- agar tidak bentrok Bootstrap ── */
        .ck-navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--outline-variant);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .ck-navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 64px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }
        @media (max-width: 768px) {
            .ck-navbar-inner { padding: 0 16px; }
        }
        .ck-navbar-left  { display: flex; align-items: center; gap: 2rem; }
        .ck-navbar-brand {
            font-family: 'Libre Caslon Text', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }
        .ck-navbar-links { display: flex; gap: 1.5rem; }
        .ck-navbar-links a {
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--on-surface-variant);
            text-decoration: none;
            transition: color 0.2s;
        }
        .ck-navbar-links a:hover { color: var(--primary); }

        /* Ganti dengan ini */
        .ck-navbar-links a {
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--on-surface-variant);
            text-decoration: none;
            position: relative;
            padding-bottom: 4px;
            transition: color 0.25s ease;
        }
        .ck-navbar-links a::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left center;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .ck-navbar-links a:hover { color: var(--primary); }
        .ck-navbar-links a:hover::after { transform: scaleX(0.6); opacity: 0.4; }
        .ck-navbar-links a.active { color: var(--primary); font-weight: 700; }
        .ck-navbar-links a.active::after { transform: scaleX(1); }  
        .ck-navbar-right { display: flex; align-items: center; gap: 1rem; }

        .ck-btn-signin {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--primary);
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            border-radius: 4px;
            font-family: 'Hanken Grotesk', sans-serif;
        }
        .ck-btn-signin:hover { background: var(--surface-low); color: var(--primary); }

        .ck-btn-joinnow {
            background: var(--primary);
            color: var(--on-primary) !important;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none !important;
            transition: opacity 0.2s;
            display: inline-block;
            font-family: 'Hanken Grotesk', sans-serif;
        }
        .ck-btn-joinnow:hover { opacity: 0.88; color: var(--on-primary) !important; }

        /* ── LEGACY BUTTONS (dipakai halaman lama) ── */
        .btn { padding: 0.5rem 1.2rem; border-radius: 6px; border: none; cursor: pointer; font-size: 0.9rem; font-weight: 500; text-decoration: none; display: inline-block; transition: all 0.2s; font-family: 'Hanken Grotesk', sans-serif; }
        .btn-outline { border: 1.5px solid var(--navy); color: var(--navy); background: transparent; }
        .btn-outline:hover { background: var(--navy); color: white; }
        .btn-primary { background: var(--navy); color: white; }
        .btn-primary:hover { background: var(--teal); color: white; }
        .btn-teal { background: var(--teal); color: white; }

        /* ── ALERT ── */
        .alert-bar { padding: 0.75rem 1.5rem; font-size: 0.875rem; border-radius: 8px; margin: 1rem 2rem; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error   { background: #f8d7da; color: #721c24; }

        /* ── FOOTER ── */
        .ck-footer {
            background: var(--tertiary);
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }
        
        .ck-footer-grid {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3rem 64px;
            display: grid;
            grid-template-columns: 5fr 2fr 2fr;
            gap: 24rem;
        }
        @media (max-width: 768px) {
            .ck-footer-grid { grid-template-columns: 1fr; padding: 2rem 1rem; }
        }
        .ck-footer-brand {
            font-family: 'Libre Caslon Text', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--on-tertiary);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .ck-footer-tagline {
            font-size: 0.875rem;
            color: var(--on-tertiary-variant);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .ck-footer-socials { display: flex; gap: 1rem; }
        .ck-footer-socials a { color: var(--on-tertiary); text-decoration: none; transition: color 0.2s; }
        .ck-footer-socials a:hover { color: var(--inverse-primary); }
        .ck-footer-col h4 {
            font-family: 'Hanken Grotesk', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--on-tertiary);
            margin-bottom: 1.5rem;
        }
        .ck-footer-col ul { list-style: none; padding: 0; }
        .ck-footer-col ul li { margin-bottom: 1rem; }
        .ck-footer-col ul li a { font-size: 0.75rem; color: var(--on-tertiary-variant); text-decoration: none; transition: color 0.2s; }
        .ck-footer-col ul li a:hover { color: var(--on-tertiary); text-decoration: underline; }
        .ck-footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 1.5rem 64px;
            max-width: 1280px;
            margin: 0 auto;
            text-align: center;
        }
        .ck-footer-bottom p { font-size: 0.875rem; color: var(--on-tertiary-variant); }
    </style>
    @stack('styles')
</head>
<body>

<!-- NAVBAR -->
<header class="ck-navbar">
    <div class="ck-navbar-inner">
        <div class="ck-navbar-left">
            <a href="{{ route('home') }}" class="ck-navbar-brand">Cerdas Karir</a>
            <nav class="ck-navbar-links">
                <a href="{{ route('quiz.index') }}"
                    class="{{ request()->routeIs('quiz.*') ? 'active' : '' }}">Quiz</a>
                <a href="{{ route('articles.index') }}"
                    class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Articles</a>
                @auth
                    <a href="{{ route('bookmark.index') }}"
                        class="{{ request()->routeIs('bookmark.*') ? 'active' : '' }}">Bookmark</a>
                @endauth
            </nav>
        </div>
        <div class="ck-navbar-right">
            @auth
                <a href="{{ route('profile.index') }}" class="ck-btn-signin">Akun Saya</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="ck-btn-joinnow">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="ck-btn-signin">Sign In</a>
                <a href="{{ route('register') }}" class="ck-btn-joinnow">Join Now</a>
            @endauth
        </div>
    </div>
</header>

@if(session('success'))
    <div class="alert-bar alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert-bar alert-error">{{ session('error') }}</div>
@endif

<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="ck-footer">
    <div class="ck-footer-grid">
        <div>
            <a href="{{ route('home') }}" class="ck-footer-brand">Cerdas Karir</a>
            <p class="ck-footer-tagline">Empowering your professional trajectory through intelligent data and community insights.</p>
            <div class="ck-footer-socials">
                <a href="{{ route('home') }}"><span class="material-symbols-outlined">public</span></a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=sifahasnarisda@gmail.com" target="_blank""><span class="material-symbols-outlined">mail</span></a>
                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"><span class="material-symbols-outlined">share</span></a>
            </div>
        </div>
        <div class="ck-footer-col">
            <h4>Platform</h4>
            <ul>
                <li><a href="{{ route('home') }}">About Us</a></li>
                <li><a href="{{ route('quiz.index') }}">Career Quiz</a></li>
                <li><a href="{{ route('articles.index') }}">Article Library</a></li>
            </ul>
        </div>
        <div class="ck-footer-col">
            <h4>Resources</h4>
            <ul>
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                <li><a href="https://wa.me/6285748039016" target="_blank">Contact Support</a></li>
            </ul>
        </div>
    </div>
    <div class="ck-footer-bottom">
        <p>© {{ date('Y') }} Cerdas Karir. All rights reserved. Empowering your professional trajectory.</p>
    </div>
</footer>

@stack('scripts')
</body>
</html>