<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title', 'category', 'description', 'icon',
        'duration_minutes', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }
}