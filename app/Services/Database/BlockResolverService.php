<?php

namespace App\Services\Database;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use ReflectionClass;
use SplObjectStorage;

class BlockResolverService
{
    /**
     * Cached contextual method metadata.
     *
     * [needle][modelClass] => method names
     */
    private static array $contextMethodCache = [];

    /**
     * Cached model versions for the lifetime of the PHP worker/request.
     */
    private static array $modelVersionCache = [];

    /**
     * Resolve one configured data block.
     *
     * $context:
     * - matchValue
     * - location
     * - locationId
     * - keyword
     *
     * $contextual determines whether location/keyword contextual
     * model methods should be hydrated.
     */
    public function resolve(
        array $config,
        array $context = [],
        bool $contextual = false,
        ?int $ttl = null,
        bool $cache = true,
    ): array {
        $this->validateConfig($config);

        try {
            $modal = new ModalService(
                $config['modal'],
                $config['modal_dir'] ?? ''
            );
        } catch (\InvalidArgumentException) {
            return [];
        }

        $model = $modal->query()->getModel();

        $eagerLoads = [];
        $postLoads = [];
        $relatedModels = [];

        $this->resolveConfiguredRelations(
            $model,
            $config['with'] ?? [],
            $eagerLoads,
            $postLoads,
            $relatedModels
        );

        $cacheKey = $this->cacheKey(
            $config,
            $context,
            $contextual,
            $model,
            $relatedModels
        );

        $loader = function () use (
            $config,
            $context,
            $contextual,
            $modal,
            $eagerLoads,
            $postLoads
        ): array {
            return $this->load(
                $modal,
                $config,
                $context,
                $contextual,
                $eagerLoads,
                $postLoads
            );
        };

        if (!$cache) {
            return $loader();
        }

        return Cache::remember(
            $cacheKey,
            $ttl ?? (int) config('app.cache.default_ttl', 604800),
            $loader
        );
    }

    // ============================================================
    // CACHE
    // ============================================================

    private function cacheKey(
        array $config,
        array $context,
        bool $contextual,
        Model $model,
        array $relatedModels,
    ): string {
        $payload = [
            'modal' => get_class($model),
            'config' => $this->normalize($config),

            /*
             * Only values that affect SQL/context are included.
             */
            'matchValue' => $context['matchValue'] ?? null,
        ];

        if ($contextual) {
            $payload['location'] = $context['location'] ?? null;
            $payload['locationId'] = $context['locationId'] ?? null;
            $payload['keyword'] = $context['keyword'] ?? null;
        }

        $payload['version'] = $this->modelVersion($model);
        $payload['relatedVersions'] = $this->relatedModelVersions($relatedModels);

        return 'block:v2:' . hash(
            'sha256',
            json_encode(
                $this->normalize($payload),
                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            )
        );
    }

    private function modelVersion(Model $model): int
    {
        return $this->modelVersionForClass($model::class);
    }

    private function modelVersionForClass(string $modelClass): int
    {
        $class = str_replace('\\', '_', strtolower($modelClass));

        if (isset(self::$modelVersionCache[$class])) {
            return self::$modelVersionCache[$class];
        }

        return self::$modelVersionCache[$class] = (int) Cache::get(
            config('app.cache.prefix', 'seo:v2:') . "model_{$class}_version",
            1
        );
    }

    private function relatedModelVersions(array $modelClasses): array
    {
        $versions = [];

        foreach (array_keys($modelClasses) as $modelClass) {
            $versions[$modelClass] = $this->modelVersionForClass($modelClass);
        }

        ksort($versions);

        return $versions;
    }

