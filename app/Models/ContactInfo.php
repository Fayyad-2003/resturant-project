<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'info_1',
        'info_2',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

