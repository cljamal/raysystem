<?php

namespace CLJAMAL\RaySystem\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'ray:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the RaySystem admin package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->createMainDir();
    }

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Initialize the admAin directory.
     *
     * @return void
     */
    protected function createMainDir()
    {
        $this->directory = config('ray.directory');

        if (is_dir($this->directory)) {
            $this->line("<error>{$this->directory} directory already exists !</error> ");

            return;
        }

        $this->makeDir('/');
        $this->line('<info>RaySystem directory was created:</info> '.str_replace(base_path(), '', $this->directory) );

        $this->makeDir('Controllers');

        $this->createHomeController();
        $this->createAuthController();
        $this->createExampleController();

        $this->createBootstrapFile();
        $this->createRoutesFile();
    }

    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
