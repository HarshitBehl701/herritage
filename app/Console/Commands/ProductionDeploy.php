<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProductionDeploy extends Command
{
    protected $signature = 'production:deploy';

    protected $description = 'Prepare application for production';

    public function handle(): int
    {
        $envPath = base_path('.env');

        $env = file_get_contents($envPath);

        $replacements = [
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'false',
            'DEBUGBAR_ENABLED' => 'false',
            'SESSION_DRIVER' => 'database',
            'CACHE_STORE' => 'database',
            'QUEUE_CONNECTION' => 'database',
        ];

        foreach ($replacements as $key => $value) {
            $env = preg_replace(
                "/^{$key}=.*$/m",
                "{$key}={$value}",
                $env
            );
        }

        file_put_contents($envPath, $env);

        $this->info('Environment updated.');

        Artisan::call('key:generate', [
            '--force' => true,
        ]);

        $this->info(Artisan::output());

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');

        $this->info('Production deployment completed.');

        return self::SUCCESS;
    }
}