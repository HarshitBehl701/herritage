<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Service extends Model
{
    use FlushesModalCache, SoftDeletes;

    protected $fillable = [
        'order',
        'parent_id',
        'slug',
        'title',
        'image',
        'description',
        'content',
        'status',
        'explore',
        'seo',
    ];

    protected $casts = [
        'content' => 'array',
        'status' => 'boolean',
        'explore' => 'boolean',
        'seo' => 'boolean',
    ];

    public function faqs()
    {
        return $this->morphOne(FAQ::class, 'entity');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id')
            ->where('status', true);
    }

    public function siblings()
    {
        return Service::where('status', true)
            ->whereNull('deleted_at')
            ->where('parent_id', $this->parent_id)
            ->where('id', '!=', $this->id);
    }

    protected static function booted(): void
    {
        static::saving(function ($service) {
            if (empty($service->slug) && !empty($service->title)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::created(function ($service) {
            $service->updateQuietly([
                'order' => $service->id,
            ]);
        });
    }
}