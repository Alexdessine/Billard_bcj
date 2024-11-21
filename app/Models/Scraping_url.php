<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scraping_url extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_name',
        'url',
    ];
}
