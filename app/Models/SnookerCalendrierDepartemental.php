<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnookerCalendrierDepartemental extends Model
{
    protected $table = 'snooker_calendrier_departemental';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(SnookerDepartementalLink::class, 'calendrier_id');
    }
}
