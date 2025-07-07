<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\CalendrierNationalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendrier_national extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date_debut',
        'date_fin',
        'date_limite',
        'titre',
        'lieu',
        'club',
        'url',
        'is_closed',
    ];

    protected $table = 'calendrier_national';

    protected static function newFactory()
    {
        return CalendrierNationalFactory::new();
    }

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
