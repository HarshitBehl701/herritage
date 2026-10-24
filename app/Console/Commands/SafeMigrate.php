<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SafeMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'safe:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import location data and run migrations safely';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = base_path('DatabaseLocations');

        $files = [
            'locations.sql',
            'location_closures.sql',
        ];

        // Import only if locations table doesn't exist
        if (!Schema::hasTable('locations')) {

            $this->info('Importing location SQL files...');

            foreach ($files as $file) {

                $filePath = $path . DIRECTORY_SEPARATOR . $file;

                if (!file_exists($filePath)) {
                    $this->error("File not found: {$file}");
                    return self::FAILURE;
                }

                $this->line("Importing {$file}");

                DB::unprepared(
                    file_get_contents($filePath)
                );
            }

            $this->info('Location data imported successfully.');
        } else {
            $this->info('Locations table already exists. Skipping import.');
        }

        $this->info('Running migrations...');

        Artisan::call('migrate', [
            '--force' => true,
        ]);

        $this->line(Artisan::output());

        $this->info('Migration completed successfully.');

        // Run User Seeder after migrations
        $this->info('Running User Seeder...');

        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\UserSeeder::class,
            '--force' => true,
        ]);

        $this->line(Artisan::output());

        $this->info('User seeder completed successfully.');

        return self::SUCCESS;
    }
}