<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Dashboard\Empresas;

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
        view()->composer('*', function($view) {
            $empre = Empresas::get();
            $empresas = count($empre);
            $view->with('empresas',  $empresas );
        });  
    }
}
