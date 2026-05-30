<?php

namespace App\Interfaces;

interface BookmarkRepositoryInterface
{
    public function getByUser(int $userId);
    public function create(array $data);
    public function delete(int $id);
    public function findByUserAndResult(int $userId, int $quizResultId);
}