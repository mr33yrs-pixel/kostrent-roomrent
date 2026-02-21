<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory, Prunable;

    protected $fillable = [
        'ip_address',
        'url',
        'user_agent',
        'user_id',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get the prunable model query.
     * Removes visits older than 90 days to prevent unbounded table growth.
     */
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDays(90));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

