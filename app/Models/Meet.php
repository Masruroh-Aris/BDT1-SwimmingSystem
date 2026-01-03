<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'start_date',
        'end_date',
        'venue',
        'logo',
        'status',
        'created_by',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get the meet's status dynamically based on date.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        if (!$this->start_date || !$this->end_date) {
            return $value;
        }

        $now = now();

        // If end date has passed (end of the day)
        if ($this->end_date->endOfDay()->isPast()) {
            return 'Completed'; 
        }

        // If currently within the date range
        if ($this->start_date->startOfDay()->isPast() && $this->end_date->endOfDay()->isFuture()) {
            return 'Ongoing';
        }

        return $value;
    }
}
