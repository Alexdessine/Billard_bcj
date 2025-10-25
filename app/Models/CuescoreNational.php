<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuescoreNational extends Model
{
    use HasFactory;
    protected $table = 'cuescore_national';
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'blackball_master' => 'integer',
        'mixte' => 'integer',
        'mixte_tableau_a' => 'integer',
        'mixte_tableau_b' => 'integer', 
        'feminin' => 'integer',
        'juniors_u18' => 'integer',
        'espoirs_u23' => 'integer',
        'veterans' => 'integer',
        'handi_fauteuil' => 'integer',
    ];

    public static function labels(): array
    {
        return [
            'blackball_master' => 'Blackball Master',
            'mixte' => 'Mixte',
            'mixte_tableau_a' => 'Mixte tableau A',
            'mixte_tableau_b' => 'Mixte tableau B',
            'feminin' => 'Feminin',
            'juniors_u18' => 'Juniors (U18)',
            'espoirs_u23' => 'Espoirs (U23)',
            'veterans' => 'Veterans',
            'handi_fauteuil' => 'Handi fauteuil',
        ];
    }
}
