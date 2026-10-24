<?php

namespace App\Services\Database;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ModalService
{
    protected $model;
    protected string $tag;
    protected string $versionKey;

    private static array $versionCache = [];
    private static array $columnCache = [];

    public function __construct(string $modelName, string $dir = '')
    {
        $this->model = $this->resolveModel($modelName, $dir);

        $modelClass = str_replace('\\', '_', strtolower($this->model::class));
        $this->tag = config('app.cache.prefix', 'seo:v2:') . 'model_' . $modelClass;
        $this->versionKey = $this->tag . '_version';
    }

    public function query()
    {
        return $this->model->newModelQuery();
    }

    public function getVersionKey(): string
    {
        return $this->versionKey;
    }

    public function hasColumn(string $column): bool
    {
        $connection = $this->model->getConnectionName()
            ?? config('database.default');
        $table = $this->model->getTable();
        $key = implode(':', [$connection, $table, $column]);

        return self::$columnCache[$key] ??= Schema::connection($connection)
            ->hasColumn($table, $column);
    }

    protected function resolveModel(string $name, string $dir = '')
    {

        $class = $dir
            ? "\\App\\Models\\" . trim($dir, '\\') . "\\" . Str::studly($name)
            : "\\App\\Models\\" . Str::studly($name);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Model '$class' not found.");
        }

        $model = new $class;

        if (!$model instanceof \Illuminate\Database\Eloquent\Model) {
            throw new \RuntimeException("{$class} is NOT an Eloquent model.");
        }

