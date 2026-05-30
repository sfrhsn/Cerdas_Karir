@extends('layouts.admin')

@section('title', $article ? 'Edit Artikel' : 'Tambah Artikel')

@push('styles')
<style>
    .ai-box {
        background: linear-gradient(135deg, var(--navy), var(--teal));
        border-radius: 14px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
    }
    .ai-box-title {
        font-size: 0.88rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .ai-box-form {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }
    .ai-field { flex: 2; min-width: 200px; }
    .ai-field-sm { flex: 1; min-width: 150px; }
    .ai-label {
        font-size: 0.72rem;
        opacity: 0.7;
        display: block;
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .ai-input {
        width: 100%;
        padding: 0.65rem 1rem;
        border-radius: 8px;
        border: none;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        color: #1a2a35;
    }
    .ai-select {
        width: 100%;
        padding: 0.65rem 1rem;
        border-radius: 8px;
        border: none;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        color: #1a2a35;
        background: white;
    }
    .ai-btn {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1.5px solid rgba(255,255,255,0.4);
        padding: 0.65rem 1.3rem;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .ai-btn:hover { background: rgba(255,255,255,0.3); }
    .ai-btn.loading { opacity: 0.7; cursor: not-allowed; }

    .form-card {
        background: white;
        border-radius: 14px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        max-width: 820px;
    }
    .field-group { margin-bottom: 1.2rem; }
    .field-label {
        display: block;
        font-size: 0.73rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #888;
        margin-bottom: 0.4rem;
    }
    .field-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s;
        background: white;
    }
    .field-input:focus { outline: none; border-color: var(--teal); }
    textarea.field-input { resize: vertical; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .check-row { display: flex; gap: 1.5rem; margin-bottom: 1.5rem; }
    .check-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .check-item input { accent-color: var(--navy); width: 16px; height: 16px; }
    .form-actions { display: flex; gap: 0.8rem; align-items: center; }
    .ai-generated-notice {
        background: #d4edda;
        color: #155724;
        padding: 0.7rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .error-msg {
        background: #fff5f5;
        border: 1px solid #fca5a5;
        color: #c0392b;
        padding: 0.7rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')

<div class="topbar">
    <h1>{{ $article ? 'Edit Artikel' : 'Tambah Artikel' }}</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">← Kembali</a>
</div>

{{-- AI GENERATE BOX (hanya tampil di halaman create) --}}
@if(!$article)
<div class="ai-box" style="max-width:820px">
    <div class="ai-box-title">✨ Generate Konten Artikel dengan AI (Gratis)</div>
    <p style="font-size:0.82rem;opacity:0.8;margin-bottom:1rem">
        Masukkan judul dan kategori, AI akan menulis konten artikel secara otomatis. Kamu tetap bisa edit setelahnya.
    </p>
    <form method="POST" action="{{ route('admin.articles.generate-ai') }}" id="ai-form">
        @csrf
        <div class="ai-box-form">
            <div class="ai-field">
                <label class="ai-label">Judul Artikel</label>
                <input type="text" name="title" class="ai-input"
                    placeholder="contoh: 5 Skill AI yang Wajib Dikuasai Profesional di 2025"
                    value="{{ old('title') }}" required>
            </div>
            <div class="ai-field-sm">
                <label class="ai-label">Kategori</label>
                <select name="category" class="ai-select">
                    @foreach(['CV Writing','Interview Tips','Industry Trends','Work-Life Balance','Networking','Professional Growth'] as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="ai-btn" id="ai-submit-btn">
                <span id="ai-btn-text">🤖 Generate</span>
            </button>
        </div>
    </form>
</div>
@endif

{{-- NOTIFIKASI AI GENERATED --}}
@if(session('ai_generated'))
    <div class="ai-generated-notice" style="max-width:820px">
        ✅ Konten artikel berhasil di-generate oleh AI! Periksa dan edit sebelum menyimpan.
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if(session('error'))
    <div class="error-msg" style="max-width:820px">⚠️ {{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="error-msg" style="max-width:820px">
        @foreach($errors->all() as $e)<div>→ {{ $e }}</div>@endforeach
    </div>
@endif

{{-- MAIN FORM --}}
<div class="form-card">
    <form method="POST"
          action="{{ $article ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($article) @method('PUT') @endif

        <div class="field-row">
            <div class="field-group" style="grid-column: 1 / -1">
                <label class="field-label">Judul <span style="color:#e74c3c">*</span></label>
                <input type="text" name="title" class="field-input"
                    value="{{ old('title', session('ai_generated.title', $article?->title)) }}"
                    placeholder="Judul artikel..." required>
            </div>
        </div>

        <div class="field-row">
            <div class="field-group">
                <label class="field-label">Kategori <span style="color:#e74c3c">*</span></label>
                <select name="category" class="field-input" required>
                    @foreach(['CV Writing','Interview Tips','Industry Trends','Work-Life Balance','Networking','Professional Growth'] as $cat)
                        <option value="{{ $cat }}"
                            {{ old('category', session('ai_generated.category', $article?->category)) === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="field-group">
                <label class="field-label">Waktu Baca (menit) <span style="color:#e74c3c">*</span></label>
                <input type="number" name="read_time" class="field-input"
                    value="{{ old('read_time', session('ai_generated.read_time', $article?->read_time ?? 5)) }}"
                    min="1" max="60" required>
            </div>
        </div>

        <div class="field-group">
            <label class="field-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="field-input" accept="image/*">
        </div>

        <div class="field-group">
            <label class="field-label">Excerpt / Ringkasan <span style="color:#e74c3c">*</span></label>
            <textarea name="excerpt" class="field-input" rows="3"
                placeholder="Ringkasan singkat yang menarik..." required>{{ old('excerpt', session('ai_generated.excerpt', $article?->excerpt)) }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label">Konten Artikel <span style="color:#e74c3c">*</span></label>
            <textarea name="content" class="field-input" rows="18"
                placeholder="Tulis konten artikel di sini..." required>{{ old('content', session('ai_generated.content', $article?->content)) }}</textarea>
        </div>

        <div class="check-row">
            <label class="check-item">
                <input type="checkbox" name="is_published" value="1"
                    {{ old('is_published', $article?->is_published) ? 'checked' : '' }}>
                Published (tampil di website)
            </label>
            <label class="check-item">
                <input type="checkbox" name="is_featured" value="1"
                    {{ old('is_featured', $article?->is_featured) ? 'checked' : '' }}>
                Featured (tampil di halaman utama)
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" style="padding:0.7rem 2rem;font-size:0.95rem">
                {{ $article ? ' Perbarui Artikel' : '✚ Simpan Artikel' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Loading state saat AI generate
    document.getElementById('ai-form')?.addEventListener('submit', function() {
        const btn  = document.getElementById('ai-submit-btn');
        const text = document.getElementById('ai-btn-text');
        btn.classList.add('loading');
        btn.disabled = true;
        text.textContent = '⏳ Generating...';
    });
</script>
@endpush

@endsection