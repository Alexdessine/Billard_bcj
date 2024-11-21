<?php

namespace App\Models;

use Database\Factories\EvenementsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenements extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook',
        'image',
    ];

    protected static function newFactory()
    {
        return EvenementsFactory::new();
    }

    public $timestamps = false;
}
