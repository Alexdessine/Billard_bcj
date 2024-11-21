<?php

namespace App\Models;

use Database\Factories\GallerieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
    ];

    protected $table = 'gallerie';

        protected static function newFactory()
    {
        return GallerieFactory::new();
    }
}
