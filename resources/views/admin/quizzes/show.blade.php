@extends('layouts.admin')

@section('title', 'Detail Quiz')

@section('content')
<div class="topbar">
    <h1>{{ $quiz->title }}</h1>
    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline"
        style="background:white;border-color:#ddd;color:#666">← Kembali</a>
</div>

<div class="card" style="margin-bottom:1.5rem">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem">
        <div><div style="font-size:0.75rem;color:#888;text-transform:uppercase;font-weight:600;margin-bottom:0.3rem">Kategori</div>{{ $quiz->category }}</div>
        <div><div style="font-size:0.75rem;color:#888;text-transform:uppercase;font-weight:600;margin-bottom:0.3rem">Durasi</div>{{ $quiz->duration_minutes }} menit</div>
        <div><div style="font-size:0.75rem;color:#888;text-transform:uppercase;font-weight:600;margin-bottom:0.3rem">Status</div>
            <span class="badge {{ $quiz->is_active ? 'badge-green' : 'badge-gray' }}">
                {{ $quiz->is_active ? 'Aktif' : 'Non-aktif' }}
            </span>
        </div>
    </div>
    <div style="margin-top:1rem;color:#555;font-size:0.9rem">{{ $quiz->description }}</div>
</div>

<div class="card">
    <h3 style="font-family:'Playfair Display',serif;color:var(--navy);margin-bottom:1rem">
        Daftar Pertanyaan ({{ $quiz->questions->count() }})
    </h3>
    @foreach($quiz->questions as $i => $question)
    <div style="border:1.5px solid #eee;border-radius:10px;padding:1rem;margin-bottom:1rem">
        <div style="font-size:0.75rem;color:var(--teal);font-weight:700;text-transform:uppercase;margin-bottom:0.4rem">
            Q{{ $i+1 }} · {{ $question->category_tag }}
        </div>
        <div style="font-weight:600;color:var(--navy);margin-bottom:0.8rem">{{ $question->question_text }}</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem">
            @foreach($question->options as $opt)
            <div style="background:#f8f9fa;border-radius:6px;padding:0.5rem 0.8rem;font-size:0.85rem">
                <strong>{{ $opt->option_label }}.</strong> {{ $opt->option_text }}
                <span style="color:var(--teal);font-size:0.75rem;margin-left:0.5rem">[{{ $opt->trait_key }}+{{ $opt->score }}]</span>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection