<?php

namespace App\Repositories;

use App\Interfaces\BookmarkRepositoryInterface;
use App\Models\Bookmark;

class BookmarkRepository implements BookmarkRepositoryInterface
{
    public function getByUser(int $userId)
    {
        return Bookmark::with('quizResult.quiz')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        return Bookmark::firstOrCreate($data);
    }

    public function delete(int $id)
    {
        return Bookmark::destroy($id);
    }

    public function findByUserAndResult(int $userId, int $quizResultId)
    {
        return Bookmark::where('user_id', $userId)
            ->where('quiz_result_id', $quizResultId)
            ->first();
    }
}