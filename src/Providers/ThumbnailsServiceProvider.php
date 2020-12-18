<?php

namespace Leeto\Thumbnails\Providers;

use Illuminate\Support\ServiceProvider;

class ThumbnailsServiceProvider extends ServiceProvider
{
    protected $namespace = "thumbnails";

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . "/..";

        /* Config */
        $this->publishes([
            $path . '/config/' . $this->namespace . '.php' => config_path($this->namespace . '.php'),
        ]);

        /* Routes */
        $this->loadRoutesFrom($path . '/routes/web.php');
    }

}
