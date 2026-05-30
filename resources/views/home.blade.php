@extends('layouts.app')

@section('title', 'Cerdas Karir | Professional Career Intelligence')

@push('styles')
<style>
/* ══════════════════════════════
   HERO
══════════════════════════════ */
.hero {
    background: var(--surface-container);
    padding: 3.6rem 64px;
    overflow: hidden;
    position: relative;
}
.hero-inner {
    max-width: 1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}
.hero-badge {
    display: inline-block;
    background: var(--secondary-container);
    color: var(--on-secondary-container);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    padding: 0.3rem 0.8rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
}
.hero h1 {
    font-size: 2.75rem;
    line-height: 1.15;
    color: var(--primary);
    margin-bottom: 1.25rem;
    letter-spacing: -0.02em;
}
.hero p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--on-surface-variant);
    margin-bottom: 2.5rem;
    max-width: 480px;
}
.hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
.btn-primary-hero {
    background: var(--primary);
    color: var(--on-primary);
    font-family: 'Hanken Grotesk', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 16px rgba(24,43,63,0.25);
    transition: all 0.2s;
}
.btn-primary-hero:hover {
    box-shadow: 0 8px 24px rgba(24,43,63,0.35);
    transform: translateY(-1px);
}
.btn-outline-hero {
    background: transparent;
    color: var(--primary);
    font-family: 'Hanken Grotesk', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 1rem 2rem;
    border: 1.5px solid var(--primary);
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s;
}
.btn-outline-hero:hover { background: var(--surface-high); }

/* Hero image side */
.hero-image-wrap {
    position: relative;
}
.hero-image-wrap::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 260px;
    height: 260px;
    background: var(--secondary-container);
    border-radius: 50%;
    opacity: 0.3;
    filter: blur(60px);
    z-index: 0;
}
.hero-img {
    position: relative;
    z-index: 1;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(24,43,63,0.2);
    border: 1px solid rgba(61,99,116,0.15);
}
.hero-img img {
    width: 100%;
    height: 460px;
    object-fit: cover;
    display: block;
}
.hero-stat-badge {
    position: absolute;
    bottom: -20px;
    left: -20px;
    background: var(--surface-lowest);
    padding: 1.25rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(24,43,63,0.15);
    border: 1px solid rgba(61,99,116,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    z-index: 2;
    animation: float 3s ease-in-out infinite;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-6px); }
}
.hero-stat-badge .material-symbols-outlined {
    font-size: 2.5rem;
    color: var(--secondary);
    font-variation-settings: 'FILL' 1, 'wght' 400;
}
.hero-stat-badge .stat-label {
    font-size: 0.75rem;
    color: var(--on-surface-variant);
    letter-spacing: 0.04em;
    font-weight: 600;
}
.hero-stat-badge .stat-value {
    font-family: 'Libre Caslon Text', serif;
    font-size: 1.15rem;
    color: var(--primary);
    font-weight: 700;
}

@media (max-width: 900px) {
    .hero { padding: 3rem 1rem; }
    .hero-inner { grid-template-columns: 1fr; }
    .hero h1 { font-size: 2rem; }
    .hero-image-wrap { display: none; }
}

