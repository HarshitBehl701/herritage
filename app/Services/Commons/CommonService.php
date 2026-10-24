<?php

namespace App\Services\Commons;

use App\Services\Database\BlockResolverService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CommonService
{
    public function pages(
        string $path,
        ?int $ttl = null
    ): array {
        $key = config('app.cache.prefix', 'seo:v2:') . 'pages:' . hash('sha256', $path);

        $callback = fn (): array => $this->loadPages($path);

        return Cache::remember(
            $key,
            $ttl ?? (int) config('app.cache.pages_ttl', 604800),
            $callback
        );
    }

    /**
     * Resolve common blocks.
     *
     * No cache here.
     * PageDataService will cache the complete page data.
     */
    public function commons(
        string|array|null $only = null,
        array $overrides = []
    ): array {
        return $this->resolve(
            $only,
            $overrides
        );
    }

    private function resolve(
        string|array|null $only,
        array $overrides
    ): array {
        $configs = config('commons', []);
        $result = [];

        if (is_array($only)) {
            $configs = array_intersect_key(
                $configs,
                array_flip($only)
            );
        } elseif (
            is_string($only) &&
            isset($configs[$only])
        ) {
            $configs = [
                $only => $configs[$only],
            ];
        }

        $blocks = app(
            BlockResolverService::class
        );

        foreach ($configs as $key => $config) {
            /*
             * Flat block
             */
            if (isset($config['modal'])) {
                if (isset($overrides[$key])) {
                    $config = $this->applyOverride(
                        $config,
                        $overrides[$key]
                    );
                }

                $result[$key] = $blocks->resolve(
                    $config,
                    cache: true
                );

                continue;
            }

            /*
             * Grouped blocks
             */
            foreach ((array) $config as $childKey => $childConfig) {
                if (
                    !is_array($childConfig) ||
                    empty($childConfig['modal'])
                ) {
                    continue;
                }

                if (
                    isset(
                        $overrides[$key][$childKey]
                    )
                ) {
                    $childConfig = $this->applyOverride(
                        $childConfig,
                        $overrides[$key][$childKey]
                    );
                }

                $result[$key][$childKey] =
                    $blocks->resolve(
                        $childConfig,
                        cache: true
                    );
            }
        }

        return $result;
    }

    private function applyOverride(
        array $config,
        mixed $override
    ): array {
        if (array_is_list($override)) {
            $config['select'] = $override;
        } elseif (is_array($override)) {
            $config = array_merge(
                $config,
                $override
            );
        }

        return $config;
    }

    private function loadPages(string $path): array
    {
        if (!File::isDirectory($path)) {
            return [];
        }

        return collect(File::files($path))
            ->map(
                static fn ($file): string => Str::replace(
                    '.blade.php',
                    '',
                    $file->getFilename()
                )
            )
            ->values()
            ->all();
    }

    public function isPageRequireDynamicContent(
        string $page
    ): bool {
        return array_key_exists(
            $page,
            config('page_content', [])
        );
    }
}