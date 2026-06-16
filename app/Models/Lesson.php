<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = [
        'id',
        'course_id',
        'title',
        'content',
        'slug',
        'description',
        'video_url',
        'order',
        'is_active',
    ];


    public function course() {
        return $this->belongsTo(Course::class);
    }
}
