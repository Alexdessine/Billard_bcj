<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaramboleCalendrierNational extends Model
{
    protected $table = 'carambole_calendrier_national';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(CaramboleNationalLink::class, 'calendrier_id');
    }
}
