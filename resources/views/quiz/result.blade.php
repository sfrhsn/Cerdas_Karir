@extends('layouts.app')

@section('title', 'Hasil Analisis - Cerdas Karir')

@push('styles')
<style>
    /* ── TOKENS ── */
    :root {
        --ck-primary:   #182b3f;
        --ck-secondary: #3d6374;
        --ck-surface:   #fef8f4;
        --ck-low:       #f8f2ee;
        --ck-sky:       #c8d9e6;
        --ck-sec-cont:  #bee6f9;
        --ck-muted:     #44474c;
        --ck-white:     #ffffff;
    }

    body { background: var(--ck-surface); }

    /* ── WRAPPER ── */
    .result-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 64px 4rem;
    }

    /* ── HEADER ── */
    .result-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    .result-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--ck-sec-cont);
        color: var(--ck-on-sec, #426878);
        font-size: 0.78rem;
        font-weight: 700;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        margin-bottom: 1rem;
        letter-spacing: 0.04em;
    }
    .result-badge .material-symbols-outlined { font-size: 1rem; }
    .result-header h1 {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 2.4rem;
        color: var(--ck-primary);
        margin-bottom: 0.8rem;
        letter-spacing: -0.02em;
    }
    .result-header p {
        color: var(--ck-muted);
        max-width: 560px;
        margin: 0 auto;
        font-size: 0.9375rem;
        line-height: 1.65;
    }

    /* ── MAIN GRID ── */
    .result-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* Position card */
    .position-card {
        background: var(--ck-white);
        border-radius: 16px;
        padding: 2.25rem;
        border-left: 4px solid var(--ck-primary);
        box-shadow: 0 2px 12px rgba(24,43,63,0.06);
    }
    .position-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        font-weight: 700;
        color: var(--ck-secondary);
        letter-spacing: 0.12em;
        margin-bottom: 0.4rem;
    }
    .position-sub {
        font-size: 0.85rem;
        color: var(--ck-muted);
        margin-bottom: 0.3rem;
    }
    .position-title {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.7rem;
        color: var(--ck-primary);
        margin-bottom: 1rem;
        line-height: 1.2;
        font-weight: 700;
    }
    .position-summary {
        font-size: 0.9rem;
        color: var(--ck-muted);
        margin-bottom: 1.25rem;
        line-height: 1.65;
    }
    .trait-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
    }
    .trait-tag {
        background: var(--ck-sec-cont);
        color: var(--ck-primary);
        font-size: 0.75rem;
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
    }
    .result-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .btn-roadmap {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--ck-primary);
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.7rem 1.4rem;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        font-family: inherit;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-roadmap:hover { background: var(--ck-secondary); color: white; text-decoration: none; }
    .btn-roadmap .material-symbols-outlined { font-size: 1rem; }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: transparent;
        color: var(--ck-primary);
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.7rem 1.4rem;
        border-radius: 8px;
        border: 1.5px solid var(--ck-primary);
        text-decoration: none;
        font-family: inherit;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-save:hover { background: var(--ck-primary); color: white; }
    .btn-save .material-symbols-outlined { font-size: 1rem; }
    .btn-saved {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: transparent;
        color: var(--ck-muted);
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.7rem 1.4rem;
        border-radius: 8px;
        border: 1.5px solid #ddd;
        font-family: inherit;
        cursor: default;
        opacity: 0.7;
    }
    .btn-saved .material-symbols-outlined { font-size: 1rem; }

    /* Chart card */
    .chart-card {
        background: var(--ck-primary);
        border-radius: 16px;
        padding: 2.25rem;
        color: white;
        box-shadow: 0 2px 12px rgba(24,43,63,0.15);
    }
    .chart-card-title {
        font-family: 'Hanken Grotesk', sans-serif;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        opacity: 0.6;
        margin-bottom: 1.75rem;
        font-weight: 700;
    }
    .trait-bar { margin-bottom: 1.1rem; }
    .trait-bar-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
        opacity: 0.9;
    }
    .trait-bar-track {
        height: 6px;
        background: rgba(255,255,255,0.12);
        border-radius: 3px;
    }
    .trait-bar-fill {
        height: 100%;
        background: var(--ck-sky);
        border-radius: 3px;
        transition: width 1.2s cubic-bezier(0.4,0,0.2,1);
    }
    .strengths-box {
        background: rgba(255,255,255,0.07);
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-top: 1.5rem;
        border: 1px solid rgba(255,255,255,0.08);
    }
    .strengths-box-title {
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0.5;
        margin-bottom: 0.8rem;
        font-weight: 700;
    }
    .strength-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.875rem;
        margin-bottom: 0.55rem;
        opacity: 0.9;
    }
    .strength-item .material-symbols-outlined {
        font-size: 1rem;
        color: var(--ck-sky);
        font-variation-settings: 'FILL' 1, 'wght' 400;
    }

    /* ── AI INSIGHTS ── */
    .ai-insights {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .insight-card {
        border-radius: 14px;
        padding: 1.75rem;
        color: white;
    }
    .insight-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0.6;
        margin-bottom: 0.75rem;
        font-weight: 700;
    }
    .insight-header .material-symbols-outlined { font-size: 1rem; }
    .insight-text { font-size: 0.9rem; line-height: 1.65; opacity: 0.9; }

    /* ── DEEP ANALYSIS ── */
    .deep-section-title {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1.5rem;
        color: var(--ck-primary);
        margin-bottom: 1.25rem;
        font-weight: 700;
    }
    .deep-analysis {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }
    .analysis-card {
        background: var(--ck-white);
        border-radius: 14px;
        padding: 1.75rem;
        border: 1px solid #eee;
        transition: box-shadow 0.2s;
    }
    .analysis-card:hover { box-shadow: 0 6px 20px rgba(24,43,63,0.08); }
    .analysis-icon-wrap {
        width: 48px;
        height: 48px;
        background: var(--ck-low);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .analysis-icon-wrap .material-symbols-outlined {
        font-size: 1.5rem;
        color: var(--ck-secondary);
        font-variation-settings: 'FILL' 0, 'wght' 300;
    }
    .analysis-card h3 {
        font-family: 'Libre Caslon Text', Georgia, serif;
        font-size: 1rem;
        color: var(--ck-primary);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }
    .analysis-card p {
        font-size: 0.8375rem;
        color: var(--ck-muted);
        line-height: 1.65;
    }

    @media (max-width: 1024px) {
        .result-wrap { padding: 2.5rem 32px 3rem; }
    }
    @media (max-width: 768px) {
        .result-wrap       { padding: 2rem 16px 3rem; }
        .result-main       { grid-template-columns: 1fr; }
        .ai-insights       { grid-template-columns: 1fr; }
        .deep-analysis     { grid-template-columns: 1fr 1fr; }
        .result-header h1  { font-size: 1.75rem; }
    }
    @media (max-width: 480px) {
        .deep-analysis { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="result-wrap">

    {{-- HEADER --}}
    <div class="result-header">
        <div class="result-badge">
            <span class="material-symbols-outlined">target</span>
            Analisis Selesai
        </div>
        <h1>Hasil Analisis Karir Anda</h1>
        <p>Berdasarkan respon dan kecenderungan profesional Anda, kami telah memetakan jalur pertumbuhan yang paling optimal.</p>
    </div>

    {{-- MAIN: position + chart --}}
    <div class="result-main">

        {{-- Left: position --}}
        <div class="position-card">
            <div class="position-label">PREDIKSI JABATAN TERTINGGI</div>
            <div class="position-sub">Cocok untuk:</div>
            <h2 class="position-title">{{ $result->recommended_position }}</h2>
            <p class="position-summary">{{ $result->analysis_summary }}</p>
            <div class="trait-tags">
                @foreach($result->key_strengths as $strength)
                    <span class="trait-tag">{{ ucfirst($strength) }}</span>
                @endforeach
            </div>
            <div class="result-actions">
                <a href="{{ route('roadmap.show', $result->id) }}" class="btn-roadmap">
                    <span class="material-symbols-outlined">map</span>
                    Lihat Roadmap
                </a>
                @if(!$isBookmarked)
                <form method="POST" action="{{ route('bookmark.store') }}">
                    @csrf
                    <input type="hidden" name="quiz_result_id" value="{{ $result->id }}">
                    <button type="submit" class="btn-save">
                        <span class="material-symbols-outlined">bookmark</span>
                        Simpan
                    </button>
                </form>
                @else
                    <span class="btn-saved">
                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">bookmark</span>
                        Tersimpan
                    </span>
                @endif
            </div>
        </div>

        {{-- Right: chart --}}
        <div class="chart-card">
            <div class="chart-card-title">Visualisasi Kompetensi</div>
            @php
                $traitScores = $result->trait_scores ?? [];
                $maxScore    = !empty($traitScores) ? max($traitScores) : 1;
                $maxScore    = $maxScore ?: 1;
            @endphp
            @foreach($traitScores as $trait => $score)
            <div class="trait-bar">
                <div class="trait-bar-label">
                    <span>{{ $trait }}</span>
                    <span>{{ $score }}</span>
                </div>
                <div class="trait-bar-track">
                    <div class="trait-bar-fill" style="width:{{ ($score / $maxScore) * 100 }}%"></div>
                </div>
            </div>
            @endforeach
            <div class="strengths-box">
                <div class="strengths-box-title">Key Strengths</div>
                @foreach($result->key_strengths as $strength)
                <div class="strength-item">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ ucfirst($strength) }}
                </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- AI INSIGHTS --}}
    @php
        $advice = session('quiz_advice_' . $result->id);
        $growth = session('quiz_growth_' . $result->id);
    @endphp
    @if($advice || $growth)
    <div class="ai-insights">
        @if($advice)
        <div class="insight-card" style="background:var(--ck-primary)">
            <div class="insight-header">
                <span class="material-symbols-outlined">lightbulb</span>
                Langkah Pertama Minggu Ini
            </div>
            <p class="insight-text">{{ $advice }}</p>
        </div>
        @endif
        @if($growth)
        <div class="insight-card" style="background:var(--ck-secondary)">
            <div class="insight-header">
                <span class="material-symbols-outlined">rocket_launch</span>
                Proyeksi Karir 3-5 Tahun
            </div>
            <p class="insight-text">{{ $growth }}</p>
        </div>
        @endif
    </div>
    @endif

    {{-- DEEP ANALYSIS --}}
    <div class="deep-section-title">Analisis Mendalam</div>
    <div class="deep-analysis">
        <div class="analysis-card">
            <div class="analysis-icon-wrap">
                <span class="material-symbols-outlined">cognition</span>
            </div>
            <h3>Kognitif</h3>
            <p>Tingkat pemrosesan informasi kompleks Anda mendukung peran yang membutuhkan pengambilan keputusan analitis.</p>
        </div>
        <div class="analysis-card">
            <div class="analysis-icon-wrap">
                <span class="material-symbols-outlined">favorite</span>
            </div>
            <h3>EQ</h3>
            <p>Kecerdasan emosional Anda mendukung kemampuan kolaborasi dan resolusi konflik dalam lingkungan profesional.</p>
        </div>
        <div class="analysis-card">
            <div class="analysis-icon-wrap">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <h3>Potensi</h3>
            <p>Profil Anda menunjukkan potensi pertumbuhan yang signifikan menuju posisi senior dalam bidang yang direkomendasikan.</p>
        </div>
    </div>

</div>
@endsection