/* ══════════════════════════════
   HOW IT WORKS
══════════════════════════════ */
.steps-section {
    background: var(--surface-lowest);
    padding: 6rem 64px;
}
.steps-inner { max-width: 1280px; margin: 0 auto; }
.section-title-center {
    text-align: center;
    margin-bottom: 4rem;
}
.section-title-center h2 {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 0.75rem;
}
.section-title-center p {
    font-size: 1rem;
    color: var(--on-surface-variant);
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.6;
}
.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}
.step-card {
    background: var(--surface-low);
    padding: 2.5rem;
    border-radius: 12px;
    border: 1px solid rgba(61,99,116,0.1);
    transition: all 0.3s;
}
.step-card:hover {
    border-color: rgba(61,99,116,0.3);
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(24,43,63,0.08);
}
.step-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
    transition: transform 0.3s;
}
.step-card:hover .step-icon-wrap { transform: scale(1.1); }
.step-icon-wrap.navy   { background: var(--primary); color: var(--on-primary); }
.step-icon-wrap.teal   { background: var(--secondary); color: var(--on-secondary); }
.step-icon-wrap.dark   { background: #32424c; color: #9daeba; }
.step-icon-wrap .material-symbols-outlined { font-size: 1.75rem; }
.step-card h3 {
    font-family: 'Libre Caslon Text', serif;
    font-size: 1.25rem;
    color: var(--primary);
    margin-bottom: 0.75rem;
}
.step-card p {
    font-size: 0.9375rem;
    color: var(--on-surface-variant);
    line-height: 1.65;
}
@media (max-width: 768px) {
    .steps-section { padding: 3rem 1rem; }
    .steps-grid { grid-template-columns: 1fr; }
}

/* ══════════════════════════════
   ARTICLES
══════════════════════════════ */
.articles-section {
    background: var(--surface-low);
    padding: 6rem 64px;
}
.articles-inner { max-width: 1280px; margin: 0 auto; }
.section-header-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 3rem;
    flex-wrap: wrap;
    gap: 1rem;
}
.section-header-row h2 { font-size: 2rem; color: var(--primary); margin-bottom: 0.3rem; }
.section-header-row p  { font-size: 0.9375rem; color: var(--on-surface-variant); }
.see-all-link {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: var(--secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: gap 0.2s;
}
.see-all-link:hover { gap: 0.6rem; text-decoration: underline; }

.articles-bento {
    display: grid;
    grid-template-columns: 7fr 5fr;
    gap: 1.5rem;
}
/* Big feature card */
.article-featured-big {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--outline-variant);
    cursor: pointer;
    height: 560px;
}
.article-featured-big img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
    display: block;
}
.article-featured-big:hover img { transform: scale(1.05); }
.article-featured-big-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(24,43,63,0.92) 0%, rgba(24,43,63,0.2) 50%, transparent 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2rem;
}
.article-cat-badge {
    background: var(--secondary);
    color: var(--on-secondary);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 0.25rem 0.6rem;
    border-radius: 3px;
    display: inline-block;
    margin-bottom: 1rem;
    width: fit-content;
}
.article-featured-big-overlay h3 {
    font-family: 'Libre Caslon Text', serif;
    font-size: 1.75rem;
    color: #fff;
    line-height: 1.25;
    margin-bottom: 0.75rem;
}
.article-featured-big-overlay p {
    font-size: 0.9375rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.55;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Side article cards */
.article-side-list { display: flex; flex-direction: column; gap: 1.5rem; }
.article-side-card {
    background: var(--surface-lowest);
    border-radius: 12px;
    border: 1px solid rgba(61,99,116,0.1);
    display: flex;
    gap: 1.5rem;
    padding: 1.25rem;
    transition: box-shadow 0.2s;
    text-decoration: none;
    flex: 1;
}
.article-side-card:hover { box-shadow: 0 6px 20px rgba(24,43,63,0.1); }
.article-side-img {
    width: 96px;
    height: 96px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}
.article-side-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.article-side-text { flex: 1; }
.article-side-cat {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--secondary);
    margin-bottom: 0.3rem;
    display: block;
}
.article-side-text h4 {
    font-family: 'Libre Caslon Text', serif;
    font-size: 1.1rem;
    color: var(--primary);
    line-height: 1.3;
    margin-bottom: 0.4rem;
}
.article-side-text p {
    font-size: 0.8125rem;
    color: var(--on-surface-variant);
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 900px) {
    .articles-section { padding: 3rem 1rem; }
    .articles-bento { grid-template-columns: 1fr; }
    .article-featured-big { height: 360px; }
}

