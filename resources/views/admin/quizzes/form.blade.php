@extends('layouts.admin')

@section('title', $quiz ? 'Edit Quiz' : 'Tambah Quiz')

@push('styles')
<style>
    .form-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .form-page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--navy);
    }

    /* Tab bar */
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

    /* Form card */
    .form-card {
        background: white;
        border-radius: 14px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        max-width: 700px;
    }

    /* Field styles */
    .field-group { margin-bottom: 1.3rem; }
    .field-label {
        display: block;
        font-size: 0.73rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #888;
        margin-bottom: 0.4rem;
    }
    .field-label .required-star { color: #e74c3c; margin-left: 2px; }

    .field-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
        color: #1a2a35;
    }
    .field-input:focus {
        outline: none;
        border-color: var(--teal);
        box-shadow: 0 0 0 3px rgba(86,124,141,0.1);
    }
    .field-input.is-error { border-color: #e74c3c; }
    .field-input.is-error:focus { box-shadow: 0 0 0 3px rgba(231,76,60,0.1); }

    textarea.field-input { resize: vertical; min-height: 110px; }

    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    /* Error message */
    .field-error {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: #e74c3c;
        font-size: 0.78rem;
        margin-top: 0.4rem;
        font-weight: 500;
    }
    .field-error::before { content: '⚠'; font-size: 0.75rem; }

    /* Error summary (top) */
    .error-summary {
        background: #fff5f5;
        border: 1.5px solid #fca5a5;
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.5rem;
    }
    .error-summary .error-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #e74c3c;
        margin-bottom: 0.5rem;
    }
    .error-summary ul {
        list-style: none;
        padding: 0;
    }
    .error-summary ul li {
        font-size: 0.82rem;
        color: #c0392b;
        padding: 0.15rem 0;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .error-summary ul li::before { content: '→'; font-weight: 700; }

    /* Checkbox */
    .check-group {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
        cursor: pointer;
    }
    .check-group input[type="checkbox"] {
        width: 17px;
        height: 17px;
        accent-color: var(--navy);
        cursor: pointer;
    }
    .check-group span { font-size: 0.9rem; color: #1a2a35; }
    .check-group .check-desc { font-size: 0.78rem; color: #888; margin-top: 0.1rem; }

    /* Submit btn */
    .form-actions { display: flex; gap: 0.8rem; align-items: center; padding-top: 0.5rem; }
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="form-page-header">
    <h1>{{ $quiz ? 'Edit Quiz' : 'Tambah Quiz Baru' }}</h1>
    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline" style="font-size:0.85rem">
        ← Kembali
    </a>
</div>

{{-- TAB BAR (hanya tampil saat edit) --}}
@if($quiz)
<div class="tab-bar">
    <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="active"> Info Quiz</a>
    <a href="{{ route('admin.quizzes.questions', $quiz->id) }}">
         Kelola Soal ({{ $quiz->questions->count() }})
    </a>
    <a href="{{ route('admin.quizzes.show', $quiz->id) }}"> Preview</a>
</div>
@endif

{{-- ERROR SUMMARY --}}
@if($errors->any())
<div class="error-summary">
    <div class="error-title">⚠️ Terdapat {{ $errors->count() }} kesalahan, silakan perbaiki:</div>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- FORM CARD --}}
<div class="form-card">
    <form method="POST"
          action="{{ $quiz ? route('admin.quizzes.update', $quiz->id) : route('admin.quizzes.store') }}">
        @csrf
        @if($quiz) @method('PUT') @endif

        {{-- Judul --}}
        <div class="field-group">
            <label class="field-label">
                Judul Quiz <span class="required-star">*</span>
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $quiz?->title) }}"
                placeholder="contoh: Teknologi & Inovasi"
                class="field-input {{ $errors->has('title') ? 'is-error' : '' }}"
                required>
            @error('title')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori & Durasi --}}
        <div class="field-row">
            <div class="field-group">
                <label class="field-label">
                    Kategori <span class="required-star">*</span>
                </label>
                <select
                    name="category"
                    class="field-input {{ $errors->has('category') ? 'is-error' : '' }}"
                    required>
                    @foreach(['Teknologi','Industri Kreatif','Layanan Kesehatan','Keuangan & Bisnis','Pendidikan & Sosial'] as $cat)
                        <option value="{{ $cat }}"
                            {{ old('category', $quiz?->category) === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label class="field-label">
                    Durasi (menit) <span class="required-star">*</span>
                </label>
                <input
                    type="number"
                    name="duration_minutes"
                    value="{{ old('duration_minutes', $quiz?->duration_minutes ?? 10) }}"
                    min="1" max="120"
                    placeholder="10"
                    class="field-input {{ $errors->has('duration_minutes') ? 'is-error' : '' }}"
                    required>
                @error('duration_minutes')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="field-group">
            <label class="field-label">
                Deskripsi <span class="required-star">*</span>
            </label>
            <textarea
                name="description"
                placeholder="Jelaskan topik dan tujuan quiz ini secara singkat..."
                class="field-input {{ $errors->has('description') ? 'is-error' : '' }}"
                required>{{ old('description', $quiz?->description) }}</textarea>
            @error('description')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Aktifkan Quiz --}}
        <label class="check-group">
            <input type="checkbox" name="is_active" value="1"
                {{ old('is_active', $quiz?->is_active ?? true) ? 'checked' : '' }}>
            <div>
                <span>Aktifkan Quiz</span>
                <div class="check-desc">Quiz aktif akan tampil di halaman publik untuk dijawab pengguna.</div>
            </div>
        </label>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn btn-primary" style="padding:0.7rem 2rem;font-size:0.95rem">
                {{ $quiz ? ' Perbarui Quiz' : '✚ Simpan Quiz' }}
            </button>
            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>

@endsection