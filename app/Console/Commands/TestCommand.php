<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sean:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = app_path() . "/Models";
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = explode('\\', substr($result,0,-4));
            $out[] = end($filename);
        }

        $methods = [];
        foreach ($out as $model) {
            $methods[] = "{$model}:index";
            $methods[] = "{$model}:create";
            $methods[] = "{$model}:update";
            $methods[] = "{$model}:delete";
            $methods[] = "{$model}:view";
        }

        dd(implode(',', $methods));
    }
}
