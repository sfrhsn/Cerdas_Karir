@extends('layouts.admin')

@section('title', 'Kelola Soal - ' . $quiz->title)

@push('styles')
<style>
    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--navy);
        margin-bottom: 0.2rem;
    }
    .page-meta { font-size: 0.82rem; color: #888; }

    /* ── TABS ── */
    .tab-bar {
        display: flex;
        border-bottom: 2px solid #e8ecf0;
        margin-bottom: 1.8rem;
    }
    .tab-bar a {
        padding: 0.65rem 1.3rem;
        font-size: 0.88rem;
        font-weight: 500;
        color: #888;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .tab-bar a:hover { color: var(--navy); }
    .tab-bar a.active { color: var(--navy); border-bottom-color: var(--navy); font-weight: 600; }

    /* ── ADD QUESTION BOX ── */
    .add-q-box {
        background: white;
        border-radius: 14px;
        border: 2px dashed var(--sky);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .add-q-box h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .add-q-box textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        resize: vertical;
        min-height: 80px;
        margin-bottom: 0.8rem;
        transition: border-color 0.2s;
    }
    .add-q-box textarea:focus { outline: none; border-color: var(--teal); }
    .add-q-box input[type="text"] {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        font-size: 0.88rem;
        font-family: 'DM Sans', sans-serif;
        margin-bottom: 1rem;
        transition: border-color 0.2s;
    }
    .add-q-box input[type="text"]:focus { outline: none; border-color: var(--teal); }
    .add-q-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    .trait-pills { display: flex; gap: 0.4rem; flex-wrap: wrap; align-items: center; }
    .trait-pill {
        font-size: 0.72rem;
        background: #eef2f6;
        color: var(--navy);
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-weight: 500;
    }

    /* ── QUESTION CARD ── */
    .q-card {
        background: white;
        border-radius: 14px;
        border: 1.5px solid #e8ecf0;
        margin-bottom: 1.5rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .q-card-head {
        background: #f8fafc;
        padding: 1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        border-bottom: 1.5px solid #e8ecf0;
    }
    .q-num-badge {
        width: 30px;
        height: 30px;
        background: var(--navy);
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .q-head-info { flex: 1; min-width: 0; }
    .q-head-info .q-title {
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--navy);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .q-head-info .q-tag {
        font-size: 0.75rem;
        color: var(--teal);
        font-weight: 500;
        margin-top: 0.1rem;
    }
    .btn-del-q {
        background: white;
        color: #e74c3c;
        border: 1.5px solid #e74c3c;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        flex-shrink: 0;
        transition: all 0.2s;
    }
    .btn-del-q:hover { background: #e74c3c; color: white; }

    .q-card-body { padding: 1.4rem 1.4rem 1rem; }

    /* Edit teks soal */
    .field-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #888;
        display: block;
        margin-bottom: 0.4rem;
    }
    .q-text-row {
        display: grid;
        grid-template-columns: 1fr 210px;
        gap: 0.8rem;
        margin-bottom: 1.3rem;
    }
    .q-text-row textarea,
    .q-text-row input[type="text"] {
        width: 100%;
        padding: 0.65rem 0.9rem;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        font-size: 0.88rem;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s;
    }
    .q-text-row textarea { resize: vertical; min-height: 54px; }
    .q-text-row textarea:focus,
    .q-text-row input:focus { outline: none; border-color: var(--teal); }

    /* Opsi grid */
    .opts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.9rem;
        margin-bottom: 1.1rem;
    }
    .opt-box {
        border: 1.5px solid #e8ecf0;
        border-radius: 10px;
        padding: 0.9rem;
        background: #fafcfe;
        transition: border-color 0.2s;
    }
    .opt-box:focus-within { border-color: var(--sky); }
    .opt-label-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        background: var(--teal);
        color: white;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
    }
    .opt-box textarea {
        width: 100%;
        padding: 0.5rem 0.7rem;
        border: 1.5px solid #e0e0e0;
        border-radius: 6px;
        font-size: 0.84rem;
        font-family: 'DM Sans', sans-serif;
        resize: vertical;
        min-height: 52px;
        margin-bottom: 0.6rem;
        transition: border-color 0.2s;
        background: white;
    }
    .opt-box textarea:focus { outline: none; border-color: var(--teal); }
    .opt-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .opt-meta-label { font-size: 0.72rem; color: #888; white-space: nowrap; }
    .opt-meta select,
    .opt-meta input[type="number"] {
        padding: 0.35rem 0.5rem;
        border: 1.5px solid #ddd;
        border-radius: 6px;
        font-size: 0.82rem;
        font-family: 'DM Sans', sans-serif;
        background: white;
    }
    .opt-meta select:focus,
    .opt-meta input[type="number"]:focus { outline: none; border-color: var(--teal); }
    .opt-meta input[type="number"] { width: 60px; }

    /* Footer kartu */
    .q-card-foot {
        display: flex;
        justify-content: flex-end;
        padding: 0.8rem 1.4rem 1.2rem;
        border-top: 1px solid #f0f0f0;
    }
    .btn-save-q {
        background: var(--navy);
        color: white;
        border: none;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        font-size: 0.87rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .btn-save-q:hover { background: var(--teal); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #aaa;
        background: white;
        border-radius: 14px;
        border: 1.5px dashed #ddd;
    }
    .empty-state .empty-icon { font-size: 2.5rem; margin-bottom: 0.8rem; }
    .empty-state p { font-size: 0.9rem; }

    /* Info box */
    .info-box {
        background: rgba(200,217,230,0.2);
        border: 1px solid var(--sky);
        border-radius: 10px;
        padding: 1rem 1.3rem;
        font-size: 0.82rem;
        color: var(--navy);
        margin-top: 1.5rem;
        line-height: 1.7;
    }
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="page-header">
    <div>
        <h1>{{ $quiz->title }}</h1>
        <div class="page-meta">
            {{ $quiz->category }}
            &middot; {{ $quiz->duration_minutes }} menit
            &middot; <strong>{{ $quiz->questions->count() }}</strong> soal
        </div>
    </div>
    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline" style="font-size:0.85rem">
        ← Kembali
    </a>
</div>

{{-- TAB BAR --}}
<div class="tab-bar">
    <a href="{{ route('admin.quizzes.edit', $quiz->id) }}"> Info Quiz</a>
    <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="active"> Kelola Soal</a>
    <a href="{{ route('admin.quizzes.show', $quiz->id) }}"> Preview</a>
</div>

{{-- ═══════════════════════════════
     FORM TAMBAH SOAL BARU
═══════════════════════════════ --}}
<div class="add-q-box">
    <h3>➕ Tambah Pertanyaan Baru</h3>
    <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz->id) }}">
        @csrf
        <textarea
            name="question_text"
            placeholder="Tulis pertanyaan di sini...&#10;Contoh: Bagaimana pendekatan Anda dalam memecahkan masalah kompleks?"
            required></textarea>
        <input
            type="text"
            name="category_tag"
            placeholder="Tag kategori (opsional) — contoh: Technical Capability, EQ, Leadership">
        <div class="add-q-footer">
            <div class="trait-pills">
                <span style="font-size:0.72rem;color:#888;margin-right:0.3rem">Trait tersedia:</span>
                @foreach(['strategic','technical','analytical','creative','leadership','empathy'] as $t)
                    <span class="trait-pill">{{ $t }}</span>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">+ Tambah Soal</button>
        </div>
    </form>
</div>

{{-- ═══════════════════════════════
     DAFTAR SOAL
═══════════════════════════════ --}}
@if($quiz->questions->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">📋</div>
        <p>Belum ada soal. Gunakan form di atas untuk menambahkan pertanyaan pertama.</p>
    </div>
@else
    @foreach($quiz->questions as $q)
    <div class="q-card">

        {{-- Header kartu soal --}}
        <div class="q-card-head">
            <div class="q-num-badge">{{ $loop->iteration }}</div>
            <div class="q-head-info">
                <div class="q-title">{{ $q->question_text }}</div>
                @if($q->category_tag)
                    <div class="q-tag">{{ $q->category_tag }}</div>
                @endif
            </div>
            <form method="POST"
                  action="{{ route('admin.quizzes.questions.destroy', $q->id) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn-del-q"
                    onclick="return confirm('Hapus soal ini beserta semua opsinya?')">
                    🗑 Hapus
                </button>
            </form>
        </div>

        {{-- Body: form edit soal + opsi --}}
        <div class="q-card-body">
            <form method="POST"
                  action="{{ route('admin.quizzes.options.store', $q->id) }}">
                @csrf

                {{-- Edit teks soal --}}
                <label class="field-label">Teks Pertanyaan</label>
                <div class="q-text-row">
                    <textarea name="question_text"
                              rows="2">{{ $q->question_text }}</textarea>
                    <input type="text"
                           name="category_tag"
                           value="{{ $q->category_tag }}"
                           placeholder="Tag (e.g. EQ, Technical)">
                </div>

                {{-- Opsi jawaban --}}
                <label class="field-label">Opsi Jawaban</label>
                <div class="opts-grid">
                    @foreach($q->options as $opt)
                    <div class="opt-box">
                        <input type="hidden"
                               name="options[{{ $loop->index }}][id]"
                               value="{{ $opt->id }}">
                        <div class="opt-label-badge">{{ $opt->option_label }}</div>
                        <textarea
                            name="options[{{ $loop->index }}][option_text]"
                            placeholder="Teks opsi {{ $opt->option_label }}..."
                            rows="2">{{ $opt->option_text }}</textarea>
                        <div class="opt-meta">
                            <span class="opt-meta-label">Trait:</span>
                            <select name="options[{{ $loop->index }}][trait_key]">
                                @foreach(['strategic','technical','analytical','creative','leadership','empathy'] as $trait)
                                    <option value="{{ $trait }}"
                                        {{ $opt->trait_key === $trait ? 'selected' : '' }}>
                                        {{ ucfirst($trait) }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="opt-meta-label" style="margin-left:0.3rem">Skor:</span>
                            <input type="number"
                                   name="options[{{ $loop->index }}][score]"
                                   value="{{ $opt->score }}"
                                   min="0" max="10">
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>

        {{-- Footer kartu --}}
        <div class="q-card-foot">
            <button type="submit" class="btn-save-q">Simpan Soal Ini</button>
        </div>
        </form>

    </div>
    @endforeach
@endif

{{-- Panduan --}}
<div class="info-box">
    <strong>💡 Panduan Skor & Trait:</strong>
    Setiap opsi memiliki <em>trait</em> dan <em>skor</em> (0–10).
    Skor per trait dijumlah; trait tertinggi menentukan rekomendasi posisi karir.<br>
    <strong>Mapping trait → posisi:</strong>
    strategic → Senior Product Manager &bull;
    technical → Senior Software Engineer &bull;
    analytical → Data Analyst &bull;
    creative → Creative Director &bull;
    leadership → Team Lead/Manager &bull;
    empathy → HR Business Partner
</div>

@endsection