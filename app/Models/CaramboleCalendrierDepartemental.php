<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaramboleCalendrierDepartemental extends Model
{
    protected $table = 'carambole_calendrier_departemental';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(CaramboleDepartementalLink::class, 'calendrier_id');
    }
}
