<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnookerCalendrierRegional extends Model
{
    protected $table = 'snooker_calendrier_regional';

    public $timestamps = false;

        public function links(){
        return $this->hasOne(SnookerRegionalLink::class, 'calendrier_id');
    }
}
