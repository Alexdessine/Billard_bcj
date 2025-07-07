<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalLink extends Model
{
    use HasFactory;

    protected $table = 'regional_links';

    protected $fillable = [
        'calendrier_id',
        'top_ligue',
        'mixte',
        'feminin',
        'U18',
        'U15',
        'U23',
        'handi',
        'veteran',
        'handi_fauteuil'
    ];
    public $timestamps = false;

    public function calendrier()
    {
        return $this->belongsTo(Calendrier_regional::class, 'calendrier_id');
    }

    // Récupérer les catégories qui ont un lien
    public function getAvailableLinks()
    {
        $links = [];
        $categories = [
            'top_ligue' => 'Top ligue',
            'mixte' => 'Mixte',
            'feminin' => 'Féminin',
            'U15' => 'U15',
            'U18' => 'U18',
            'U23' => 'U23',
            'handi' => 'Handi',
            'handi_fauteuil' => 'Handi Fauteuil',
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
