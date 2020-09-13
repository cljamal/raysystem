<?php
namespace CLJAMAL\RaySystem;

use CLJAMAL\RaySystem\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class RaySystemServiceProvider extends ServiceProvider{

    protected $commands = [
        InstallCommand::class
    ];

    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ray.php', 'ray'
        );
    }

    public function register()
    {
//      $this->createRoutesFile();
        $this->commands( $this->commands );
        $this->registerConfig();
    }
}
