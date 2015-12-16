<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * The ViewComposerProvider class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        view()->composer('*', 'App\Http\ViewComposers\MenuComposer');
    }
}
