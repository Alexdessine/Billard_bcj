<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmericainCalendrierDepartemental extends Model
{
    protected $table = 'americain_calendrier_departemental';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(AmericainDepartementalLink::class, 'calendrier_id');
    }
}
