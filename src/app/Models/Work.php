<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'genre',
        'status',
        'rating',
        'memo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}