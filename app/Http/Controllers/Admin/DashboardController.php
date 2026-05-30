<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Article;
use App\Models\QuizResult;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'        => User::where('role', 'user')->count(),
            'quizzes'      => Quiz::count(),
            'articles'     => Article::count(),
            'quiz_results' => QuizResult::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}