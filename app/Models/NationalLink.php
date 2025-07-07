<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalLink extends Model
{
    use HasFactory;

    protected $table = 'national_links';

    public $timestamps = false;

    protected $fillable = [
        'calendrier_id',
        'master',
        'mixte_tableau_a',
        'mixte_tableau_b',
        'feminin',
        'espoir',
        'junior',
        'handi',
        'veteran',
        'individuel',
        'equipe',
        'ddoublette'
    ];

    public function calendrier()
    {
        return $this->belongsTo(Calendrier_national::class, 'calendrier_id');
    }

    // Récupérer les catégories qui ont un lien
    public function getAvailableLinks()
    {
        $links = [];
        $categories = [
            'master' => 'Blackball Master',
            'mixte_tableau_a' => 'Mixte A',
            'mixte_tableau_b' => 'Mixte B',
            'feminin' => 'Féminin',
            'junior' => 'Junior',
            'espoir' => 'Espoir',
            'handi' => 'Handi',
            'veteran' => 'Vétéran',
            'individuel' => 'Individuel',
            'equipe' => 'Equipes',
            'doublette' => 'Doublettes'
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
