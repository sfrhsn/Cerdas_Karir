<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function findBySlug(string $slug);
    public function findByCategory(string $category);
    public function search(string $query);
    public function getFeatured();
    public function getPublished(int $perPage = 9);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}