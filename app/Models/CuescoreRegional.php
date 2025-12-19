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

    // --- Top ligue (colonne: "Top ligue") ---
    public function getTopLigueAttribute()
    {
        return $this->attributes['Top ligue'] ?? null;
    }

    public function setTopLigueAttribute($value)
    {
        $this->attributes['Top ligue'] = $value;
    }

    // --- handi-fauteuil ---
    public function getHandiFauteuilAttribute()
    {
        return $this->attributes['handi-fauteuil'] ?? null;
    }

    public function setHandiFauteuilAttribute($value)
    {
        $this->attributes['handi-fauteuil'] = $value;
    }

    // --- handi-debout ---
    public function getHandiDeboutAttribute()
    {
        return $this->attributes['handi-debout'] ?? null;
    }

    public function setHandiDeboutAttribute($value)
    {
        $this->attributes['handi-debout'] = $value;
    }

    // --- benjamin (U15) ---
    public function getBenjaminU15Attribute()
    {
        return $this->attributes['benjamin (U15)'] ?? null;
    }

    public function setBenjaminU15Attribute($value)
    {
        $this->attributes['benjamin (U15)'] = $value;
    }

    // --- espoirs (U23) ---
    public function getEspoirsU23Attribute()
    {
        return $this->attributes['espoirs (U23)'] ?? null;
    }

    public function setEspoirsU23Attribute($value)
    {
        $this->attributes['espoirs (U23)'] = $value;
    }
}
