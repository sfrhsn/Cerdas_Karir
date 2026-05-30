<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cerdas Karir')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        :root { --navy:#2F4156; --teal:#567C8D; --sky:#C8D9E6; --beige:#F5EFEB; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DM Sans',sans-serif; display:flex; min-height:100vh; }
        h1,h2,h3 { font-family:'Playfair Display',serif; }
        .auth-left {
            width: 48%;
            background: linear-gradient(135deg, var(--navy) 0%, var(--teal) 100%);
            background-size: cover;
            background-position: center;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(47,65,86,0.92), rgba(86,124,141,0.85));
        }
        .auth-left-content { position: relative; z-index: 1; }
        .auth-brand { font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; margin-bottom:2rem; }
        .auth-left h2 { font-size:2.5rem; line-height:1.2; margin-bottom:1rem; }
        .auth-left p { opacity:0.85; line-height:1.6; margin-bottom:2rem; }
        .auth-feature { display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.2rem; }
        .auth-feature-icon { width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.1rem; }
        .auth-feature-text strong { display:block; font-size:0.95rem; margin-bottom:0.2rem; }
        .auth-feature-text span { font-size:0.85rem; opacity:0.8; }
        .auth-right { width:52%;background:var(--beige);display:flex;align-items:center;justify-content:center;padding:3rem; }
        .auth-form-box { width:100%;max-width:460px; }
        .auth-form-box h1 { font-size:2rem;margin-bottom:0.3rem;color:#1a2a35; }
        .auth-form-box .subtitle { color:#6b7e8a;margin-bottom:2rem;font-size:0.95rem; }
        .form-group { margin-bottom:1.2rem; }
        .form-group label { display:block;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:#6b7e8a;margin-bottom:0.4rem; }
        .form-group input {
            width:100%;padding:0.8rem 1rem;border:1.5px solid var(--sky);border-radius:8px;
            background:white;font-size:0.95rem;color:#1a2a35;transition:border-color 0.2s;
            font-family:'DM Sans',sans-serif;
        }
        .form-group input:focus { outline:none;border-color:var(--teal); }
        .form-row { display:grid;grid-template-columns:1fr 1fr;gap:1rem; }
        .btn-auth {
            width:100%;padding:0.9rem;background:var(--navy);color:white;border:none;border-radius:8px;
            font-size:0.9rem;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;cursor:pointer;
            transition:background 0.2s;font-family:'DM Sans',sans-serif;margin-top:0.5rem;
        }
        .btn-auth:hover { background:var(--teal); }
        .auth-footer { text-align:center;margin-top:1.5rem;font-size:0.9rem;color:#6b7e8a; }
        .auth-footer a { color:var(--navy);font-weight:700;text-decoration:none; }
        .error-msg { color:#c0392b;font-size:0.8rem;margin-top:0.3rem; }
        .form-check { display:flex;align-items:center;gap:0.6rem;margin-bottom:1rem; }
        .form-check input { width:auto; }
        .form-check label { font-size:0.85rem;color:#6b7e8a;text-transform:none;letter-spacing:0; }
        .form-check a { color:var(--navy);font-weight:600; }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>