    /**
     * Canonicalize arrays without destroying associative keys.
     */
    private function normalize(mixed $value): mixed
    {
        if (!is_array($value)) {
            return $value;
        }

        if (array_is_list($value)) {
            return array_map(
                fn ($item) => $this->normalize($item),
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

    // ============================================================
    // BLOCK LOADING
    // ============================================================

    private function load(
        ModalService $modal,
        array $config,
        array $context,
        bool $contextual,
        array $eagerLoads,
        array $postLoads,
    ): array {
        $query = $modal->query();

        $this->applySelect($query, $config);
        $this->applyConditions($query, $config['condition'] ?? []);
        $this->applyOrdering($query, $config['order'] ?? []);

        $matchValue = $context['matchValue'] ?? null;

        $single = $this->isSingleMode(
            $config,
            $matchValue
        );

        if ($single) {
            $query->where(
                $config['search']['column'],
                $matchValue
            );
        }

        if ($eagerLoads !== []) {
            $query->with($eagerLoads);
        }

        /*
         * Single mode
         */
        if ($single) {
            $model = $query->first();

            if (!$model instanceof Model) {
                return [];
            }

            $this->applyPostLoads($model, $postLoads);

            if ($contextual) {
                $this->hydrateContextual(
                    $model,
                    $context
                );
            }

            return $model->toArray();
        }

        /*
         * Collection mode
         */
        $items = $query->get();

        if ($items->isEmpty()) {
            return [];
        }

        foreach ($items as $item) {
            if (!$item instanceof Model) {
                continue;
            }

            $this->applyPostLoads(
                $item,
                $postLoads
            );

            if ($contextual) {
                $this->hydrateContextual(
                    $item,
                    $context
                );
            }
        }

        $result = $items
            ->map(
                static fn ($item) =>
                    $item instanceof Model
                        ? $item->toArray()
                        : (array) $item
            )
            ->all();

        if (!empty($config['first'])) {
            return $result[0] ?? [];
        }

        if (!empty($config['tree'])) {
            return $this->buildTree($result);
        }

        return $result;
    }

    // ============================================================
    // QUERY
    // ============================================================

    private function applySelect(
        Builder $query,
        array $config
    ): void {
        if (!empty($config['select'])) {
            $query->select($config['select']);
        }
    }

    private function applyOrdering(
        Builder $query,
        array $orders
    ): void {
        foreach ($orders as $column => $direction) {
            $query->orderBy(
                $column,
                strtolower((string) $direction) === 'desc'
                    ? 'desc'
                    : 'asc'
            );
        }
    }

    private function applyConditions(
        Builder $query,
        array $conditions
    ): void {
        foreach ($conditions as $key => $value) {
            if ($key === 'or' && is_array($value)) {
                $query->where(function (Builder $q) use ($value) {
                    $this->applyConditions($q, $value);
                });

                continue;
            }

            if (
                preg_match(
                    '/^(.+?)\s*(=|!=|>=|<=|>|<|in|between)$/i',
                    $key,
                    $matches
                )
            ) {
                $column = trim($matches[1]);
                $operator = strtolower($matches[2]);
            } else {
                $column = $key;
                $operator = '=';
            }

            /*
             * Column names come from your trusted config, not user input.
             */
            match ($operator) {
                'in' => $query->whereIn(
                    $column,
                    (array) $value
                ),

                'between' => $query->whereBetween(
                    $column,
                    $value
                ),

                default => $query->where(
                    $column,
                    $operator,
                    $value
                ),
            };
        }
    }

    // ============================================================
    // RELATIONS
    // ============================================================

    private function resolveConfiguredRelations(
        Model $model,
        array|string $relations,
        array &$eagerLoads,
        array &$postLoads,
        array &$relatedModels,
    ): void {
        foreach ((array) $relations as $name) {
            if (!is_string($name) || !method_exists($model, $name)) {
                continue;
            }

            $reflection = new \ReflectionMethod(
                $model,
                $name
            );

            if (
                $reflection->isStatic() ||
                $reflection->isConstructor()
            ) {
                continue;
            }

            /*
             * Never invoke methods which require arguments.
             */
            if ($reflection->getNumberOfRequiredParameters() > 0) {
                continue;
            }

            $result = $model->{$name}();

            if ($result instanceof Relation) {
                $eagerLoads[] = $name;
                $relatedModels[$result->getRelated()::class] = true;
                continue;
            }

            if ($result instanceof Builder) {
                $postLoads[] = $name;
                $relatedModels[$result->getModel()::class] = true;
            }
        }
    }

    private function applyPostLoads(
        Model $model,
        array $postLoads
    ): void {
        foreach ($postLoads as $method) {
            $value = $model->{$method}();

            if ($value instanceof Relation) {
                $value = $value->getResults();
            } elseif ($value instanceof Builder) {
                $value = $value->get();
            }

            $model->setRelation(
                $method,
                $value
            );
        }
    }

    // ============================================================
    // CONTEXTUAL RELATIONS
    // ============================================================

    private function hydrateContextual(
        Model $model,
        array $context
    ): void {
        $visited = new SplObjectStorage();

        $this->hydrateContextualRecursive(
            $model,
            $context,
            $visited
        );
    }

    private function hydrateContextualRecursive(
        Model $model,
        array $context,
        SplObjectStorage $visited,
    ): void {
        /*
         * Prevent relation cycles:
         *
         * Product -> Category -> Product -> Category ...
         */
        if ($visited->contains($model)) {
            return;
        }

        $visited->attach($model);

        $locationValue =
            $context['locationId']
            ?? $context['location']
            ?? null;

        $keywordValue =
            $context['keyword']
            ?? null;

        if ($locationValue !== null) {
            $this->applyContextualMethods(
                $model,
                $this->matchingMethods(
                    $model,
                    'location'
                ),
                $locationValue
            );
        }

        if ($keywordValue !== null) {
            $this->applyContextualMethods(
                $model,
                $this->matchingMethods(
                    $model,
                    'keyword'
                ),
                $keywordValue
            );
        }

        foreach ($model->getRelations() as $relation) {
            if ($relation instanceof Model) {
                $this->hydrateContextualRecursive(
                    $relation,
                    $context,
                    $visited
                );

                continue;
            }

            if (!$relation instanceof Collection) {
                continue;
            }

            foreach ($relation as $related) {
                if ($related instanceof Model) {
                    $this->hydrateContextualRecursive(
                        $related,
                        $context,
                        $visited
                    );
                }
            }
        }
    }

    private function matchingMethods(
        Model $model,
        string $needle
    ): array {
        $class = get_class($model);

        if (
            isset(
                self::$contextMethodCache[$needle][$class]
            )
        ) {
            return self::$contextMethodCache[$needle][$class];
        }

        $methods = [];

        foreach (
            (new ReflectionClass($model))
                ->getMethods(\ReflectionMethod::IS_PUBLIC)
            as $method
        ) {
            if (
                $method->isStatic() ||
                $method->isConstructor()
            ) {
                continue;
            }

            if (
                $method->getDeclaringClass()->getName() !== $class
            ) {
                continue;
            }

            if (
                $method->getNumberOfParameters() < 1
            ) {
                continue;
            }

            if (
                !str_contains(
                    strtolower($method->getName()),
                    strtolower($needle)
                )
            ) {
                continue;
            }

            $methods[] = $method->getName();
        }

        return self::$contextMethodCache[$needle][$class] = $methods;
    }

    private function applyContextualMethods(
        Model $model,
        array $methods,
        mixed $argument
    ): void {
        foreach ($methods as $method) {
            $value = $model->{$method}($argument);

            if ($value instanceof Relation) {
                $value = $value->getResults();
            } elseif ($value instanceof Builder) {
                $value = $value->get();
            }

            $model->setRelation(
                $method,
                $value
            );
        }
    }

    // ============================================================
    // TREE
    // ============================================================

    private function buildTree(array $items): array
    {
        $grouped = [];

        foreach ($items as $item) {
            $parentId = $item['parent_id'] ?? null;

            $grouped[$parentId][] = $item;
        }

        $build = function ($parentId) use (
            &$build,
            &$grouped
        ): array {
            $branch = [];

            foreach (
                $grouped[$parentId] ?? []
                as $item
            ) {
                $item['children'] =
                    $build($item['id']);

                $branch[] = $item;
            }

            return $branch;
        };

        return $build(null);
    }

    // ============================================================
    // VALIDATION
    // ============================================================

    private function validateConfig(
        array $config
    ): void {
        if (empty($config['modal'])) {
            throw new \InvalidArgumentException(
                'Block config requires a modal.'
            );
        }

        if (
            !empty($config['tree']) &&
            !in_array(
                'id',
                $config['select'] ?? [],
                true
            )
        ) {
            throw new \InvalidArgumentException(
                "Tree mode requires 'id' in select."
            );
        }
    }

    private function isSingleMode(
        array $config,
        mixed $matchValue
    ): bool {
        return !empty(
            $config['search']['column']
        ) && $matchValue !== null
            && $matchValue !== '';
    }
}