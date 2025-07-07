<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Supprime l'ancien logo
            if ($model->isDirty('logo')) {
                $old = $model->getOriginal('logo');
                $oldPath = public_path("img/$old");
                    if ($old && file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Supprime l'ancienne bannière
            if ($model->isDirty('banniere')) {
                $old = $model->getOriginal('banniere');
                $oldPath = public_path("img/$old");
                if ($old && file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        });
    }
}
