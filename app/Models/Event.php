<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'code',
        'start_time',
        'fee',
        'gender',
        'age_group',
        'heat',
        'relay',
        'status',
        'meet_id',
    ];

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_name', 'name');
    }

    /**
     * Get the event's status dynamically based on the parent Meet's status/date.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
         // We rely on the parent meet's date logic
         // If the meet is Completed or Ongoing (by date), the event acts accordingly.
         if ($this->meet) {
             $meetStatus = $this->meet->status; // Accesses the dynamic accessor in Meet
             if ($meetStatus === 'Completed' || $meetStatus === 'Ongoing') {
                 return $meetStatus;
             }
         }

         return $value;
    }
}
