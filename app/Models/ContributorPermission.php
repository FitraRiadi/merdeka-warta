<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributorPermission extends Model
{
    protected $fillable = [
        'name',
        'class',
        'reason',
        'phone',
    ];
}
