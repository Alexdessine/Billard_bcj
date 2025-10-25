<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmericainCalendrierRegional extends Model
{
    protected $table = 'americain_calendrier_regional';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(AmericainRegionalLink::class, 'calendrier_id');
    }
}
