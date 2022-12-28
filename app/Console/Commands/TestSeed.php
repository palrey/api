<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TestSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed databases for testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:fresh --seed --seeder FakeSeeder');
        Artisan::call('module:seed --class FakeSeeder');
        $this->info('Database Seeding Done!!!');
        Artisan::call('test');
    }
}
