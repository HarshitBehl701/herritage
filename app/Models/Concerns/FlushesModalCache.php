<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Cache;

trait FlushesModalCache
{
    public static function bootFlushesModalCache(): void
    {
        static::saved(fn () => static::flushModalCache());
        static::deleted(fn () => static::flushModalCache());

        if (method_exists(static::class, 'restored')) {
            static::restored(fn () => static::flushModalCache());
        }
    }

    protected static function flushModalCache(): void
    {
        $tag = config('app.cache.prefix', 'seo:v2:')
            . 'model_'
            . str_replace('\\', '_', strtolower(static::class));

        $versionKey = $tag . '_version';

        Cache::forever($versionKey, (int) Cache::get($versionKey, 1) + 1);
    }
}
