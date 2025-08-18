<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassementCarambole extends Model
{
    use HasFactory;


    protected $table = 'classement_carambole';
    protected $fillable = [
        'title',
        'file',
        'discipline'
    ];

    public $timestamps = false;
}
