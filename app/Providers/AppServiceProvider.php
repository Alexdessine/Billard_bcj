<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use OpenAdmin\Admin\Form; // si tu l’utilises pour des extensions de formulaire
use OpenAdmin\Admin\Admin;    // ← correction ici
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.footer', function ($view) {
            $contact = SiteSetting::first();
            $view->with('contact_footer', $contact);
        });

        // Forcer HTTPS en local si besoin
        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }

        // Injecter la langue FR dans le datepicker d'OpenAdmin
        // Admin::booting(function () {
        //     Admin::js('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js');
        //     Admin::js('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js');
        //     Admin::css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css');
        
        //     Admin::script("
        //         $('.date').datepicker({
        //             format: 'yyyy-mm-dd',
        //             language: 'fr',
        //             autoclose: true,
        //             todayHighlight: true
        //         });
        //     ");
        // });
    }
}
