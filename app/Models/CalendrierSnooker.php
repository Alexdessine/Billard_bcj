<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendrierSnooker extends Model
{
    protected $table = 'calendrier_snooker';

    public $timestamps = false;

    
    public function links()
    {
        return $this->hasOne(NationalLink::class, 'calendrier_id');
    }

    public function linksSE()
    {
        return $this->hasOne(NationalSportEasy::class, 'national_id');
    }

    public function lienInscription()
    {
        return $this->hasOne(\App\Models\NationalLink::class, 'calendrier_id');
    }

}
