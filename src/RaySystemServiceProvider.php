<?php
namespace CLJAMAL\RaySystem;

use Illuminate\Support\ServiceProvider;

class RaySystemServiceProvider extends ServiceProvider{

    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ray.php', 'ray'
        );
    }

    public function register()
    {
        $this->registerConfig();
    }
}
