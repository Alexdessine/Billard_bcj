<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaramboleDepartementalLink extends Model
{
    use HasFactory;

    protected $table = 'carambole_departemental_links';

    public $timestamps = false;

    protected $fillable = [
        'calendrier_id',
        'mixte',
        'feminin',
        'U18',
        'U15',
        'handi',
        'veteran'
    ];

    public function calendrier()
    {
        return $this->belongsTo(CaramboleCalendrierDepartemental::class, 'calendrier_id');
    }

    // Récupérer les catégories qui ont un lien
    public function getAvailableLinks()
    {
        $links = [];
        $categories = [
            'mixte' => 'Mixte',
            'feminin' => 'Féminin',
            'U18' => 'U18',
            'U15' => 'U15',
            'U23' => 'U23',
            'handi' => 'Handi',
            'veteran' => 'Vétéran'
        ];

        foreach ($categories as $column => $label) {
            if (!empty($this->$column)) {
                $links[] = [
                    'url' => $this->$column,
                    'label' => $label
                ];
            }
        }

        return $links;
    }

}
