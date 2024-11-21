<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scraping_urls_participation extends Model
{
    use HasFactory;

    protected $table = 'scraping_urls_participation';

    protected $fillable = [
        'table_name',
        'url',
    ];
}
