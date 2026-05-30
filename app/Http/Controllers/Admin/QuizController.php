<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\QuizRepositoryInterface;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(
        protected QuizRepositoryInterface $quizRepository
    ) {}

    public function index()
    {
        $quizzes = $this->quizRepository->all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.form', ['quiz' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'category'         => 'required|string',
            'description'      => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
            'is_active'        => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $this->quizRepository->create($data);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz berhasil dibuat!');
    }

    public function show(int $id)
    {
        $quiz = $this->quizRepository->findById($id);
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(int $id)
    {
        $quiz = $this->quizRepository->findById($id);
        return view('admin.quizzes.form', compact('quiz'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'category'         => 'required|string',
            'description'      => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $this->quizRepository->update($id, $data);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $this->quizRepository->delete($id);
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz dihapus.');
    }

    // Halaman kelola soal
    public function questions(int $quizId)
    {
        $quiz = $this->quizRepository->findById($quizId);
        return view('admin.quizzes.questions', compact('quiz'));
    }

    // Tambah pertanyaan baru
    public function storeQuestion(Request $request, int $quizId)
    {
        $data = $request->validate([
            'question_text' => 'required|string',
            'category_tag'  => 'nullable|string|max:100',
        ]);

        $lastOrder = Question::where('quiz_id', $quizId)->max('order') ?? 0;

        $question = Question::create([
            'quiz_id'       => $quizId,
            'question_text' => $data['question_text'],
            'category_tag'  => $data['category_tag'] ?? null,
            'order'         => $lastOrder + 1,
        ]);

        // opsi
        foreach (['A', 'B', 'C', 'D'] as $label) {
            Option::create([
                'question_id'  => $question->id,
                'option_label' => $label,
                'option_text'  => '',
                'trait_key'    => 'strategic',
                'score'        => 3,
            ]);
        }

        return redirect()->route('admin.quizzes.questions', $quizId)
            ->with('success', 'Pertanyaan berhasil ditambahkan! Lengkapi opsi jawabannya.');
    }

    // Hapus pertanyaan
    public function destroyQuestion(int $questionId)
    {
        $question = Question::findOrFail($questionId);
        $quizId   = $question->quiz_id;
        $question->delete(); // opsi ikut terhapus (cascade)

        return redirect()->route('admin.quizzes.questions', $quizId)
            ->with('success', 'Pertanyaan dihapus.');
    }

    // Simpan/update opsi jawaban
    public function storeOption(Request $request, int $questionId)
    {
        $request->validate([
            'options'               => 'required|array',
            'options.*.id'          => 'required|exists:options,id',
            'options.*.option_text' => 'required|string',
            'options.*.trait_key'   => 'required|string',
            'options.*.score'       => 'required|integer|min:0|max:10',
        ]);

        foreach ($request->options as $optData) {
            Option::where('id', $optData['id'])->update([
                'option_text' => $optData['option_text'],
                'trait_key'   => $optData['trait_key'],
                'score'       => $optData['score'],
            ]);
        }

        // Update juga question_text & category_tag jika dikirim
        if ($request->has('question_text')) {
            Question::where('id', $questionId)->update([
                'question_text' => $request->question_text,
                'category_tag'  => $request->category_tag,
            ]);
        }

        $question = Question::findOrFail($questionId);
        return redirect()->route('admin.quizzes.questions', $question->quiz_id)
            ->with('success', 'Soal berhasil disimpan!');
    }

    // Hapus opsi
    public function destroyOption(int $optionId)
    {
        $option     = Option::findOrFail($optionId);
        $questionId = $option->question_id;
        $quizId     = Question::find($questionId)->quiz_id;
        $option->delete();

        return redirect()->route('admin.quizzes.questions', $quizId)
            ->with('success', 'Opsi dihapus.');
    }
}