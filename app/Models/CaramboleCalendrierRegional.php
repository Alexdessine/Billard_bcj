<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaramboleCalendrierRegional extends Model
{
    protected $table = 'carambole_calendrier_regional';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(CaramboleRegionalLink::class, 'calendrier_id');
    }
}
