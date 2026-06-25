<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RunningText extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'display_order',
        'background_color',
        'text_color',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
        ];
    }
}