<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'heading',
        'url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

