<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RunningText extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'is_active',
        'display_order',
        'background_color',
        'text_color',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ];
    }
}