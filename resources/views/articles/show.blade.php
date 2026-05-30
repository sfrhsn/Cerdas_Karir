@extends('layouts.app')

@section('title', $article->title . ' - Cerdas Karir')

@push('styles')
<style>
    .article-detail { max-width: 760px; margin: 3rem auto; padding: 0 2rem; }
    .article-tag { color: var(--teal); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem; display: block; }
    .article-detail h1 { font-size: 2rem; color: var(--navy); line-height: 1.3; margin-bottom: 1rem; }
    .article-meta { display: flex; gap: 1.5rem; font-size: 0.82rem; color: var(--muted); margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--sky); }
    .article-thumbnail { width: 100%; border-radius: 12px; margin-bottom: 2rem; max-height: 400px; object-fit: cover; }
    .article-content { font-size: 1rem; line-height: 1.8; color: #3a4a55; }
    .article-content p { margin-bottom: 1.2rem; }
    .article-content h2 { font-size: 1.4rem; color: var(--navy); margin: 2rem 0 0.8rem; }
    .back-btn { display: inline-block; margin-bottom: 2rem; color: var(--teal); text-decoration: none; font-size: 0.9rem; }
</style>
@endpush

@section('content')
<div class="article-detail">
    <a href="{{ route('articles.index') }}" class="back-btn">← Kembali ke Artikel</a>
    <span class="article-tag">{{ $article->category }} · {{ $article->read_time }} Min Read</span>
    <h1>{{ $article->title }}</h1>
    <div class="article-meta">
        <span>Oleh {{ $article->author->name }}</span>
        <span>{{ $article->created_at->format('d M Y') }}</span>
    </div>
    @if($article->thumbnail)
        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="article-thumbnail">
    @endif
    <div class="article-content">
        {!! nl2br(e($article->content)) !!}
    </div>
</div>
@endsection