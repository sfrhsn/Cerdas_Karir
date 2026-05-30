<?php

namespace App\Repositories;

use App\Interfaces\QuizRepositoryInterface;
use App\Models\Quiz;

class QuizRepository implements QuizRepositoryInterface
{
    public function all()
    {
        return Quiz::with('questions.options')->get();
    }

    public function findById(int $id)
    {
        return Quiz::with('questions.options')->findOrFail($id);
    }

    public function findByCategory(string $category)
    {
        return Quiz::where('category', $category)->where('is_active', true)->get();
    }

    public function getActive()
    {
        return Quiz::where('is_active', true)->get();
    }

    public function create(array $data)
    {
        return Quiz::create($data);
    }

    public function update(int $id, array $data)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($data);
        return $quiz;
    }

    public function delete(int $id)
    {
        return Quiz::destroy($id);
    }
}