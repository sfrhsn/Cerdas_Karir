<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function all()
    {
        return Article::with('author')
            ->latest()
            ->get();
    }

    public function findById(int $id)
    {
        return Article::with('author')
            ->findOrFail($id);
    }

    public function findBySlug(string $slug)
    {
        return Article::with('author')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }

    public function findByCategory(string $category)
    {
        return Article::with('author')
            ->where('category', $category)
            ->where('is_published', true)
            ->latest()
            ->paginate(6)
            ->withQueryString();
    }

    public function search(string $query)
    {
        return Article::with('author')
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();
    }

    public function getFeatured()
    {
        return Article::where('is_featured', true)
            ->where('is_published', true)
            ->latest()
            ->first();
    }

    public function getPublished(int $perPage = 6)
    {
        return Article::with('author')
            ->where('is_published', true)
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update(int $id, array $data)
    {
        $article = Article::findOrFail($id);

        $article->update($data);

        return $article;
    }

    public function delete(int $id)
    {
        return Article::destroy($id);
    }
}