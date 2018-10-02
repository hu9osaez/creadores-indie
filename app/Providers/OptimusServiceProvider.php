<?php namespace CreadoresIndie\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Optimus\Optimus;

class OptimusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Optimus::class, function () {
            return new Optimus(1145664931, 2041800203, 1894578436);
        });
    }
}
