<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmericainCalendrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
    ];

    protected $table = 'calendrier_americain';
    
    public $timestamps = false;
}
