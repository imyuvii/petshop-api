<?php

namespace YuvrajJhala\BacsPackage;

use Illuminate\Support\ServiceProvider;

class BacsPackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {
        //
    }
}
