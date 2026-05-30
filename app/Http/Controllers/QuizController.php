<?php

namespace App\Http\Controllers;

use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\QuizResultRepositoryInterface;
use App\Interfaces\BookmarkRepositoryInterface;
use App\Services\CareerAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function __construct(
        protected QuizRepositoryInterface $quizRepository,
        protected QuizResultRepositoryInterface $quizResultRepository,
        protected BookmarkRepositoryInterface $bookmarkRepository,
        protected CareerAnalysisService $careerAnalysisService,
    ) {}

    public function index()
    {
        $quizzes = $this->quizRepository->getActive()
            ->filter(fn($q) => $q->category !== 'Universal');

        $universalQuiz = $this->quizRepository->getActive()
            ->firstWhere('category', 'Universal');

        return view('quiz.index', compact('quizzes', 'universalQuiz'));
    }

    public function show(int $id)
    {
        $quiz = $this->quizRepository->findById($id);
        return view('quiz.show', compact('quiz'));
    }

    public function submit(Request $request, int $id)
    {
        $quiz = $this->quizRepository->findById($id);
        $answers = $request->input('answers', []);

        $qna = [];

        foreach ($quiz->questions as $question) {
            $optionId = $answers[$question->id] ?? null;
            $option = $question->options->find($optionId);

            $qna[] = [
                'question' => $question->question_text,
                'selected_answer' => $option?->option_text ?? '-',

                'trait' => strtolower($option?->trait_key ?? 'strategic'),

                'score' => (int) ($option?->score ?? 3),
            ];
        }

        $core = $this->careerAnalysisService->coreAnalysis($qna);

        $ai = $this->careerAnalysisService->aiNarration(
            $core,
            $qna,
            $quiz->category
        );

        $result = $this->quizResultRepository->create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,

            'recommended_position' => $core['position'],
            'trait_scores' => $core['trait_scores'],
            'key_strengths' => $core['key_strengths'],


            'analysis_summary' => $ai['analysis_summary'],
            'short_term_advice' => $ai['short_term_advice'],
            'growth_potential' => $ai['growth_potential'],

            'answers' => $answers,
        ]);

        return redirect()->route('quiz.result', $result->id);
    }

    public function result(int $resultId)
    {
        $result = $this->quizResultRepository->findById($resultId);
        $isBookmarked = $this->bookmarkRepository->findByUserAndResult(Auth::id(), $resultId);

        abort_if($result->user_id !== Auth::id(), 403);

        return view('quiz.result', compact('result', 'isBookmarked'));
    }
}