        return $model;
    }

    // ================= VERSIONED CACHE CORE =================

    protected function version(): int
    {
        return self::$versionCache[$this->versionKey]
            ??= Cache::rememberForever($this->versionKey, fn() => 1);
    }

    protected function bumpVersion(): void
    {
        $next = $this->version() + 1;
        Cache::forever($this->versionKey, $next);
        self::$versionCache[$this->versionKey] = $next;
    }

    protected function key(string $suffix): string
    {
        return "{$this->tag}_v{$this->version()}_{$suffix}";
    }

    // ================= FIXED HASH =================

    protected function normalize(mixed $data): mixed
    {
        if (!is_array($data)) {
            return $data;
        }

        if (array_is_list($data)) {
            return array_map(
                fn($value) => $this->normalize($value),
                $data
            );
        }

        ksort($data);

        $result = [];

        foreach ($data as $key => $value) {
            $result[$key] = $this->normalize($value);
        }

        return $result;
    }

    protected function hash($data): string
    {

        return md5(json_encode($this->normalize($data), JSON_THROW_ON_ERROR));
    }

    protected function remember(string $key, int $ttl, callable $callback)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    protected function ttl(): int
    {
        return (int) config('app.cache.default_ttl', 604800);
    }


    private function cachedQuery(string $prefix, array $hashParts, ?int $ttl, callable $callback)
    {
        $key = $this->key($prefix . '_' . $this->hash($hashParts));

        return $this->remember($key, $ttl ?? $this->ttl(), $callback);
    }

    // ================= CORE QUERY METHODS =================

    public function all(?int $ttl = null)
    {
        return $this->remember(
            $this->key('all'),
            $ttl ?? $this->ttl(),
            fn() => $this->model->newModelQuery()->get()
        );
    }

    public function find(int|string $id, ?int $ttl = null)
    {
        return $this->remember(
            $this->key("find_{$id}"),
            $ttl ?? $this->ttl(),
            fn() => $this->model->newModelQuery()->find($id)
        );
    }

    public function first(array $conditions, ?int $ttl = null)
    {
        return $this->cachedQuery(
            'first',
            $conditions,
            $ttl,
            fn() => $this->model->newModelQuery()->where($conditions)->first()
        );
    }

    public function where(array $conditions, ?int $limit = null, ?int $ttl = null)
    {
        return $this->cachedQuery(
            'where',
            [$conditions, $limit],
            $ttl,
            function () use ($conditions, $limit) {
                $query = $this->model->newModelQuery()->where($conditions);

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function whereIn(
        string $column,
        array $values,
        ?int $limit = null,
        ?int $ttl = null
    ) {
        if ($values === []) {
            return collect();
        }

        $values = array_values($values);

        return $this->cachedQuery(
            'wherein',
            [$column, $values, $limit],
            $ttl,
            function () use ($column, $values, $limit) {
                $query = $this->model
                    ->newModelQuery()
                    ->whereIn($column, $values);

                if ($limit !== null) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function whereInMultiple(array $filters, ?int $limit = null, ?int $ttl = null)
    {
        if (empty($filters)) {
            return collect();
        }

        $sortedFilters = $filters;
        usort($sortedFilters, fn($a, $b) => $a[0] <=> $b[0]);

        return $this->cachedQuery(
            'wherein_multiple',
            [$this->normalize($sortedFilters), $limit],
            $ttl,
            function () use ($filters, $limit) {
                $query = $this->model->newModelQuery();

                foreach ($filters as [$column, $values]) {
                    if (!empty($values)) {
                        $query->whereIn($column, $values);
                    }
                }

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function select(array $columns, ?int $limit = null, ?int $ttl = null)
    {
        $sortedColumns = $columns;
        sort($sortedColumns);

        return $this->cachedQuery(
            'select',
            [$sortedColumns, $limit],
            $ttl,
            function () use ($columns, $limit) {
                $query = $this->model
                    ->newModelQuery()
                    ->select($columns);

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function whereSelect(array $conditions, array $columns, ?int $limit = null, ?int $ttl = null)
    {
        $sortedColumns = $columns;
        sort($sortedColumns);

        return $this->cachedQuery(
            'where_select',
            [$conditions, $sortedColumns, $limit],
            $ttl,
            function () use ($conditions, $columns, $limit) {
                $query = $this->model
                    ->newModelQuery()
                    ->select($columns)
                    ->where($conditions);

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function whereWith(array $conditions, array|string $relations, ?int $limit = null, ?int $ttl = null)
    {
        $relations = (array) $relations;

        $sortedRelations = $relations;
        sort($sortedRelations);

        return $this->cachedQuery(
            'where_with',
            [$conditions, $sortedRelations, $limit],
            $ttl,
            function () use ($conditions, $relations, $limit) {
                $query = $this->model->newModelQuery();
                $query->with($relations);
                $query->where($conditions);

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function whereWithSelect(
        array $conditions,
        array|string $relations,
        array $columns,
        ?int $limit = null,
        ?int $ttl = null
    ) {
        $relations = (array) $relations;

        $sortedRelations = $relations;
        sort($sortedRelations);

        $sortedColumns = $columns;
        sort($sortedColumns);

        return $this->cachedQuery(
            'where_with_select',
            [$conditions, $sortedRelations, $sortedColumns, $limit],
            $ttl,
            function () use ($conditions, $relations, $columns, $limit) {
                $query = $this->model->newModelQuery();

                if (!empty($relations)) {
                    $query->with($relations);
                }

                if (!empty($conditions)) {
                    $query->where($conditions);
                }

                if (!empty($columns)) {
                    $query->select($columns);
                }

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                return $query->get();
            }
        );
    }

    public function filter(
        array $conditions = [],
        array|string $relations = [],
        ?callable $filter = null,
        ?int $limit = null,
        ?int $ttl = null
    ) {
        $relations = (array) $relations;

        $sortedRelations = $relations;
        sort($sortedRelations);

        return $this->cachedQuery(
            'filter',
            [$conditions, $sortedRelations, $limit],
            $ttl,
            function () use ($conditions, $relations, $filter, $limit) {
                $query = $this->model->newModelQuery();

                if (!empty($relations)) {
                    $query->with($relations);
                }

                if (!empty($conditions)) {
                    $query->where($conditions);
                }

                if (!is_null($limit)) {
                    $query->limit($limit);
                }

                $data = $query->get();

                return $filter ? $data->filter($filter)->values() : $data;
            }
        );
    }

    // ================= PAGINATION (UNCHANGED) =================

    public function paginateSafe(int $perPage = 15)
    {
        return $this->model->newModelQuery()->paginate($perPage);
    }

    public function wherePaginate(array $conditions, int $perPage = 15)
    {
        return $this->model->newModelQuery()
            ->where($conditions)
            ->paginate($perPage);
    }

    public function selectPaginate(array $columns, int $perPage = 15)
    {
        return $this->model->newModelQuery()
            ->select($columns)
            ->paginate($perPage);
    }

    public function whereWithPaginate(array $conditions, array|string $relations, int $perPage = 15)
    {
        return $this->model->newModelQuery()
            ->with((array) $relations)
            ->where($conditions)
            ->paginate($perPage);
    }

    // ================= MUTATIONS =================

    public function create(array $data)
    {
        $record = $this->model->newModelQuery()->create($data);
        $this->bumpVersion();
        return $record;
    }

    public function update(int|string $id, array $data)
    {
        $record = $this->model->newModelQuery()->findOrFail($id);
        $record->update($data);
        $this->bumpVersion();
        return $record;
    }

    public function delete(int|string $id)
    {
        $this->model->newModelQuery()->findOrFail($id)->delete();
        $this->bumpVersion();
        return true;
    }

    public function exists(array $conditions): bool
    {
        return $this->model
            ->newModelQuery()
            ->where($conditions)
            ->exists();
    }
}