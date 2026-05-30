<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = [
        'quiz_result_id', 'user_id', 'title', 'overall_rank', 'steps_done',
    ];

    public function steps()
    {
        return $this->hasMany(RoadmapStep::class)->orderBy('order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quizResult()
    {
        return $this->belongsTo(QuizResult::class);
    }
}