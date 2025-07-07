<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendrier_international extends Model
{
    protected $table = 'calendrier_international';

    protected $fillable = [
        'titre',
        'date_debut',
        'date_fin',
        'lieu',
    ];
}
