<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Enrollment extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'payment_id',
        'amount_paid',
        'enrolled_at',
        'status',
        'completed_at',
        'suspended_at',
        'payment_id',
        'is_active',
    ];


    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withTimestamps();
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
