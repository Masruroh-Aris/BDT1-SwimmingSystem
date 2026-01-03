<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'athlete_name',
        'meet_name',
        'event_name',
        'fee',
        'status',
        'input_by',
        'payment_method',
        'proof_image',
        'reject_note',
    ];
}
