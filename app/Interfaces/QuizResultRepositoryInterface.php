<?php

namespace App\Interfaces;

interface QuizResultRepositoryInterface
{
    public function findById(int $id);
    public function getByUser(int $userId);
    public function create(array $data);
    public function delete(int $id);
}