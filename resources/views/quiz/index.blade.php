@extends('layouts.app')

@section('title', 'Quiz Karir - Cerdas Karir')

@push('styles')
<style>
    :root {
        --ck-primary:   #182b3f;
        --ck-secondary: #3d6374;
        --ck-tertiary:  #1c2c36;
        --ck-surface:   #fef8f4;
        --ck-low:       #f8f2ee;
        --ck-sky:       #c8d9e6;
        --ck-sec-cont:  #bee6f9;
        --ck-on-sec:    #426878;
        --ck-muted:     #44474c;
    }

    body { background: var(--ck-surface); font-family: 'Hanken Grotesk', 'Segoe UI', sans-serif; }

    /* ── PAGE HEADER ── */
    .quiz-page-header {
        background: var(--ck-surface);
        padding: 2.8rem 0 2.5rem;
        text-align: center;
        border-bottom: 1px solid #e8ecf0;
    }
    .quiz-page-header h1 {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--ck-primary);
        margin-bottom: 0.75rem;
        letter-spacing: -0.01em;
    }
    .quiz-page-header p {
        font-size: 0.9375rem;
        color: var(--ck-muted);
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.65;
    }

    /* ── QUIZ GRID WRAP ── */
    .quiz-grid-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 64px 0;
    }

    /* ── ROW 1: dua card besar (58:42 ratio) ── */
    .quiz-row-top {
        display: grid;
        grid-template-columns: 86fr 42fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .top-card-large,
    .top-card-small {
        min-height: 200px;
    }
    .top-card-large .quiz-card,
    .top-card-small .quiz-card {
        height: 100%;
    }

    /* ── ROW REST: 3 kolom equal ── */
    .quiz-row-rest {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 0;
    }
    .rest-card-col { min-height: 260px; }
    .rest-card-col .quiz-card { height: 100%; }

    /* ── QUIZ CARD BASE ── */
    .quiz-card {
        background: #ffffff;
        border: 1.5px solid var(--ck-sky);
        border-radius: 14px;
        padding: 2rem;
        transition: all 0.28s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    .quiz-card:hover {
        border-color: var(--ck-secondary);
        box-shadow: 0 12px 36px rgba(24, 43, 63, 0.1);
        transform: translateY(-5px);
    }

    /* Featured card (card 1 — dark navy) */
    .quiz-card.card-featured {
        background: var(--ck-primary);
        border-color: var(--ck-primary);
    }
    .quiz-card.card-featured:hover {
        border-color: var(--ck-secondary);
        box-shadow: 0 16px 48px rgba(24, 43, 63, 0.25);
    }

    /* Highlight card (card 2 — light blue) */
    .quiz-card.card-highlight {
        background: var(--ck-sec-cont);
        border-color: var(--ck-sec-cont);
    }
    .quiz-card.card-highlight:hover {
        border-color: var(--ck-secondary);
    }

    /* ── CARD ICON ── */
    .quiz-card-icon {
        width: 52px;
        height: 52px;
        background: var(--ck-low);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        flex-shrink: 0;
    }
    .quiz-card-icon .material-symbols-outlined {
        font-size: 1.6rem;
        color: var(--ck-secondary);
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    .card-featured .quiz-card-icon {
        background: rgba(255, 255, 255, 0.1);
    }
    .card-featured .quiz-card-icon .material-symbols-outlined {
        color: var(--ck-sky);
    }
    .card-highlight .quiz-card-icon {
        background: rgba(255, 255, 255, 0.55);
    }
    .card-highlight .quiz-card-icon .material-symbols-outlined {
        color: var(--ck-secondary);
    }

    /* ── CARD META ── */
    .quiz-card-meta {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ck-secondary);
        margin-bottom: 0.4rem;
    }
    .card-featured .quiz-card-meta  { color: rgba(200, 217, 230, 0.7); }
    .card-highlight .quiz-card-meta { color: var(--ck-on-sec); }

    /* ── CARD TITLE ── */
    .quiz-card-title {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--ck-primary);
        margin-bottom: 0.6rem;
        line-height: 1.3;
    }
    .card-featured .quiz-card-title  { color: #fff; }
    .card-highlight .quiz-card-title { color: var(--ck-primary); }

    /* ── CARD DESCRIPTION ── */
    .quiz-card-desc {
        font-size: 0.875rem;
        color: var(--ck-muted);
        line-height: 1.6;
        flex: 1;
        margin-bottom: 1.75rem;
    }
    .card-featured .quiz-card-desc  { color: rgba(255, 255, 255, 0.65); }
    .card-highlight .quiz-card-desc { color: var(--ck-on-sec); }

    /* ── CARD CTA ── */
    .quiz-card-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.875rem;
        font-weight: 700;
        text-decoration: none;
        color: var(--ck-primary);
        transition: gap 0.2s;
        margin-top: auto;
    }
    .quiz-card-cta:hover { gap: 0.7rem; color: var(--ck-secondary); text-decoration: none; }
    .card-featured .quiz-card-cta        { color: var(--ck-sky); }
    .card-featured .quiz-card-cta:hover  { color: #fff; }
    .card-highlight .quiz-card-cta       { color: var(--ck-primary); }
    .card-highlight .quiz-card-cta:hover { color: var(--ck-secondary); }

    /* ── UNIVERSAL BANNER ── */
    .universal-banner {
        max-width: 1280px;
        margin: 2rem auto 4rem;
        padding: 0 64px;
    }
    .universal-banner-inner {
        background: var(--ck-tertiary);
        border-radius: 16px;
        padding: 2.5rem 3rem;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 2rem;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .universal-banner-inner::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 260px;
        height: 260px;
        background: rgba(61, 99, 116, 0.35);
        border-radius: 50%;
        pointer-events: none;
    }
    .ub-badge {
        display: inline-block;
        background: rgba(190, 230, 249, 0.15);
        color: var(--ck-sec-cont);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        border: 1px solid rgba(190, 230, 249, 0.25);
        margin-bottom: 0.75rem;
    }
    .ub-title {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.6rem;
        line-height: 1.25;
    }
    .ub-desc {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.6;
        max-width: 520px;
        margin-bottom: 1.5rem;
    }
    .btn-ub {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ck-sec-cont);
        color: var(--ck-primary);
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        transition: all 0.2s;
        font-family: inherit;
        cursor: pointer;
    }
    .btn-ub:hover {
        background: #a5ccdf;
        color: var(--ck-primary);
        text-decoration: none;
        transform: translateY(-1px);
    }
    .ub-image {
        width: 220px;
        height: 160px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    .ub-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        opacity: 0.85;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .quiz-grid-wrap   { padding: 3rem 32px 0; }
        .universal-banner { padding: 0 32px; }
    }
    @media (max-width: 900px) {
        .quiz-row-top  { grid-template-columns: 1fr; }
        .quiz-row-rest { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .quiz-page-header h1              { font-size: 1.75rem; }
        .quiz-grid-wrap                   { padding: 2rem 16px 0; }
        .universal-banner                 { padding: 0 16px; }
        .quiz-row-rest                    { grid-template-columns: 1fr; }
        .universal-banner-inner           { grid-template-columns: 1fr; padding: 2rem; }
        .ub-image                         { display: none; }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="quiz-page-header">
    <h1>Temukan Potensi Karir<br>Terpendam Anda</h1>
    <p>Pilih bidang yang menarik minatmu dan ambil kuis kecerdasan karir untuk mendapatkan wawasan mendalam tentang jalur profesional masa depanmu.</p>
</div>

{{-- ── QUIZ CARDS GRID ── --}}
<div class="quiz-grid-wrap">

    @php
        $iconMap = [
            'Teknologi'           => 'terminal',
            'Industri Kreatif'    => 'palette',
            'Layanan Kesehatan'   => 'health_and_safety',
            'Keuangan & Bisnis'   => 'account_balance',
            'Keuangan'            => 'account_balance',
            'Pendidikan & Sosial' => 'school',
            'Pendidikan'          => 'school',
            'Leadership'          => 'groups',
            'Marketing'           => 'campaign',
            'Data & Analytics'    => 'analytics',
        ];

        $quizList  = $quizzes->values();
        $firstTwo  = $quizList->take(2);
        $remaining = $quizList->slice(2);
    @endphp

    {{-- ROW 1: card 1 (58%) + card 2 (42%) --}}
    @if($firstTwo->count() > 0)
    <div class="quiz-row-top">
        @foreach($firstTwo as $i => $quiz)
        @php
            $cardClass = $i === 0 ? 'card-featured' : 'card-highlight';
            $icon      = $iconMap[$quiz->category] ?? 'quiz';
            $sizeClass = $i === 0 ? 'top-card-large' : 'top-card-small';
        @endphp
        <div class="{{ $sizeClass }}">
            <div class="quiz-card {{ $cardClass }}">
                <div class="quiz-card-icon">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <div class="quiz-card-meta">{{ $quiz->category }} · {{ $quiz->duration_minutes }} menit</div>
                <div class="quiz-card-title">{{ $quiz->title }}</div>
                <div class="quiz-card-desc">{{ $quiz->description }}</div>
                @auth
                    <a href="{{ route('quiz.show', $quiz->id) }}" class="quiz-card-cta">
                        Mulai Kuis <span>→</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="quiz-card-cta">
                        Mulai Kuis <span>→</span>
                    </a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ROW 2+: sisa quiz, 3 per baris --}}
    @if($remaining->count() > 0)
    <div class="quiz-row-rest">
        @foreach($remaining as $quiz)
        @php $icon = $iconMap[$quiz->category] ?? 'quiz'; @endphp
        <div class="rest-card-col">
            <div class="quiz-card">
                <div class="quiz-card-icon">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <div class="quiz-card-meta">{{ $quiz->category }} · {{ $quiz->duration_minutes }} menit</div>
                <div class="quiz-card-title">{{ $quiz->title }}</div>
                <div class="quiz-card-desc">{{ $quiz->description }}</div>
                @auth
                    <a href="{{ route('quiz.show', $quiz->id) }}" class="quiz-card-cta">
                        Mulai Kuis <span>→</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="quiz-card-cta">
                        Mulai Kuis <span>→</span>
                    </a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

{{-- ── UNIVERSAL BANNER ── --}}
<div class="universal-banner">
    <div class="universal-banner-inner">
        <div style="position:relative;z-index:1">
            <div class="ub-badge">REKOMENDASI MULAI</div>
            <h2 class="ub-title">Analisis Kepribadian Kerja Universal</h2>
            <p class="ub-desc">Tidak yakin harus mulai dari mana? Ambil kuis dasar kami untuk memetakan kepribadian kerjamu secara umum sebelum memilih spesialisasi.</p>
            @auth
                @if($universalQuiz)
                    <a href="{{ route('quiz.show', $universalQuiz->id) }}" class="btn-ub">
                        Ambil Kuis Dasar
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-ub">
                    Ambil Kuis Dasar
                </a>
            @endauth
        </div>
        <div class="ub-image">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=400&q=80"
                 alt="Team discussion">
        </div>
    </div>
</div>

@endsection