<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'designation',
        'facebook',
        'instagram',
        'twitter',
        'behance',
        'show_at_home',
        'status',
    ];
}