/* ══════════════════════════════
   WHY / TESTIMONIAL
══════════════════════════════ */
.why-section {
    background: var(--surface-lowest);
    padding: 6rem 64px;
}
.why-inner {
    max-width: 1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
}
.why-left h2 { font-size: 2rem; color: var(--primary); margin-bottom: 2rem; }
.why-features { display: flex; flex-direction: column; gap: 2rem; }
.why-feature { display: flex; gap: 1rem; align-items: flex-start; }
.why-feature-icon {
    color: var(--secondary);
    font-size: 1.75rem;
    flex-shrink: 0;
    margin-top: 2px;
}
.why-feature h4 {
    font-family: 'Hanken Grotesk', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    color: var(--primary);
    margin-bottom: 0.3rem;
}
.why-feature p { font-size: 0.9375rem; color: var(--on-surface-variant); line-height: 1.6; }

/* Testimonial card */
.testimonial-wrap { position: relative; }
.testimonial-card {
    background: var(--primary);
    color: var(--on-primary);
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(24,43,63,0.25);
    position: relative;
    z-index: 1;
}
.testimonial-card .quote-icon {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    font-size: 4rem;
    opacity: 0.15;
    font-family: Georgia, serif;
    line-height: 1;
}
.testimonial-stars { display: flex; gap: 0.2rem; margin-bottom: 1.5rem; color: var(--secondary-fixed); }
.testimonial-stars .material-symbols-outlined {
    font-size: 1.25rem;
    font-variation-settings: 'FILL' 1, 'wght' 400;
}
.testimonial-quote {
    font-family: 'Libre Caslon Text', serif;
    font-size: 1.1rem;
    line-height: 1.7;
    font-style: italic;
    margin-bottom: 2rem;
    opacity: 0.95;
}
.testimonial-author { display: flex; align-items: center; gap: 1rem; }
.testimonial-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.3);
    object-fit: cover;
}
.testimonial-name { font-size: 0.875rem; font-weight: 700; }
.testimonial-role { font-size: 0.75rem; opacity: 0.65; margin-top: 0.15rem; }
/* Decorative border behind card */
.testimonial-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    border: 2px solid rgba(61,99,116,0.2);
    border-radius: 20px;
    transform: translate(16px, 16px);
    z-index: 0;
}

@media (max-width: 900px) {
    .why-section { padding: 3rem 1rem; }
    .why-inner { grid-template-columns: 1fr; gap: 3rem; }
}

/* ══════════════════════════════
   CTA
══════════════════════════════ */
.cta-section {
    background: var(--tertiary);
    padding: 6rem 64px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.cta-section::before {
    content: '';
    position: absolute;
    top: -80px; left: 50%;
    transform: translateX(-50%);
    width: 600px; height: 400px;
    background: radial-gradient(ellipse, rgba(61,99,116,0.4), transparent 70%);
    pointer-events: none;
}
.cta-inner { max-width: 1280px; margin: 0 auto; position: relative; z-index: 1; }
.cta-section h2 {
    font-size: 2.75rem;
    color: var(--on-tertiary);
    margin-bottom: 1.25rem;
    line-height: 1.2;
    letter-spacing: -0.02em;
}
.cta-section p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.75);
    max-width: 560px;
    margin: 0 auto 3rem;
    line-height: 1.65;
}
.btn-cta {
    background: var(--secondary-fixed);
    color: var(--on-secondary-fixed);
    font-family: 'Hanken Grotesk', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 1.2rem 2.5rem;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    transition: all 0.2s;
}
.btn-cta:hover {
    background: #a5ccdf;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .cta-section { padding: 3rem 1rem; }
    .cta-section h2 { font-size: 1.75rem; }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════
     HERO
═══════════════════════════════ --}}
<section class="hero">
    <div class="hero-inner">
        {{-- Left text --}}
        <div>
            <span class="hero-badge">INTELIJEN KARIR #1</span>
            <h1>Tentukan Masa Depan Karirmu dengan Cerdas</h1>
            <p>Navigasi perjalanan profesional Anda dengan analisis berbasis data. Temukan jalur karir yang selaras dengan potensi unik Anda.</p>
            <div class="hero-actions">
                <a href="{{ route('quiz.index') }}" class="btn-primary-hero">Mulai Career Quiz</a>
                @auth
                    <a href="{{ route('bookmark.index') }}" class="btn-outline-hero">Lihat Bookmark</a>
                @else
                    <a href="{{ route('register') }}" class="btn-outline-hero">Daftar Gratis</a>
                @endauth
            </div>
        </div>

        {{-- Right image --}}
        <div class="hero-image-wrap">
            <div class="hero-img">
                <img src="https://i.pinimg.com/736x/a3/c8/2f/a3c82f95f6094393d596c0070c0355c9.jpg"
                     alt="Professional woman in modern office">
            </div>
            <div class="hero-stat-badge">
                <span class="material-symbols-outlined">trending_up</span>
                <div>
                    <div class="stat-label">Potential Growth</div>
                    <div class="stat-value">+85% Score</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════
     HOW IT WORKS
