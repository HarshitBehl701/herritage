<?php

namespace App\Services\Locations;

use App\Models\LocationClosures;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LocationClosureRepository
{
    private string $cachePrefix;

    public function __construct()
    {
        $this->cachePrefix = config('app.cache.prefix', 'seo:v2:') . 'location-closures:';
    }

    private function ttl(?int $ttl = null): int
    {
        return $ttl ?? (int) config('app.cache.locations_ttl', 604800);
    }

    private function key(string $suffix): string
    {
        return $this->cachePrefix . $suffix;
    }

    /**
     * Check direct parent -> child relationship.
     */
    public function isDirectChild(
        int $parentId,
        int $childId,
        ?int $ttl = null
    ): bool {
        $ttl = $this->ttl($ttl);
        return Cache::remember(
            $this->key("direct:{$parentId}:{$childId}"),
            $ttl,
            static fn (): bool => LocationClosures::query()
                ->where('ancestor_id', $parentId)
                ->where('descendant_id', $childId)
                ->where('depth', 1)
                ->exists()
        );
    }

    /**
     * Get active/selected ancestors.
     */
    public function getAncestors(
        int $descendantId,
        ?int $ttl = null
    ): Collection {
        $ttl = $this->ttl($ttl);
        return Cache::remember(
            $this->key("ancestors:{$descendantId}"),
            $ttl,
            static function () use ($descendantId): Collection {
                return LocationClosures::query()
                    ->join(
                        'locations',
                        'locations.id',
                        '=',
                        'location_closures.ancestor_id'
                    )
                    ->where('location_closures.descendant_id', $descendantId)
                    ->where('locations.is_selected', true)
                    ->where('locations.is_active', true)
                    ->select([
                        'locations.id',
                        'locations.slug',
                        'locations.type',
                    ])
                    ->orderBy('location_closures.depth')
                    ->get();
            }
        );
    }

    /**
     * Get only ancestor slugs.
     */
    public function getAncestorSlugs(
        int $descendantId,
        ?int $ttl = null
    ): array {
        $ttl = $this->ttl($ttl);
        return Cache::remember(
            $this->key("ancestor_slugs:{$descendantId}"),
            $ttl,
            static function () use ($descendantId): array {
                return LocationClosures::query()
                    ->join(
                        'locations',
                        'locations.id',
                        '=',
                        'location_closures.ancestor_id'
                    )
                    ->where('location_closures.descendant_id', $descendantId)
                    ->where('locations.is_selected', true)
                    ->where('locations.is_active', true)
                    ->orderBy('location_closures.depth')
                    ->pluck('locations.slug')
                    ->all();
            }
        );
    }

    /**
     * Get direct parent/child relationships
     * between the supplied location IDs.
     */
    public function getDirectRelations(
        array $locationIds,
        ?int $ttl = null
    ): Collection {
        $ttl = $this->ttl($ttl);
        if (empty($locationIds)) {
            return collect();
        }

        $locationIds = array_values(array_unique(array_map('intval', $locationIds)));
        sort($locationIds, SORT_NUMERIC);

        $hash = md5(implode(',', $locationIds));

        return Cache::remember(
            $this->key("direct_relations:{$hash}"),
            $ttl,
            static fn (): Collection => LocationClosures::query()
                ->select([
                    'ancestor_id',
                    'descendant_id',
                ])
                ->where('depth', 1)
                ->whereIn('ancestor_id', $locationIds)
                ->whereIn('descendant_id', $locationIds)
                ->get()
        );
    }
}