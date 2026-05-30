<?php

namespace App\Interfaces;

interface QuizRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function findByCategory(string $category);
    public function getActive();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}