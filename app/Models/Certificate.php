<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'event_name',
        'image_path',
        'uploaded_by',
        'layout',
    ];

    protected $casts = [
        'layout' => 'array',
    ];
}
