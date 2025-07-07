<?php

namespace App\Providers;

use App\Models\Contact;
use OpenAdmin\Admin\Form;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Admin\Extensions\Ckeditor\Ckeditor;
use App\Models\SiteSetting;

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

        // if (app()->environment('local')){
        //     URL::forceScheme('https');
        // }
    }
}
