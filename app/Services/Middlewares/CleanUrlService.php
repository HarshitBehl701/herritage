<?php

namespace App\Services\Middlewares;

use App\DTO\CleanUrlDTO;
use App\Services\Commons\CommonService;
use App\Services\Keywords\KeywordService;
use App\Services\Database\ModalService;
use App\Services\Locations\LocationsService;
use Illuminate\Support\Facades\Cache;

class CleanUrlService
{
    protected CleanUrlDTO $result;
    protected ?LocationsService $locationService = null;

    public function __construct(
        public array $params = [],
    ) {
        $this->result = new CleanUrlDTO();
    }

    public function resolve(?int $ttl = null): CleanUrlDTO
    {
        return Cache::remember(
            $this->getCacheKey(),
            $ttl ?? $this->cacheTtl(),
            fn(): CleanUrlDTO => $this->resolveParams()
        );
    }

    private function cacheTtl(): int
    {
        return (int) config(
            'app.cache.clean_url_ttl',
            config('app.cache.default_ttl', 604800)
        );
    }

    private function getCacheKey(): string
    {
        return config('app.cache.prefix', 'seo:v2:') . $this->cachePrefix() . hash(
            'sha256',
            json_encode(
                $this->normalize($this->params),
                JSON_THROW_ON_ERROR
            )
        );
    }

    private function normalize(mixed $value): mixed
    {
        if (!is_array($value)) {
            return $value;
        }

        if (array_is_list($value)) {
            return array_map(
                fn($item) => $this->normalize($item),
                $value
            );
        }

        ksort($value);

        $result = [];

        foreach ($value as $key => $item) {
            $result[$key] = $this->normalize($item);
        }

        return $result;
    }

    public function resolveParams(): CleanUrlDTO
    {
        if (!$this->resolvePage()) {
            return $this->result;
        }

        $location = ($this->params['location'] ?? null)
            === ($this->params['page'] ?? null)
            ? null
            : ($this->params['location'] ?? null);

        $slug = $this->params['slug'] ?? null;

        if (
            $slug !== null &&
            $slug !== '' &&
            !$this->resolveSlug($slug)
        ) {
            return $this->result;
        }

        if (
            $location !== null &&
            $location !== ''
        ) {
            $this->locationService =
                new LocationsService($location);

            if (!$this->validateLocation($location)) {
                return $this->result;
            }

            if (!$this->getCurrentLocationParents($location)) {
                return $this->result;
            }
        }

        $keyword = $this->params['keyword'] ?? null;

        if (
            $keyword !== null &&
            $keyword !== '' &&
            !$this->validateKeyword($keyword)
        ) {
            return $this->result;
        }

        if (!$this->result->page) {
            return $this->result;
        }

        return $this->result->isRouteValid(true);
    }

    // ========================================================
    // PAGE
    // ========================================================

    private function resolvePage(): bool
    {
        $targetPage = $this->params['page'] ?? null;

        if (!$targetPage) {
            return false;
        }

        $staticPages = app(CommonService::class)->pages(
            resource_path(
                config(
                    'app.static_pages_path',
                    'views/client/pages'
                )
            )
        );

        if (
            in_array(
                $targetPage,
                $staticPages,
                true
            )
        ) {
            $this->params['page'] = $targetPage;

            $this->result =
                $this->result->withPage($targetPage);

            return true;
        }

        $locationAsPage =
            $this->params['location'] ?? null;

        if (
            $locationAsPage &&
            in_array(
                $locationAsPage,
                $staticPages,
                true
            )
        ) {
            $this->params = [
                'page' => $locationAsPage,
                'location' => null,
                'keyword' =>
                    $this->params['slug'] ?? null,
                'slug' =>
                    $this->params['page'],
            ];

            $this->result =
                $this->result->withPage(
                    $locationAsPage
                );

            return true;
        }

        return false;
    }

    // ========================================================
    // SLUG
    // ========================================================

    private function resolveSlug(
        string $targetSlug
    ): bool {
        foreach (
            config(
                'modals_group_structure.slug_group',
                []
            ) as $modalPath => $modalName
        ) {
                try {
                    $modal = new ModalService($modalName);
                } catch (\InvalidArgumentException) {
                    continue;
                }

            $record = $this->findBySlug(
                $modal,
                $targetSlug
            );

            if (!$record) {
                continue;
            }

            $this->result = $this->result
                ->withSlug($targetSlug)
                ->withModal($modalPath)
                ->withSlugId($record->id);

            return true;
        }

        return false;
    }

    private function findBySlug(
        ModalService $modal,
        string $targetSlug
    ): mixed {
        $column = $modal->hasColumn('slug')
            ? 'slug'
            : 'slug_url';

        return $modal->first([
            $column => $targetSlug,
        ]);
    }

    // ========================================================
    // LOCATION
    // ========================================================

    private function validateLocation(
        string $location
    ): bool {
        $service = $this->locationService
            ??= new LocationsService($location);

        if (!$service->validate_location()) {
            return false;
        }

        $this->result = $this->result
            ->withLocation($location)
            ->withLocationId(
                $service->getCurrentLocationId()
            );

        return true;
    }

    private function getCurrentLocationParents(
        string $location
    ): bool {
        $service = $this->locationService
            ??= new LocationsService($location);

        $parentLocations =
            $service->getParentLocations();

        if (!$parentLocations) {
            return false;
        }

        $this->result =
            $this->result->withLocationParents(
                $parentLocations
            );

        return true;
    }

    private function validateKeyword(
        string $currentKeyword
    ): bool {
        $service = app(
            KeywordService::class,
            [
                'clean_url' => $this->result,
            ]
        );

        if (
            !$service->validateKeyword(
                $currentKeyword
            )
        ) {
            return false;
        }

        $this->result = $this->result
            ->withKeyword($currentKeyword)
            ->withKeywords(
                $service->getKeywords()
            );

        return true;
    }

    private function cachePrefix(): string
    {
        return 'clean-url:';
    }
}