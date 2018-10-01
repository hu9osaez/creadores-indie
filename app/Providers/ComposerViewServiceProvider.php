<?php namespace CreadoresIndie\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function (\Illuminate\View\View $view) {
            $view->with('loggedInUser', auth()->user());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
