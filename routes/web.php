<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// PUBLIC
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/articles',        [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/quiz',            [QuizController::class, 'index'])->name('quiz.index');

// AUTH USER
Route::middleware('auth')->group(function () {
    Route::get('/quiz/{id}',              [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{id}/submit',      [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result/{resultId}', [QuizController::class, 'result'])->name('quiz.result');

    Route::get('/roadmap/{resultId}',          [RoadmapController::class, 'show'])->name('roadmap.show');
    Route::post('/roadmap/step/{stepId}',      [RoadmapController::class, 'updateStep'])->name('roadmap.step.update');

    Route::get('/bookmark',                    [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark',                   [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/bookmark/{id}',            [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('/bookmark/detail/{resultId}',  [BookmarkController::class, 'show'])->name('bookmark.show');

    Route::get('/profile',              [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile',              [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/security',     [ProfileController::class, 'security'])->name('profile.security');
    Route::put('/profile/security',     [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quiz custom routes (HARUS di atas resource)
    Route::get('/quizzes/{quizId}/questions',              [AdminQuizController::class, 'questions'])->name('quizzes.questions');
    Route::post('/quizzes/{quizId}/questions',             [AdminQuizController::class, 'storeQuestion'])->name('quizzes.questions.store');
    Route::delete('/quizzes/questions/{questionId}',       [AdminQuizController::class, 'destroyQuestion'])->name('quizzes.questions.destroy');
    Route::post('/quizzes/questions/{questionId}/options', [AdminQuizController::class, 'storeOption'])->name('quizzes.options.store');
    Route::delete('/quizzes/options/{optionId}',           [AdminQuizController::class, 'destroyOption'])->name('quizzes.options.destroy');

    // Article AI generate (HARUS di atas resource)
    Route::post('/articles/generate-ai', [AdminArticleController::class, 'generateAI'])->name('articles.generate-ai');

    Route::resource('quizzes',  AdminQuizController::class);
    Route::resource('articles', AdminArticleController::class);
    Route::resource('users',    AdminUserController::class);
});

    Route::get('/test-groq', function () {
    return config('services.groq.key');
});