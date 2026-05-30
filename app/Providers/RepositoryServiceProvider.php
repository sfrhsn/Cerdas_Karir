<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\QuizRepositoryInterface;
use App\Repositories\QuizRepository;
use App\Interfaces\ArticleRepositoryInterface;
use App\Repositories\ArticleRepository;
use App\Interfaces\BookmarkRepositoryInterface;
use App\Repositories\BookmarkRepository;
use App\Interfaces\QuizResultRepositoryInterface;
use App\Repositories\QuizResultRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(BookmarkRepositoryInterface::class, BookmarkRepository::class);
        $this->app->bind(QuizResultRepositoryInterface::class, QuizResultRepository::class);
    }
}