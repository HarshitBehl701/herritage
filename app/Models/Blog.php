<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use FlushesModalCache, SoftDeletes;

    protected $fillable = [
        'order',
        'slug',
        'title',
        'image',
        'description',
        'content',
        'status',
    ];

    protected $casts = [
        'content' => 'array',
        'status' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function siblings()
    {
        return Blog::where('id', '!=', $this->id)
            ->latest();
    }

    protected static function booted(): void
    {
        static::saving(function ($blog) {
            if (empty($blog->slug) && !empty($blog->title)) {
                $blog->slug = Str::slug($blog->title);
            }
        });

        static::created(function ($blog) {
            $blog->updateQuietly([
                'order' => $blog->id,
            ]);
        });
    }
}