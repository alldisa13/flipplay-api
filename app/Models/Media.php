<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'type', 'title', 'year', 'rating', 'is_available',
        'episodes', 'studio', 'duration', 'director',
    ];

    protected $casts = [
        'rating'       => 'float',
        'is_available' => 'boolean',
    ];

    // Query scope: pengganti Library::getAvailableMedia()
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'media_user')->withTimestamps();
    }
}
