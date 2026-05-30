<?php

namespace App\Http\Controllers;

use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {}

    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');

        if (!empty($search)) {
            $articles = $this->articleRepository->search($search);
        } elseif (!empty($category) && $category !== 'All Topics') {
            $articles = $this->articleRepository->findByCategory($category);
        } else {
            $articles = $this->articleRepository->getPublished(6);
        }

        $featured = $this->articleRepository->getFeatured();

        return view('articles.index', compact(
            'articles',
            'featured',
            'search',
            'category'
        ));
    }

    public function show(string $slug)
    {
        $article = $this->articleRepository->findBySlug($slug);

        return view('articles.show', compact('article'));
    }
}