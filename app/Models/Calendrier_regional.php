<?php

namespace App\Models;

use App\Models\RegionalLink;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CalendrierRegionalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendrier_regional extends Model
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

    protected $table = 'calendrier_regional';

    protected static function newFactory()
    {
        return CalendrierRegionalFactory::new();
    }

    public $timestamps = false;
    
    public function links()
    {
        return $this->hasOne(RegionalLink::class, 'calendrier_id');
    }

    public function SportEasy()
    {
        return $this->hasOne(RegionalSportEasy::class, 'regional_id');
    }
}
