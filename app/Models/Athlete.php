<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'place_of_birth',
        'club_id',
        'institution_id',
    ];

    /**
     * Relasi ke Club (User dengan sub_role 'club')
     */
    public function club()
    {
        return $this->belongsTo(User::class, 'club_id');
    }

    /**
     * Relasi ke Institution (User dengan sub_role 'school' atau 'university')
     */
    public function institution()
    {
        return $this->belongsTo(User::class, 'institution_id');
    }
}
