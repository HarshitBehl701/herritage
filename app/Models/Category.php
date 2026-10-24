<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')
            ->where('status', true);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')
            ->where('status', true);
    }

    public function subCategoriesWithProducts()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')
            ->where('status', true)
            ->with([
                'products' => function ($query) {
                    $query->where('status', true)
                        ->where('explore', false);
                }
            ]);
    }

    public function directProducts()
    {
        return $this->hasMany(Product::class, 'category_id')
            ->when(
                config('app.panel.sub_category_required'),
                fn ($query) => $query->whereNull('sub_category_id')
            )
            ->where('status', true)
            ->where('explore', false);
    }

    protected static function booted(): void
    {
        static::saving(function ($category) {
            if (empty($category->slug) && !empty($category->title)) {
                $category->slug = Str::slug($category->title);
            }
        });

        static::created(function ($category) {
            $category->updateQuietly([
                'order' => $category->id,
            ]);
        });
    }
}