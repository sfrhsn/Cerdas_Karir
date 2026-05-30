<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapStep extends Model
{
    protected $fillable = ['roadmap_id', 'title', 'description', 'status', 'order'];

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }
}