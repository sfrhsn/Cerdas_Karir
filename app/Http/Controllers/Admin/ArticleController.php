<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ArticleRepositoryInterface;
use App\Services\ArticleGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
        protected ArticleGeneratorService    $articleGenerator,
    ) {}

    public function index()
    {
        $articles = $this->articleRepository->all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.form', ['article' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string',
            'excerpt'   => 'required|string',
            'content'   => 'required|string',
            'read_time' => 'required|integer|min:1',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data['slug']         = Str::slug($data['title']) . '-' . time();
        $data['user_id']      = Auth::id();
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $this->articleRepository->create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(int $id)
    {
        $article = $this->articleRepository->findById($id);
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|string',
            'excerpt'   => 'required|string',
            'content'   => 'required|string',
            'read_time' => 'required|integer|min:1',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $this->articleRepository->update($id, $data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $this->articleRepository->delete($id);
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel dihapus.');
    }

    // Generate artikel via AI
    public function generateAI(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
        ]);

        $generated = $this->articleGenerator->generate(
            $request->title,
            $request->category
        );

        if (!$generated) {
            return redirect()->route('admin.articles.create')
                ->with('error', 'Gagal generate artikel dari AI. Pastikan GROQ_API_KEY sudah dikonfigurasi di .env dan coba lagi.');
        }

        return redirect()->route('admin.articles.create')
            ->with('ai_generated', [
                'title'     => $request->title,
                'category'  => $request->category,
                'excerpt'   => $generated['excerpt']  ?? '',
                'content'   => $generated['content']  ?? '',
                'read_time' => $generated['read_time'] ?? 5,
            ]);
    }
}