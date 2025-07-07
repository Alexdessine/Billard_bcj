<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalSportEasy extends Model
{
    use HasFactory;

    protected $table = 'national_sport_easy';

    protected $fillable = [
        'national_id',
        'url'
    ];

    public function calendrier()
    {
        return $this->belongsTo(Calendrier_national::class, 'calendrier_id');
    }

    public function getAvailableLinksSportEasy()
    {
        $linksSE = [];

        if (!empty($this->url)) {
            $linksSE[] = [
                'url' => $this->url,
                'label' => 'Sport Easy'
            ];
        }

        return $linksSE;
    }
}
