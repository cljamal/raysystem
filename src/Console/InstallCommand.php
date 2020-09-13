<?php

namespace CLJAMAL\RaySystem\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $this->makeDir(['Modules/Base/Controllers', 'Modules/Base/Models']);
        $this->makeFile('boot.php', __DIR__ . '/../base_stubs/boot.stub');
        $this->makeFile('Modules/Base/Controllers/BaseController.php', __DIR__ . '/../base_stubs/BaseController.stub');
        $this->makeFile('Modules/Base/Models/BaseModel.php', __DIR__ . '/../base_stubs/BaseModel.stub');

    }

    /**
     * Make new directory.
     *
     * @param string $paths
     * @return string
     */
    protected function makeDir( $paths = '' )
    {
        if ( !is_array($paths) )
            $paths = [ $paths ];

        foreach ($paths as $path)
        {
            if ( is_dir( config('ray.basedir') . DIRECTORY_SEPARATOR .$path ) ){
                $this->line("<error>".config('ray.basedir') . DIRECTORY_SEPARATOR .$path." directory already exists !</error> ");
                continue;
            }

            $paths_exploded = explode('/', $path);
            $current_path = null;

            foreach ($paths_exploded as $path)
            {
                $current_path = $current_path . '/' .$path;
                if ( !is_dir( config('ray.basedir') . DIRECTORY_SEPARATOR .$current_path ) ){
                    $this->laravel['files']->makeDirectory( config('ray.basedir') . DIRECTORY_SEPARATOR . $current_path, 0755, true, true);
                    $this->info(config('ray.basedir') . DIRECTORY_SEPARATOR . $current_path . ' directory was created');
                }
            }
        }
        return config('ray.basedir') . DIRECTORY_SEPARATOR .$path;
    }

    /**
     * Making a file
     *
     * @param $file_path
     * @param $stub
     * @return string|void
     */
    protected function makeFile( $file_path, $stub ){

        if ( is_file( config('ray.basedir') . DIRECTORY_SEPARATOR . $file_path ) ){
            $this->line("<error>". config('ray.basedir') . DIRECTORY_SEPARATOR . $file_path." file already exists !</error> ");
            return;
        }

        $content = File::get($stub);
        $this->laravel['files']->put( config('ray.basedir') . DIRECTORY_SEPARATOR . $file_path, $content );
        $this->info(config('ray.basedir') . DIRECTORY_SEPARATOR . $file_path . ' file was created');
        return config('ray.basedir') . DIRECTORY_SEPARATOR . $file_path;

    }
}
