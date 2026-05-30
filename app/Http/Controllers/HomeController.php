<?php

namespace App\Http\Controllers;

use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\QuizRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
        protected QuizRepositoryInterface $quizRepository,
    ) {}

    public function index()
    {
        $featuredArticle = $this->articleRepository->getFeatured();
        $recentArticles  = $this->articleRepository->getPublished(3);
        $quizzes         = $this->quizRepository->getActive();

        return view('home', compact('featuredArticle', 'recentArticles', 'quizzes'));
    }
}