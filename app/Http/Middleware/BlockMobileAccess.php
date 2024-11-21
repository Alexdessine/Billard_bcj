<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockMobileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if ($this->isMobile($request)) {
                return response(view('errors.mobile_blocked'), 403);
            }

            return $next($request);
        } catch (\Exception $e) {
            // Loggez l'erreur pour en comprendre la source
            logger()->error('Erreur dans BlockMobileAccess: ' . $e->getMessage());
            abort(500, 'Une erreur s\'est produite.');
        }
    }

    /**
     * Détecte si l'utilisateur utilise un appareil mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function isMobile(Request $request)
    {
        $agent = $request->header('User-Agent', '');

        // Vérifiez si le User-Agent est vide
        if (empty($agent)) {
            return false; // Par défaut, considérer comme non mobile
        }

        // Détecte les appareils mobiles ou tablettes
        return preg_match('/mobile|tablet|ipad|android|phone/i', $agent) === 1;
    }
}
