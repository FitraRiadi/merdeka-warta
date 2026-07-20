<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnouncementCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
