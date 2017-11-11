<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.app', 'threads.create'], 'App\Http\ViewComposers\ChannelComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
