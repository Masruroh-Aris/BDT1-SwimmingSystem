<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'athlete_name',
        'event_name',
        'lane',
        'meet_name',
        'time_result',
        'points',
        'rank',
        'medal',
        'note',
        'status',
        'input_by',
    ];
}
