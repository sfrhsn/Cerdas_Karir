@extends('layouts.app')

@section('title', $quiz->title . ' - Cerdas Karir')

@push('styles')
<style>
    .quiz-container { max-width: 700px; margin: 0 auto; padding: 2rem; }
    .quiz-progress-bar { height: 4px; background: var(--sky); border-radius: 2px; margin-bottom: 2rem; }
    .quiz-progress-fill { height: 100%; background: var(--navy); border-radius: 2px; transition: width 0.4s ease; }
    .quiz-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; font-size: 0.85rem; color: var(--muted); }
    .question-card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(47,65,86,0.08); margin-bottom: 1.5rem; }
    .question-tag { display: inline-block; background: var(--sky); color: var(--teal); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.25rem 0.7rem; border-radius: 20px; margin-bottom: 0.8rem; }
    .question-number { font-size: 0.9rem; color: var(--muted); margin-bottom: 0.5rem; }
    .question-text { font-size: 1.2rem; color: var(--navy); font-weight: 600; line-height: 1.5; margin-bottom: 1.5rem; }
    .option-item { border: 1.5px solid var(--sky); border-radius: 10px; padding: 1rem 1.2rem; margin-bottom: 0.8rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 1rem; }
    .option-item:hover { border-color: var(--teal); background: rgba(86,124,141,0.05); }
    .option-item input[type="radio"] { display: none; }
    .option-item.selected { border-color: var(--navy); background: rgba(47,65,86,0.05); }
    .option-label { width: 28px; height: 28px; border: 1.5px solid var(--sky); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; color: var(--teal); flex-shrink: 0; }
    .option-item.selected .option-label { background: var(--navy); color: white; border-color: var(--navy); }
    .option-text { font-size: 0.9rem; color: var(--text); }
    .quiz-nav { display: flex; justify-content: space-between; align-items: center; }
    .tip-box { background: var(--sky); border-radius: 10px; padding: 1rem 1.2rem; display: flex; align-items: flex-start; gap: 0.8rem; font-size: 0.85rem; color: var(--navy); }
</style>
@endpush

@section('content')
<div class="quiz-container">
    <div class="quiz-header">
        <div>ASSESSMENT IN PROGRESS</div>
        <div id="progress-text">0% Complete</div>
    </div>
    <div class="quiz-progress-bar">
        <div class="quiz-progress-fill" id="progress-fill" style="width:0%"></div>
    </div>

    <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}" id="quiz-form">
        @csrf
        @foreach($quiz->questions as $i => $question)
        <div class="question-card" id="q-{{ $i }}" style="display: {{ $i === 0 ? 'block' : 'none' }}">
            @if($question->category_tag)
            <div class="question-tag">{{ $question->category_tag }}</div>
            @endif
            <div class="question-number">Pertanyaan {{ $i + 1 }} dari {{ $quiz->questions->count() }}</div>
            <div class="question-text">{{ $question->question_text }}</div>

            @foreach($question->options as $option)
            <label class="option-item" id="label-{{ $question->id }}-{{ $option->id }}">
                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                    onchange="selectOption({{ $question->id }}, {{ $option->id }})">
                <div class="option-label">{{ $option->option_label }}</div>
                <div class="option-text">{{ $option->option_text }}</div>
            </label>
            @endforeach
        </div>
        @endforeach

        <div class="quiz-nav">
            <button type="button" class="btn btn-outline" onclick="prevQuestion()" id="btn-prev" style="visibility:hidden">← Previous</button>
            <div style="font-size:0.8rem;color:var(--muted)">⊙ Pilihan akan disimpan secara otomatis</div>
            <button type="button" class="btn btn-primary" onclick="nextQuestion()" id="btn-next">Next →</button>
        </div>
    </form>

    <div class="tip-box" style="margin-top:1.5rem">
        <div>👨‍💼</div>
        <div><strong>Tips Karir:</strong> Jawablah dengan jujur sesuai kepribadian Anda untuk mendapatkan hasil analisis yang paling akurat.</div>
    </div>
</div>

@push('scripts')
<script>
    const totalQuestions = {{ $quiz->questions->count() }};
    let current = 0;

    function updateProgress() {
        const percent = Math.round(((current + 1) / totalQuestions) * 100);
        document.getElementById('progress-fill').style.width = percent + '%';
        document.getElementById('progress-text').textContent = percent + '% Complete';
        document.getElementById('btn-prev').style.visibility = current > 0 ? 'visible' : 'hidden';
        document.getElementById('btn-next').textContent = current === totalQuestions - 1 ? 'Lihat Hasil →' : 'Next →';
    }

    function showQuestion(index) {
        document.querySelectorAll('[id^="q-"]').forEach(el => el.style.display = 'none');
        document.getElementById('q-' + index).style.display = 'block';
        current = index;
        updateProgress();
    }

    function nextQuestion() {
        if (current < totalQuestions - 1) {
            showQuestion(current + 1);
        } else {
            document.getElementById('quiz-form').submit();
        }
    }

    function prevQuestion() {
        if (current > 0) showQuestion(current - 1);
    }

    function selectOption(questionId, optionId) {
        document.querySelectorAll(`[id^="label-${questionId}-"]`).forEach(el => el.classList.remove('selected'));
        document.getElementById(`label-${questionId}-${optionId}`).classList.add('selected');
    }

    updateProgress();
</script>
@endpush
@endsection