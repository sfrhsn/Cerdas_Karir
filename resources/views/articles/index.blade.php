@extends('layouts.app')

@section('title', 'Artikel - Cerdas Karir')

@push('styles')
<style>
    .articles-hero {
        background: var(--beige);
        padding: 3rem 64px;
        text-align: center;
        border-bottom: 1px solid var(--sky);
    }

    .articles-hero .badge {
        display: inline-block;
        color: var(--teal);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .articles-hero h1 {
        font-size: 2.2rem;
        color: var(--navy);
        margin-bottom: 0.8rem;
    }

    .articles-hero p {
        color: var(--muted);
        max-width: 500px;
        margin: 0 auto 1.5rem;
    }

    .search-bar {
        display: flex;
        gap: 0.5rem;
        max-width: 350px;
        margin: 0 auto;
    }

    .search-bar input {
        flex: 1;
        padding: 0.7rem 1rem;
        border: 1.5px solid var(--sky);
        border-radius: 8px;
        font-size: 0.9rem;
        background: white;
    }

    .filter-bar {
        display: flex;
        gap: 0.6rem;
        padding: 1.2rem 64px;
        background: white;
        border-bottom: 1px solid var(--sky);
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-label {
        font-size: 0.8rem;
        color: var(--muted);
        font-weight: 600;
    }

    .filter-chip {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.82rem;
        border: 1.5px solid var(--sky);
        color: var(--teal);
        background: white;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .filter-chip.active,
    .filter-chip:hover {
        background: var(--navy);
        color: white;
        border-color: var(--navy);
    }

    /* MAIN LAYOUT */
    .articles-body {
        max-width: 1280px;
        margin: 2rem auto;
        padding: 0 64px;
        box-sizing: border-box;
    }

    /* ROW 1 */
    .articles-top {
        display: grid;
        grid-template-columns: 86fr 42fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        align-items: stretch;
        min-height: 340px;
    }

    .featured-article {
        display: grid;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        min-height: 320px;
        border: 1px solid rgba(61,99,116,0.12);
        display: flex;
        flex-direction: column;
    }

    .featured-article img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;    
    }

    .featured-article-body {
        padding: 2rem;
        min-height: 260px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .featured-badge {
        background: var(--navy);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 0.8rem;
        width: fit-content;
    }

    .sidebar-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-widget {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .sidebar-widget h3 {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
    }

    .sidebar-widget.cta {
        background: var(--navy);
        color: white;
        min-height: 460px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .sidebar-widget.cta h3 {
        color: white;
        font-size: 1.5rem;
        line-height: 1.3;

    }

    .sidebar-widget.cta p {
        font-size: 0.85rem;
        opacity: 0.8;
        margin-bottom: 1rem;
    }

    .cta-btn {
        background: white;
        color: var(--navy);
        text-decoration: none;
        padding: 0.8rem 1.2rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: fit-content; /* biar ga kepanjangan */
        min-width: 160px;   /* optional */
        transition: all 0.2s;
        margin-top: 1.5rem;
    }

    .cta-btn:hover {
        transform: translateY(-2px);
    }

    .popular-tag {
        display: inline-block;
        background: var(--sky);
        color: var(--teal);
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        font-size: 0.8rem;
        margin: 0.3rem;
        font-weight: 600;
    }

    /* ROW REST */
    .article-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .article-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .article-card:hover {
        box-shadow: 0 8px 25px rgba(47,65,86,0.1);
    }

    .article-card img {
        width: 100%;
        height: 210px;
        object-fit: cover;
    }

    .article-card-body {
        padding: 1.2rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .article-card-body .tag {
        font-size: 0.72rem;
        text-transform: uppercase;
        color: var(--teal);
        font-weight: 700;
        letter-spacing: 0.08em;
        margin-bottom: 0.5rem;
    }

    .article-card-body h3 {
        font-size: 1.15rem;
        color: var(--navy);
        margin-bottom: 0.7rem;
        line-height: 1.4;
    }

    .article-card-body p {
        font-size: 0.86rem;
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .pagination-wrap {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .page-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--sky);
        font-size: 0.85rem;
        color: var(--teal);
        text-decoration: none;
    }

    .page-btn.active {
        background: var(--navy);
        color: white;
        border-color: var(--navy);
    }

    @media(max-width: 900px) {
        .articles-top {
            grid-template-columns: 1fr;
        }

        .article-grid {
            grid-template-columns: 1fr 1fr;
        }

        .featured-article {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .article-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<div class="articles-hero">
    <div class="badge">KNOWLEDGE HUB</div>
    <h1>Wawasan Karir & Tips Profesional</h1>
    <p>Akselerasi pertumbuhan profesional Anda dengan panduan mendalam, tren industri terkini, dan strategi praktis dari para ahli karir.</p>

    <form action="{{ route('articles.index') }}" method="GET">
        <div class="search-bar">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
</div>

<div class="filter-bar">
    <span class="filter-label">Filter:</span>

    @foreach(['All Topics', 'CV Writing', 'Interview Tips', 'Industry Trends', 'Work-Life Balance', 'Networking'] as $cat)
        <a href="{{ route('articles.index', ['category' => $cat]) }}"
           class="filter-chip {{ ($category ?? 'All Topics') === $cat ? 'active' : '' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>

<div class="articles-body">

    {{-- ROW 1 --}}
    <div class="articles-top">

        @if($featured)
        <div class="featured-article">
            <div class="featured-image-wrap">
                <img src="{{ $featured->thumbnail ? Storage::url($featured->thumbnail) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600&q=80' }}">
            </div>

            <div class="featured-article-body">
                <span class="featured-badge">FEATURED</span>

                <div style="font-size:0.8rem;color:var(--teal);margin-bottom:0.5rem">
                    {{ $featured->category }} · {{ $featured->read_time }} Min Read
                </div>

                <h2 style="font-size:2rem;color:var(--navy);margin-bottom:1rem;line-height:1.2">
                    {{ $featured->title }}
                </h2>

                <p style="font-size:0.95rem;color:var(--muted);line-height:1.7;margin-bottom:1rem">
                    {{ $featured->excerpt }}
                </p>

                <a href="{{ route('articles.show', $featured->slug) }}"
                   style="color:var(--navy);font-weight:600;text-decoration:none">
                    Read More →
                </a>
            </div>
        </div>
        @endif

        <div class="sidebar-column">

            <div class="sidebar-widget cta">
                <h3>Ingin Tahu Karir yang Tepat untuk Anda?</h3>

                <p>
                    Temukan jalur karir yang paling sesuai dengan kepribadian dan potensi Anda melalui quiz kami yang dirancang khusus.
                </p>

                <a href="{{ route('quiz.index') }}"
                   class="cta-btn">
                    Coba Sekarang
                </a>
            </div>

            <div class="sidebar-widget">
                <h3>Topik Populer</h3>

                <a href="{{ route('articles.index', ['category' => 'CV Writing']) }}"
                   class="popular-tag">#CvWriting</a>

                <a href="{{ route('articles.index', ['category' => 'Networking']) }}"
                   class="popular-tag">#RemoteWork</a>

                <a href="{{ route('articles.index', ['category' => 'Industry Trends']) }}"
                   class="popular-tag">#TechLayoffs</a>

                <a href="{{ route('articles.index', ['category' => 'Interview Tips']) }}"
                   class="popular-tag">#Leadership</a>
            </div>

        </div>

    </div>

    {{-- ROW REST --}}
    <div class="article-grid">

        @foreach($articles as $article)
        <div class="article-card">

            <img src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&q=80' }}"
                 alt="{{ $article->title }}">

            <div class="article-card-body">

                <div class="tag">{{ $article->category }}</div>

                <h3>{{ $article->title }}</h3>

                <p>{{ Str::limit($article->excerpt, 100) }}</p>

                <a href="{{ route('articles.show', $article->slug) }}"
                   style="color:var(--teal);font-size:0.82rem;text-decoration:none;font-weight:600">
                    Read More →
                </a>

            </div>

        </div>
        @endforeach

    </div>

    @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="pagination-wrap">

        @if($articles->onFirstPage())
            <span class="page-btn">‹</span>
        @else
            <a href="{{ $articles->previousPageUrl() }}" class="page-btn">‹</a>
        @endif

        @for($i = 1; $i <= $articles->lastPage(); $i++)
            <a href="{{ $articles->url($i) }}"
               class="page-btn {{ $articles->currentPage() == $i ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor

        @if($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}" class="page-btn">›</a>
        @else
            <span class="page-btn">›</span>
        @endif

    </div>
    @endif

</div>
@endsection