<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'mission',
        'launch_details',
        'landing_details',
        'spacecraft'
    ];
}
