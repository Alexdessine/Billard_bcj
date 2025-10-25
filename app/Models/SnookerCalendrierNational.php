<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnookerCalendrierNational extends Model
{
    protected $table = 'snooker_calendrier_national';

    public $timestamps = false;
    
    public function links(){
        return $this->hasOne(SnookerNationalLink::class, 'calendrier_id');
    }
}
