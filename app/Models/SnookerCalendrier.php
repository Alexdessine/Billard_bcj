<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnookerCalendrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
    ];

    protected $table = 'calendrier_snooker';
    
    public $timestamps = false;
}
