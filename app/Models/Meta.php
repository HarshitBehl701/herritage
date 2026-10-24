<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use FlushesModalCache, SoftDeletes;
    protected $table = 'metas';
    protected $fillable = [
        'slug',
        'meta',
        'status',
    ];

    protected $casts = [
        'meta' => 'array', // [{name,value}]
        'status' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Helper: get meta value by name (title, description, keyword)
     */
    public function getMeta(string $name): ?string
    {
        $value = collect($this->meta)
            ->firstWhere('name', $name)['value'] ?? null;

        return is_scalar($value) ? (string) $value : null;
    }
}
