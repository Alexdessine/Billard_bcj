<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmericainCalendrierNational extends Model
{
    protected $table = 'americain_calendrier_national';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(AmericainNationalLink::class, 'calendrier_id');
    }
}
