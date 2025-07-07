<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassementCarambole extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file',
    ];

    public $timestamps = false;
    protected $table = 'classement_carambole';
}
