<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Artisan;

class ApplicationController extends Controller
{
    public function optimize()
    {
        $app = Container::getInstance();

        try {
            // Clear application all cache
            $exitCode = Artisan::call('optimize:clear');

            if ($exitCode !== 0) {
                Container::setInstance($app);

                return redirect('/')
                    ->with('error', 'Failed to clear application cache.');
            }

            // Rebuild Laravel optimization caches
            $exitCode = Artisan::call('optimize');

            // Restore original HTTP application
            Container::setInstance($app);

            if ($exitCode !== 0) {
                return redirect('/')
                    ->with('error', 'Optimization command failed.');
            }

            return redirect('/')
                ->with('success', 'Successfully Executed The Command');

        } catch (\Throwable $e) {
            Container::setInstance($app);

            return redirect('/')
                ->with(
                    'error',
                    'Something Went Wrong While Executing The Command: ' . $e->getMessage()
                );
        }
    }

    public function sitemap(string $version = '1')
    {
        try {
            $version = (int) $version;
            $maxVersion = (int) config('app.sitemap_max_versions');

            if ($version < 1 || $version > $maxVersion) {
                return redirect('/')
                    ->with('error', 'Invalid Sitemap Version');
            }

            $exitCode = Artisan::call("sitemap:v{$version}");

            if ($exitCode !== 0) {
                return redirect('/')
                    ->with('error', 'Sitemap generation failed: ' . Artisan::output());
            }

            return redirect('/')
                ->with('success', 'Sitemap generated successfully');

        } catch (\Throwable $e) {
            return redirect('/')
                ->with(
                    'error',
                    'Something went wrong while generating the sitemap: ' . $e->getMessage()
                );
        }
    }
}