<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'provider',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the student account node that executed this payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the individual enrollment blocks funded by this payment transaction.
     */
    /**
     * Get all the individual enrollment blocks funded by this payment transaction.
     */
    public function enrollments(): HasMany
    {
        // Eloquent automatically links 'payment_id' to this model's ID behind the scenes
        return $this->hasMany(Enrollment::class, 'payment_id');
    }
}
