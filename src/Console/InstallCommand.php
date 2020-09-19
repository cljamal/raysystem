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
        $this->makeFile('boot.php', __DIR__ . '/install_stubs/boot.stub');

        // Create base Controller & Model
        $this->makeFile('Modules/Base/Controllers/BaseController.php', __DIR__ . '/install_stubs/BaseController.stub');
        $this->makeFile('Modules/Base/Models/BaseModel.php', __DIR__ . '/install_stubs/BaseModel.stub');
    }

    /**
     * Make new directory.
     *
     * @param string $paths
     */
    protected function makeDir( $paths = '' )
    {
        if ( !is_array($paths) )
            $paths = [ $paths ];

        foreach ($paths as $path)
        {
            if ( is_dir( $path ) ){
                $this->line("<error>". $path ." directory already exists !</error> ");
                continue;
            }

            $paths_exploded = explode(DIRECTORY_SEPARATOR, $path);
            $current_path = null;

            foreach ($paths_exploded as $index => $_path )
            {
                if ( $index == 0 )
                    $current_path = $_path;

                if ( $index != 0 )
                    $current_path = $current_path . DIRECTORY_SEPARATOR . $_path;

                if ( !is_dir( $current_path ) ){
                    $this->laravel['files']->makeDirectory( $current_path, 0755, true, true);
                    if ( count($paths_exploded) == ($index + 1) ){
                        $this->line('<fg=blue>'. $current_path . ' directory was created</>');
                    }
                }
            }
        }
    }

    /**
     * Making a file
     *
     * @param $filename
     * @param $stub
     * @return string|void
     */
    protected function makeFile( $filename, $stub ){
        $tmpPath = config('ray.basedir') . DIRECTORY_SEPARATOR .str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filename );
        $file_exploded  = explode( DIRECTORY_SEPARATOR, $tmpPath );
        $file = array_pop($file_exploded);
        $path = implode( DIRECTORY_SEPARATOR, $file_exploded );
        $file_path = $path . DIRECTORY_SEPARATOR . $file;

        if ( !is_dir($path) ){
            $this->makeDir($path);
        }

        if ( is_file( $file_path ) )
        {
            $this->line("<error>". $file_path ." file already exists !</error> ");
            return;
        }

        $content = File::get($stub);
        $this->laravel['files']->put( $file_path, $content );
        $this->line('<fg=yellow>'. $file_path . ' file was created</>');
        return $file_path;
    }
}
