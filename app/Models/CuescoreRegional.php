<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuescoreRegional extends Model
{
    use HasFactory;

    protected $table = 'cuescore_regional';
    public $timestamps = false;

    protected $guarded = [];

    protected static function booted()
    {
        static::retrieved(function (self $model) {
            $map = [
                'top_ligue'      => 'Top ligue',
                'handi_fauteuil' => 'handi-fauteuil',
                'handi_debout'   => 'handi-debout',
                'benjamin_u15'   => 'benjamin (U15)',
                'espoirs_u23'    => 'espoirs (U23)',
            ];

            foreach ($map as $alias => $realColumn) {
                $value = $model->attributes[$realColumn] ?? null;

                // On crée l'attribut "propre"
                $model->attributes[$alias] = $value;

                // Et surtout : on le met aussi dans "original" (ce que OpenAdmin lit en edit)
                $model->syncOriginalAttribute($alias);
            }
        });
    }
}
