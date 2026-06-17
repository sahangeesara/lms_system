<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'amount_paid',
        'enrolled_at',
        'status',
        'completed_at',
        'suspended_at',
        'payment_id', // FIXED: Removed duplicate 'payment_id' entry
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     * Crucial for letting you call ->format() directly on your custom timestamp strings
     */
    protected $casts = [
        'enrolled_at'   => 'datetime',
        'completed_at'  => 'datetime',
        'suspended_at'  => 'datetime',
        'is_active'     => 'boolean',
        'amount_paid'   => 'decimal:2',
    ];

    /**
     * Get the student profile that owns this enrollment record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the specific structural course tied to this enrollment record.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the payment transaction tracking log if it exists.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
