<?php

namespace BitPixel\SpringCms\Commands;

use Illuminate\Console\Command;
use BitPixel\SpringCms\Models\TemplatePage;

class CacheViewFilesCommand extends Command
{
    public $signature = 'springcms:cache-views';

    public $description = 'Cache blade view files';

    const VIEW_DIR = 'resources/views/_cache/';

    public function handle()
    {
        $this->ensureViewDirExists();

        $this->writeFiles();

    }

    private function ensureViewDirExists()
    {
        $dir = base_path(self::VIEW_DIR);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }
        /*$dir = base_path(self::VIEW_DIR . '/layouts');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }*/
    }

    private function writeFiles()
    {
        $files = TemplatePage::all();
        foreach ($files as $file) {
            $filename = self::VIEW_DIR . $file->filename;
            file_put_contents(base_path($filename), $file->code);
        }
    }
}
