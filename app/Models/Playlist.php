<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
    ];

    /**
     * Get the user that owns the Playlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the tracks for the Playlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function tracks(): belongsToMany
    {
        return $this->belongsToMany(Track::class);
    }
}
