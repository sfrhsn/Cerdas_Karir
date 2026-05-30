@extends('layouts.app')

@section('title', 'Bookmark - Cerdas Karir')

@push('styles')
<style>
    :root {
        --ck-primary:   #182b3f;
        --ck-secondary: #3d6374;
        --ck-surface:   #fef8f4;
        --ck-low:       #f8f2ee;
        --ck-sky:       #c8d9e6;
        --ck-sec-cont:  #bee6f9;
        --ck-on-sec:    #426878;
        --ck-muted:     #44474c;
        --ck-white:     #ffffff;
    }

    body { background: var(--ck-surface); }

    /* ── PAGE HEADER ── */
    .bm-header {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 64px 0;
    }
    .bm-header h1 {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--ck-primary);
        margin-bottom: 0.4rem;
        letter-spacing: -0.01em;
    }
    .bm-subtitle {
        font-size: 0.9375rem;
        color: var(--ck-muted);
        margin-bottom: 2.5rem;
    }

    /* ── GRID ── */
    .bm-grid {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 64px 4rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    /* ── CARD ── */
    .bm-card {
        background: var(--ck-white);
        border-radius: 16px;
        padding: 1.6rem;
        border: 1.5px solid #e8ecf0;
        transition: all 0.25s cubic-bezier(0.175,0.885,0.32,1.1);
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .bm-card:hover {
        border-color: var(--ck-sky);
        box-shadow: 0 10px 32px rgba(24,43,63,0.09);
        transform: translateY(-3px);
    }

    /* Card top row: badge + delete */
    .bm-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    /* Match badge */
    .bm-match-badge {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        letter-spacing: 0.03em;
    }
    .bm-match-high    { background: #d4f0e8; color: #0d6b4a; }
    .bm-match-medium  { background: #fff3cd; color: #856404; }
    .bm-match-low     { background: var(--ck-sec-cont); color: var(--ck-on-sec); }

    /* Delete button */
    .bm-delete-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #bbb;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.2rem;
        border-radius: 6px;
        transition: color 0.2s, background 0.2s;
        font-family: inherit;
    }
    .bm-delete-btn:hover { color: #e74c3c; background: #fff5f5; }
    .bm-delete-btn .material-symbols-outlined { font-size: 1.2rem; }

    /* Position title */
    .bm-position {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--ck-primary);
        margin-bottom: 0.3rem;
        line-height: 1.25;
    }

    /* Date */
    .bm-date {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ck-muted);
        margin-bottom: 1.25rem;
        opacity: 0.65;
    }

    /* Trait bars */
    .bm-traits { margin-bottom: 1.5rem; flex: 1; }
    .bm-trait-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .bm-trait-row:last-child { margin-bottom: 0; }
    .bm-trait-label {
        font-size: 0.82rem;
        color: var(--ck-primary);
        font-weight: 500;
        min-width: 100px;
        flex-shrink: 0;
    }
    .bm-trait-track {
        flex: 1;
        height: 5px;
        background: #eef2f5;
        border-radius: 3px;
        overflow: hidden;
    }
    .bm-trait-fill {
        height: 100%;
        background: var(--ck-primary);
        border-radius: 3px;
        transition: width 1s ease;
    }
    .bm-trait-pct {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--ck-muted);
        min-width: 36px;
        text-align: right;
        flex-shrink: 0;
    }

    /* Detail button */
    .bm-detail-btn {
        display: block;
        width: 100%;
        padding: 0.65rem;
        background: transparent;
        color: var(--ck-primary);
        border: 1.5px solid #dde3e9;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: inherit;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: auto;
    }
    .bm-detail-btn:hover {
        background: var(--ck-primary);
        color: white;
        border-color: var(--ck-primary);
        text-decoration: none;
    }

    /* ── EMPTY STATE ── */
    .bm-empty {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 64px 4rem;
        text-align: center;
    }
    .bm-empty-icon {
        width: 72px;
        height: 72px;
        background: var(--ck-low);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 3rem auto 1.5rem;
    }
    .bm-empty-icon .material-symbols-outlined {
        font-size: 2rem;
        color: var(--ck-secondary);
    }
    .bm-empty h2 {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.5rem;
        color: var(--ck-primary);
        margin-bottom: 0.6rem;
    }
    .bm-empty p {
        font-size: 0.9375rem;
        color: var(--ck-muted);
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.65;
    }
    .bm-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--ck-primary);
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.75rem 1.75rem;
        border-radius: 8px;
        text-decoration: none;
        font-family: inherit;
        transition: background 0.2s;
    }
    .bm-empty-btn:hover { background: var(--ck-secondary); color: white; text-decoration: none; }

    @media (max-width: 1024px) {
        .bm-header, .bm-grid, .bm-empty { padding-left: 32px; padding-right: 32px; }
        .bm-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 640px) {
        .bm-header, .bm-grid, .bm-empty { padding-left: 16px; padding-right: 16px; }
        .bm-grid { grid-template-columns: 1fr; }
        .bm-header h1 { font-size: 1.75rem; }
    }
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="bm-header">
    <h1>Hasil Kuis Tersimpan</h1>
    <p class="bm-subtitle">Pantau perkembangan kompetensi dan eksplorasi jalur karir Anda.</p>
