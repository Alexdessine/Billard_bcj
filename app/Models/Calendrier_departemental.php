<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendrier_departemental extends Model
{
    protected $table = 'calendrier_departemental';

    public $timestamps = false;

    public function links(){
        return $this->hasOne(DepartementalLink::class, 'calendrier_id');
    }

}
