<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin',        // si ton tableau de bord est sur /admin
        'admin/*',      // et toutes ses sous-routes
        'login',        // écran de connexion si nécessaire
        'logout',
        // ajoute aussi les assets de l’admin si besoin :
        'admin/assets/*',
    ];
}
