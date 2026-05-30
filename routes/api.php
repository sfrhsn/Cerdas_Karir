<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\QuizApiController;
use App\Http\Controllers\Api\ArticleApiController;
use App\Http\Controllers\Api\BookmarkApiController;


Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/login', [AuthApiController::class, 'login']);

// Articles publik (ga butuh login)
Route::get('/articles', [ArticleApiController::class, 'index']);
Route::get('/articles/{slug}', [ArticleApiController::class, 'show']);

// Quiz list publik (ga butuh login)
Route::get('/quizzes', [QuizApiController::class, 'index']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'show']);

Route::middleware('auth:api')->group(function () {

    // Auth
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);
    Route::get('/auth/me', [AuthApiController::class, 'me']);
    Route::post('/auth/refresh', [AuthApiController::class, 'refresh']);

    // Quiz butuh login
    Route::post('/quizzes/{id}/submit', [QuizApiController::class, 'submit']);
    Route::get('/quiz-results/{id}', [QuizApiController::class, 'result']);

    // Bookmarks butuh login
    Route::get('/bookmarks', [BookmarkApiController::class, 'index']);
    Route::post('/bookmarks', [BookmarkApiController::class, 'store']);
    Route::delete('/bookmarks/{id}', [BookmarkApiController::class, 'destroy']);

   
    Route::post('/articles', [ArticleApiController::class, 'store']);
    Route::put('/articles/{id}', [ArticleApiController::class, 'update']);
    Route::patch('/articles/{id}', [ArticleApiController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleApiController::class, 'destroy']);
});