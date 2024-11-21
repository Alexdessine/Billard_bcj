<?php

namespace App\Models;

use Database\Factories\CalendrierRegionalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier_regional extends Model
{
    use HasFactory;

        protected $fillable = [
        'titre',
        'date_debut',
        'date_fin',
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

}