═══════════════════════════════ --}}
<section class="steps-section">
    <div class="steps-inner">
        <div class="section-title-center">
            <h2>Langkah Menuju Kesuksesan</h2>
            <p>Tiga langkah strategis untuk mengubah aspirasi menjadi pencapaian nyata.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-icon-wrap navy">
                    <span class="material-symbols-outlined">psychology</span>
                </div>
                <h3>1. Smart Quiz</h3>
                <p>Algoritma psikometri kami memetakan kekuatan, minat, dan kepribadian kerja Anda dalam 10 menit.</p>
            </div>
            <div class="step-card">
                <div class="step-icon-wrap teal">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
                <h3>2. Deep Analysis</h3>
                <p>Dapatkan laporan komprehensif tentang kecocokan industri dan kompetensi yang perlu Anda kembangkan.</p>
            </div>
            <div class="step-card">
                <div class="step-icon-wrap dark">
                    <span class="material-symbols-outlined">map</span>
                </div>
                <h3>3. Career Roadmap</h3>
                <p>Terima rencana aksi langkah demi langkah untuk mencapai posisi impian Anda dengan target waktu yang jelas.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════
     FEATURED ARTICLES
═══════════════════════════════ --}}
<section class="articles-section">
    <div class="articles-inner">
        <div class="section-header-row">
            <div>
                <h2>Wawasan Karir Terkini</h2>
                <p>Strategi dan tren terbaru dari pakar industri.</p>
            </div>
            <a href="{{ route('articles.index') }}" class="see-all-link">
                Lihat Semua Artikel
                <span class="material-symbols-outlined" style="font-size:1.1rem">arrow_forward</span>
            </a>
        </div>

        <div class="articles-bento">
            {{-- Big featured card --}}
            <a href="{{ $featuredArticle ? route('articles.show', $featuredArticle->slug) : route('articles.index') }}"
               class="article-featured-big" style="text-decoration:none">
                <img src="{{ ($featuredArticle && $featuredArticle->thumbnail)
                    ? Storage::url($featuredArticle->thumbnail)
                    : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&q=80' }}"
                     alt="{{ $featuredArticle?->title ?? 'Featured Article' }}">
                <div class="article-featured-big-overlay">
                    <span class="article-cat-badge">{{ $featuredArticle?->category ?? 'LEADERSHIP' }}</span>
                    <h3>{{ $featuredArticle?->title ?? 'Membangun Kepemimpinan di Era Digital' }}</h3>
                    <p>{{ $featuredArticle?->excerpt ?? 'Bagaimana kecerdasan emosional menjadi kunci utama dalam mengelola tim remote yang efektif.' }}</p>
                </div>
            </a>

            {{-- Side cards --}}
            <div class="article-side-list">
                @php
                    $sideArticles = $recentArticles->take(3);
                    $placeholders = [
                        ['cat'=>'STRATEGY','title'=>'Seni Negosiasi Gaji','excerpt'=>'Tips praktis untuk mendapatkan kompensasi yang layak untuk Anda.','img'=>'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=200&q=80'],
                        ['cat'=>'NETWORKING','title'=>'Pentingnya Personal Branding','excerpt'=>'Membangun profil LinkedIn yang menarik perhatian recruiter global.','img'=>'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=200&q=80'],
                        ['cat'=>'SKILLS','title'=>'Belajar Tech-Stack 2024','excerpt'=>'Daftar skill teknologi yang paling dicari oleh startup unicorn tahun ini.','img'=>'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=200&q=80'],
                    ];
                @endphp

                @if($sideArticles->count() > 0)
                    @foreach($sideArticles as $i => $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="article-side-card">
                        <div class="article-side-img">
                            <img src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : ($placeholders[$i]['img'] ?? 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=200&q=80') }}"
                                 alt="{{ $article->title }}">
                        </div>
                        <div class="article-side-text">
                            <span class="article-side-cat">{{ $article->category }}</span>
                            <h4>{{ $article->title }}</h4>
                            <p>{{ $article->excerpt }}</p>
                        </div>
                    </a>
                    @endforeach
                @else
                    @foreach($placeholders as $ph)
                    <a href="{{ route('articles.index') }}" class="article-side-card">
                        <div class="article-side-img">
                            <img src="{{ $ph['img'] }}" alt="{{ $ph['title'] }}">
                        </div>
                        <div class="article-side-text">
                            <span class="article-side-cat">{{ $ph['cat'] }}</span>
                            <h4>{{ $ph['title'] }}</h4>
                            <p>{{ $ph['excerpt'] }}</p>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════
     WHY / TESTIMONIAL
═══════════════════════════════ --}}
<section class="why-section">
    <div class="why-inner">
        {{-- Left: features --}}
        <div class="why-left">
            <h2>Mengapa Profesional Memilih Cerdas Karir?</h2>
            <div class="why-features">
                <div class="why-feature">
                    <span class="material-symbols-outlined why-feature-icon">verified</span>
                    <div>
                        <h4>100% Gratis untuk Semua Pengguna</h4>
                        <p>Semua fitur mulai dari tes kepribadian, analisis karir, hingga roadmap bisa digunakan tanpa biaya.</p>
                    </div>
                </div>
                <div class="why-feature">
                    <span class="material-symbols-outlined why-feature-icon">groups</span>
                    <div>
                        <h4>Rekomendasi Karir yang Disesuaikan</h4>
                        <p>Hasil rekomendasi pekerjaan dan kepribadian disesuaikan dengan jawaban kuis serta pengaturan yang telah ditentukan untuk memberikan hasil yang relevan.</p>
                    </div>
                </div>
                <div class="why-feature">
                    <span class="material-symbols-outlined why-feature-icon">update</span>
                    <div>
                        <h4>Roadmap Karir yang Terarah</h4>
                        <p>Kamu mendapatkan panduan langkah demi langkah untuk mengembangkan karir sesuai potensi dirimu.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: testimonial --}}
        <div class="testimonial-wrap">
            <div class="testimonial-card">
                <div class="quote-icon">"</div>
                <div class="testimonial-stars">
                    @for($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined">star</span>
                    @endfor
                </div>
                <p class="testimonial-quote">
                    "Cerdas Karir membantu saya menyadari bahwa saya lebih cocok di bidang Product Management daripada Engineering. Transisi karir saya jadi jauh lebih terarah dan percaya diri."
                </p>
                <div class="testimonial-author">
                    <img class="testimonial-avatar"
                         src="https://i.pinimg.com/736x/44/5b/f7/445bf76f1656e97480b18fbd0f280d92.jpg"
                         alt="Amanda Putri">
                    <div>
                        <div class="testimonial-name">Amanda Putri</div>
                        <div class="testimonial-role">Senior Product Manager @ Fintech</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════
     CTA
═══════════════════════════════ --}}
<section class="cta-section">
    <div class="cta-inner">
        <h2>Siap Mengakselerasi Karir Anda?</h2>
        <p>Gabung dengan 50,000+ profesional lainnya yang telah menemukan jalur karir terbaik mereka bersama Cerdas Karir.</p>
        <a href="{{ route('quiz.index') }}" class="btn-cta">Mulai Quiz Sekarang (Gratis)</a>
    </div>
</section>

@endsection