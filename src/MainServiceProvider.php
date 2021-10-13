<?php
namespace Iransoftnet1\MultiThreadDatabaseProcessing;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__."/config.php","MultiThreadDatabaseProcessing");
        $this->loadRoutesFrom(__DIR__ . '/web.php');
        //php artisan vendor:publish --provider=Iransoftnet1\MultiThreadDatabaseProcessing\MainServiceProvider --force
        $this->publishes([
            __DIR__.'/res' => app_path()
        ]);

    }


    public function register()
    {

    }

}