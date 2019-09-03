<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema; //NEW: Import Schema

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('path.public', function() {
      return base_path('../public_html');
   });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //  Blade::withoutDoubleEncoding();
        Schema::defaultStringLength(191); //NEW: Increase StringLength
    }
}
