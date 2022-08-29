<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

use ExportLocalization;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
         if (App::environment(['staging', 'production'])) {
             URL::forceScheme('https');
         }

         // Localization
         View::composer( '*', function ( $view ) {
             return $view->with( ['messages' => ExportLocalization::export()->toArray(),] );
         } );
     }
 }
