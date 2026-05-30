@extends('layouts.app')

@section('title', 'My Roadmap - Cerdas Karir')

@push('styles')
<style>
    .roadmap-container { max-width: 1000px; margin: 2rem auto; padding: 0 2rem; display: grid; grid-template-columns: 260px 1fr; gap: 2rem; }
    
    /* SIDEBAR */
    .roadmap-sidebar { display: flex; flex-direction: column; gap: 1.2rem; }
    .sidebar-card { background: white; border-radius: 14px; padding: 1.5rem; }
    .sidebar-card h3 { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--teal); font-weight: 700; margin-bottom: 1rem; }
    .progress-rank { font-size: 0.8rem; color: var(--muted); margin-bottom: 0.4rem; display: flex; justify-content: space-between; }
    .progress-track { height: 6px; background: var(--sky); border-radius: 3px; margin-bottom: 1rem; }
    .progress-fill { height: 100%; background: var(--navy); border-radius: 3px; transition: width 0.8s ease; }
    .stat-row { display: flex; gap: 1.5rem; }
    .stat-item { text-align: center; }
    .stat-num { font-size: 1.8rem; font-family: 'Playfair Display', serif; color: var(--navy); font-weight: 700; }
    .stat-label { font-size: 0.75rem; color: var(--muted); }
    .tag-list { display: flex; gap: 0.4rem; flex-wrap: wrap; }
    .skill-tag { background: var(--sky); color: var(--navy); font-size: 0.75rem; padding: 0.25rem 0.6rem; border-radius: 20px; font-weight: 600; }
    .saved-article { padding: 0.7rem 0; border-bottom: 1px solid var(--sky); font-size: 0.85rem; color: var(--navy); }
    .saved-article:last-child { border-bottom: none; }
    .saved-article .read-time { font-size: 0.75rem; color: var(--muted); display: block; margin-top: 0.1rem; }

    /* MAIN */
    .roadmap-main { background: white; border-radius: 14px; padding: 2rem; }
    .roadmap-main h1 { font-size: 1.8rem; color: var(--navy); margin-bottom: 0.3rem; }
    .roadmap-main .subtitle { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }
    .focus-badge { float: right; font-size: 0.75rem; color: var(--teal); border: 1px solid var(--sky); padding: 0.25rem 0.7rem; border-radius: 20px; margin-top: 0.3rem; }

    /* STEPS */
    .step-list { position: relative; padding-left: 2rem; }
    .step-list::before { content: ''; position: absolute; left: 10px; top: 0; bottom: 0; width: 2px; background: var(--sky); }
    .step-item { position: relative; margin-bottom: 1.5rem; }
    .step-dot { position: absolute; left: -2rem; top: 0.2rem; width: 20px; height: 20px; border-radius: 50%; border: 2px solid var(--sky); background: white; display: flex; align-items: center; justify-content: center; }
    .step-dot.completed { background: var(--navy); border-color: var(--navy); }
    .step-dot.in_progress { background: var(--teal); border-color: var(--teal); }
    .step-dot.completed::after { content: '✓'; color: white; font-size: 0.7rem; font-weight: 700; }
    .step-dot.in_progress::after { content: ''; width: 8px; height: 8px; background: white; border-radius: 50%; }
    .step-card { border: 1.5px solid var(--sky); border-radius: 10px; padding: 1.2rem 1.5rem; transition: all 0.2s; }
    .step-card.in_progress { border-color: var(--teal); background: rgba(86,124,141,0.04); }
    .step-card.completed { opacity: 0.6; }
    .step-card.not_started { opacity: 0.7; }
    .step-title { font-size: 1rem; color: var(--navy); font-weight: 600; margin-bottom: 0.3rem; }
    .step-desc { font-size: 0.85rem; color: var(--muted); margin-bottom: 1rem; line-height: 1.5; }
    .step-badge { float: right; font-size: 0.72rem; padding: 0.2rem 0.6rem; border-radius: 20px; font-weight: 600; }
    .badge-completed { background: #d4edda; color: #155724; }
    .badge-in_progress { background: rgba(86,124,141,0.15); color: var(--teal); }
    .badge-not_started { background: #f0f0f0; color: #888; }
    .step-actions { display: flex; gap: 0.8rem; }
    .back-link { display: inline-block; margin-bottom: 1.5rem; color: var(--teal); text-decoration: none; font-size: 0.9rem; }
</style>
@endpush

@section('content')
<div style="max-width:1000px;margin:1.5rem auto;padding:0 2rem">
    <a href="{{ route('quiz.result', $result->id) }}" class="back-link">← Kembali ke Hasil Quiz</a>
</div>

<div class="roadmap-container">
    <!-- SIDEBAR -->
    <div class="roadmap-sidebar">
        <div class="sidebar-card">
            <h3>My Progress</h3>
            <div class="progress-rank">
                <span>Overall Rank</span>
                <span style="color:var(--navy);font-weight:700">{{ $roadmap->overall_rank }} Pro</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width:{{ $roadmap->steps->count() > 0 ? ($roadmap->steps_done / $roadmap->steps->count()) * 100 : 0 }}%"></div>
            </div>
            <div class="stat-row">
                <div class="stat-item">
                    <div class="stat-num">{{ $roadmap->steps_done }}</div>
                    <div class="stat-label">Steps Done</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">{{ $roadmap->steps->where('status', 'in_progress')->count() }}</div>
                    <div class="stat-label">Active Paths</div>
                </div>
            </div>
        </div>

        <div class="sidebar-card">
            <h3>Recommended Skills</h3>
            <div class="tag-list">
                @foreach($result->key_strengths as $s)
                    <span class="skill-tag">{{ ucfirst($s) }}</span>
                @endforeach
                <span class="skill-tag">Leadership</span>
                <span class="skill-tag">Communication</span>
            </div>
        </div>

        <div class="sidebar-card">
            <h3>Saved Articles</h3>
            <div class="saved-article">
                <a href="{{ route('articles.index') }}" style="text-decoration:none;color:inherit">Menguasai Skill Digital di Era AI</a>
                <span class="read-time">7 min read</span>
            </div>
            <div class="saved-article">
                <a href="{{ route('articles.index') }}" style="text-decoration:none;color:inherit">Soft Skills untuk Karir Senior</a>
                <span class="read-time">5 min read</span>
            </div>
        </div>
    </div>

    <!-- MAIN ROADMAP -->
    <div class="roadmap-main">
        <div>
            <span class="focus-badge"> Current Focus</span>
            <h1>{{ $roadmap->title }}</h1>
            <p class="subtitle">Your tailored path to professional mastery.</p>
        </div>

        <div class="step-list">
            @foreach($roadmap->steps as $step)
            <div class="step-item">
                <div class="step-dot {{ $step->status }}"></div>
                <div class="step-card {{ $step->status }}">
                    <span class="step-badge badge-{{ $step->status }}">
                        {{ $step->status === 'completed' ? 'Completed' : ($step->status === 'in_progress' ? 'In Progress' : 'Upcoming') }}
                    </span>
                    <div class="step-title">{{ $step->title }}</div>
                    <div class="step-desc">{{ $step->description }}</div>

                    @if($step->status === 'in_progress')
                    <div class="step-actions">
                        <form method="POST" action="{{ route('roadmap.step.update', $step->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-primary" style="font-size:0.82rem;padding:0.4rem 1rem">
                                ✓ Tandai Selesai
                            </button>
                        </form>
                        <a href="{{ route('articles.index') }}" class="btn btn-outline" style="font-size:0.82rem;padding:0.4rem 1rem">
                             View Resources
                        </a>
                    </div>
                    @elseif($step->status === 'not_started')
                    <div class="step-actions">
                        <form method="POST" action="{{ route('roadmap.step.update', $step->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="btn btn-outline" style="font-size:0.82rem;padding:0.4rem 1rem">
                                ▶ Mulai Step Ini
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection