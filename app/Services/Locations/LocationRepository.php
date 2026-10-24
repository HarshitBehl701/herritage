<?php

namespace App\Services\Locations;

use App\Models\Location;
use Illuminate\Support\Facades\Cache;

class LocationRepository
{
    protected string $tag;

    public function __construct()
    {
        $this->tag = config('app.cache.prefix', 'seo:v2:') . 'locations:';
    }

    private function ttl(?int $ttl = null): int
    {
        return $ttl ?? (int) config('app.cache.locations_ttl', 604800);
    }

    private function negativeTtl(): int
    {
        return (int) config('app.cache.negative_ttl', 3600);
    }

    protected function key(string $suffix): string
    {
        return "{$this->tag}_{$suffix}";
    }

   
    protected function keyFor(string $prefix, array $parts): string
    {
        return $this->key($prefix . '_' . md5(json_encode($parts, JSON_THROW_ON_ERROR)));
    }

    protected function rememberNullable(string $key, int $ttl, \Closure $callback): mixed
    {
        $miss = self::class . '::miss';
        $cached = Cache::get($key, $miss);

        if ($cached !== $miss) {
            return $cached === false ? null : $cached;
        }

        $value = $callback();

        Cache::put($key, $value ?? false, $value === null ? $this->negativeTtl() : $ttl);

        return $value;
    }

    // ----------------------------------------------------
    // GET SINGLE LOCATION BY SLUG + TYPE
    // ----------------------------------------------------
    public function getBySlugAndType(string $slug, string $type, ?int $ttl = null): ?Location
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->keyFor('slug_type', ['slug' => $slug, 'type' => $type]);

        return $this->rememberNullable($cacheKey, $ttl, function () use ($slug, $type) {
            return Location::query()
                ->select(['id', 'slug', 'type'])
                ->where('slug', $slug)
                ->where('type', $type)
                ->where('is_selected', true)
                ->where('is_active', true)
                ->first();
        });
    }

    // ----------------------------------------------------
    // GET CHILDREN (DIRECT ONLY)
    // ----------------------------------------------------
    public function getChildrenSlugs(int $ancestorId, ?int $ttl = null): array
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->key("children_slugs_{$ancestorId}");

        return Cache::remember($cacheKey, $ttl, function () use ($ancestorId) {
            return Location::query()
                ->whereIn('id', function ($query) use ($ancestorId) {
                    $query->select('descendant_id')
                        ->from('location_closures')
                        ->where('ancestor_id', $ancestorId)
                        ->where('depth', 1)
                        ->where('is_selected', true);
                })
                ->pluck('slug')
                ->toArray();
        });
    }

    // ----------------------------------------------------
    // GET ROOT LOCATIONS (country or states)
    // ----------------------------------------------------
    public function getByType(string $type, ?int $ttl = null): array
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->key("type_{$type}");

        return Cache::remember($cacheKey, $ttl, function () use ($type) {
            return Location::query()
                ->where('type', $type)
                ->where('is_selected', true)
                ->pluck('slug')
                ->toArray();
        });
    }

    // ----------------------------------------------------
    // GET PARENT SLUGS USING SIMPLE JOIN
    // ----------------------------------------------------
    public function getParentsSlugs(int $descendantId, bool $includeCountry = false, ?int $ttl = null): array
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->keyFor('parents', ['descendantId' => $descendantId, 'includeCountry' => $includeCountry]);

        return Cache::remember($cacheKey, $ttl, function () use ($descendantId, $includeCountry) {
            return Location::query()
                ->whereIn('id', function ($q) use ($descendantId) {
                    $q->select('ancestor_id')
                        ->from('location_closures')
                        ->where('descendant_id', $descendantId);
                })
                ->when(
                    !$includeCountry,
                    fn($q) =>
                    $q->where('type', '!=', 'country')
                )
                ->where('is_selected', true)
                ->where('is_active', true)
                ->pluck('slug')
                ->toArray();
        });
    }

    // ----------------------------------------------------
    // GET LOCATION BY SLUG + TYPE + PARENT FILTER
    // ----------------------------------------------------
    public function getBySlugTypeAndParent(string $slug, string $type, ?int $parentId, ?int $ttl = null): ?Location
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->keyFor('slug_type_parent', ['slug' => $slug, 'type' => $type, 'parentId' => $parentId]);

        return $this->rememberNullable($cacheKey, $ttl, function () use ($slug, $type, $parentId) {
            return Location::query()
                ->select(['id', 'slug', 'type'])
                ->where('slug', $slug)
                ->where('type', $type)
                ->when($parentId !== null, function ($q) use ($parentId) {
                    $q->whereIn('id', function ($sub) use ($parentId) {
                        $sub->select('descendant_id')
                            ->from('location_closures')
                            ->where('ancestor_id', $parentId)
                            ->where('depth', 1);
                    });
                })
                ->where('is_selected', true)
                ->where('is_active', true)
                ->first();
        });
    }

    public function getBySlug(string $slug, ?int $ttl = null): ?Location
    {
        $ttl = $this->ttl($ttl);
        $cacheKey = $this->key("get_by_slug_{$slug}");

        return $this->rememberNullable($cacheKey, $ttl, function () use ($slug) {
            return Location::query()
                ->select(['id', 'slug', 'type'])
                ->where('slug', $slug)
                ->where('is_selected', true)
                ->where('is_active', true)
                ->first();
        });
    }

    public function getAllSelectedActive(?int $ttl = null)
    {
        $ttl = $this->ttl($ttl);
        $key = $this->key("all_selected_active");

        return Cache::remember($key, $ttl, function () {
            return Location::query()
                ->select(['id', 'slug', 'type'])
                ->where('is_selected', true)
                ->where('is_active', true)
                ->get();
        });
    }
}