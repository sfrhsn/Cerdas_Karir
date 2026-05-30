<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id', 'quiz_id', 'recommended_position',
        'analysis_summary', 'trait_scores', 'key_strengths', 'answers',
    ];

    protected $casts = [
        'trait_scores' => 'array',
        'key_strengths' => 'array',
        'answers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function bookmark()
    {
        return $this->hasOne(Bookmark::class);
    }

    public function roadmap()
    {
        return $this->hasOne(Roadmap::class);
    }
}