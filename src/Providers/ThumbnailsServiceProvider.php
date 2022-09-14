<?php

namespace Leeto\Thumbnails\Providers;

use Illuminate\Support\ServiceProvider;

class ThumbnailsServiceProvider extends ServiceProvider
{
    protected $namespace = 'thumbnails';

    public function register()
    {
        //
    }

    public function boot()
    {
        $path = __DIR__.'/..';

        $this->publishes([
            $path.'/config/'.$this->namespace.'.php' => config_path($this->namespace.'.php'),
        ]);

        $this->loadRoutesFrom($path.'/routes/'.$this->namespace.'.php');
    }

}
