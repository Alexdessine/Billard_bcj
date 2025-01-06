<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    use HasFactory;

    // Autoriser le mass assignment pour ces champs
    protected $fillable = [
        'year',     // L'année du bloc
        'title',    // Le titre du bloc
        'content',  // Le contenu HTML du bloc
    ];
}
