<?php

namespace Askaoru\ComposerCleaner;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ComposerCleanerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'composer-clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean the composer vendor libraries';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vendorDir = realpath(config('cleaner.dir'));
        $rules = config('cleaner.rules');
        $filesystem = new Filesystem();

        foreach ($rules as $packageBaseDir => $rule) {
            if (!file_exists($vendorDir . '/' . $packageBaseDir)){
                continue;
            }

            $patterns = explode(' ', $rule);
            foreach($patterns as $pattern) {
                try {
                    $finder = new Finder();
                    $finder->name($pattern)->in( $vendorDir . '/' . $packageBaseDir);
                    $files = iterator_to_array($finder);

                    foreach($files as $file){
                        if ($file->isDir()) {
                            $filesystem->deleteDirectory($file);
                        } elseif($file->isFile()) {
                            $filesystem->delete($file);
                        }
                    }
                } catch(\Exception $e){
                    $this->error("Could not parse $packageBaseDir ($pattern): ".$e->getMessage());
                }
            }
        }
    }
}