</div>

@if($bookmarks->count() > 0)

{{-- BOOKMARK GRID --}}
<div class="bm-grid">
    @foreach($bookmarks as $i => $bookmark)
    @php
        $result      = $bookmark->quizResult;
        $traitScores = $result->trait_scores ?? [];
        $maxScore    = !empty($traitScores) ? max($traitScores) : 1;
        $maxScore    = $maxScore ?: 1;

        /* Top 2 traits untuk ditampilkan di bar */
        arsort($traitScores);
        $topTraits = array_slice($traitScores, 0, 2, true);

        /* Match badge berdasarkan skor tertinggi */
        $topScore = !empty($traitScores) ? max($traitScores) : 0;
        if ($topScore >= 75) {
            $matchLabel = 'High Match';
            $matchClass = 'bm-match-high';
        } elseif ($topScore >= 50) {
            $matchLabel = 'Medium Match';
            $matchClass = 'bm-match-medium';
        } else {
            $matchLabel = 'Emerging Talent';
            $matchClass = 'bm-match-low';
        }
    @endphp
    <div class="bm-card">

        {{-- TOP: badge + delete --}}
        <div class="bm-card-top">
            <span class="bm-match-badge {{ $matchClass }}">{{ $matchLabel }}</span>
            <form method="POST" action="{{ route('bookmark.destroy', $result->id) }}">
                @csrf @method('DELETE')
                <button type="submit" class="bm-delete-btn" title="Hapus bookmark"
                    onclick="return confirm('Hapus bookmark ini?')">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
        </div>

        {{-- Position --}}
        <div class="bm-position">{{ $result->recommended_position }}</div>
        <div class="bm-date">{{ strtoupper($bookmark->created_at->translatedFormat('d F Y')) }}</div>

        {{-- Trait bars (top 2) --}}
        <div class="bm-traits">
            @foreach($topTraits as $trait => $score)
            @php $pct = round(($score / $maxScore) * 100); @endphp
            <div class="bm-trait-row">
                <div class="bm-trait-label">{{ ucfirst($trait) }}</div>
                <div class="bm-trait-track">
                    <div class="bm-trait-fill" style="width:{{ $pct }}%"></div>
                </div>
                <div class="bm-trait-pct">{{ $pct }}%</div>
            </div>
            @endforeach

            {{-- Fallback: jika tidak ada trait scores, tampilkan key_strengths --}}
            @if(empty($traitScores) && !empty($result->key_strengths))
                @foreach(array_slice($result->key_strengths, 0, 2) as $s)
                <div class="bm-trait-row">
                    <div class="bm-trait-label">{{ ucfirst($s) }}</div>
                    <div class="bm-trait-track">
                        <div class="bm-trait-fill" style="width:70%"></div>
                    </div>
                    <div class="bm-trait-pct">70%</div>
                </div>
                @endforeach
            @endif
        </div>

        {{-- Detail button --}}
        <a href="{{ route('bookmark.show', $result->id) }}" class="bm-detail-btn">
            Lihat Detail
        </a>

    </div>
    @endforeach
</div>

@else

{{-- EMPTY STATE --}}
<div class="bm-empty">
    <div class="bm-empty-icon">
        <span class="material-symbols-outlined">bookmark</span>
    </div>
    <h2>Belum ada hasil tersimpan</h2>
    <p>Selesaikan kuis karir dan simpan hasilnya untuk memantau perkembangan kompetensi Anda dari waktu ke waktu.</p>
    <a href="{{ route('quiz.index') }}" class="bm-empty-btn">
        <span class="material-symbols-outlined" style="font-size:1rem">play_arrow</span>
        Mulai Quiz Sekarang
    </a>
</div>

@endif

@endsection