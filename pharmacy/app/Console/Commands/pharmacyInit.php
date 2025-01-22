<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class pharmacyInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pharmacy-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init pharmacy project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $exitCode = Artisan::call('migrate');

        $this->info("migrated pharmacy project exec: $exitCode");

        $seederExit = Artisan::call('db:seed', ["--class" => "DatabaseSeeder"]);

        $this->info("seeder pharmacy project exec: $seederExit");
    }
}
