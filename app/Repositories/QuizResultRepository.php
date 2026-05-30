<?php

namespace App\Repositories;

use App\Interfaces\QuizResultRepositoryInterface;
use App\Models\QuizResult;

class QuizResultRepository implements QuizResultRepositoryInterface
{
    public function findById(int $id)
    {
        return QuizResult::with(['quiz', 'user', 'bookmark', 'roadmap.steps'])->findOrFail($id);
    }

    public function getByUser(int $userId)
    {
        return QuizResult::with('quiz')->where('user_id', $userId)->latest()->get();
    }

    public function create(array $data)
    {
        return QuizResult::create($data);
    }

    public function delete(int $id)
    {
        return QuizResult::destroy($id);
    }
}