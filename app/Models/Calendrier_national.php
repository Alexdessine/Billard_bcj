<?php

namespace App\Models;

use Database\Factories\CalendrierNationalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier_national extends Model
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

    protected $table = 'calendrier_national';

    protected static function newFactory()
    {
        return CalendrierNationalFactory::new();
    }

    public $timestamps = false;
}
