<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use FlushesModalCache, SoftDeletes;

    protected $fillable = [
        'order',
        'category_id',
        'sub_category_id',
        'slug',
        'title',
        'image',
        'description',
        'content',
        'status',
        'featured',
        'explore',
        'seo',
    ];

    protected $casts = [
        'content' => 'array',
        'status' => 'boolean',
        'explore' => 'boolean',
        'featured' => 'boolean',
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->where('status', true);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id')
            ->where('status', true);
    }

    public function siblings()
    {
        return Product::where('status', true)
            ->whereNull('deleted_at')
            ->where('category_id', $this->category_id)
            ->when(
                config('app.panel.sub_category_required'),
                fn ($query) => $query->where('sub_category_id', $this->sub_category_id)
            )
            ->where('id', '!=', $this->id);
    }

    protected static function booted(): void
    {
        static::saving(function ($product) {
            if (empty($product->slug) && !empty($product->title)) {
                $product->slug = Str::slug($product->title);
            }
        });

        static::created(function ($product) {
            $product->updateQuietly([
                'order' => $product->id,
            ]);
        });
    }
}