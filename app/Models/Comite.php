<?php

namespace App\Models;

use Database\Factories\ComiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'fonction',
        'telephone',
        'email',
        'image',
    ];

    protected $table = 'comite';

    protected static function newFactory()
    {
        return ComiteFactory::new();
    }

    public $timestamps = false;

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage' . $this->image)
            : asset('storage/comite/profil.jpg');
    }
}

