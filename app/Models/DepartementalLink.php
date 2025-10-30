<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartementalLink extends Model
{
    protected $table = 'departemental_links';

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
    

    public $timestamps = false;
}
