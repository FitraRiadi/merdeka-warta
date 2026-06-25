<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spotlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'article_id',
        'announcement_id',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }

    public function scopeArticleSpotlights($query)
    {
        return $query->where('type', 'article');
    }

    public function scopeAnnouncementSpotlights($query)
    {
        return $query->where('type', 'announcement');
    }
}
