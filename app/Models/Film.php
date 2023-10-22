<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

//    protected $with = ['genres'];

    protected $appends = [
        'rating',
//        'is_favorite',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    protected $casts = [
        'starring' => 'array',
        'promo' => 'bool',
    ];

    protected $fillable = [
        'name',
        'poster_image',
        'preview_image',
        'background_image',
        'background_color',
        'video_link',
        'preview_video_link',
        'description',
        'director',
        'starring',
        'run_time',
        'released',
        'promo',
        'status',
        'imdb_id',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNotNull('rating');
    }

    public function getRatingAttribute(): float
    {
        return round($this->scores()->avg('rating'), 1);
    }

}
