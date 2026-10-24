<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use FlushesModalCache, SoftDeletes;

    protected $fillable = [
        'order',
        'category_id',
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
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id', 'id')
            ->where('explore', false);
    }

    protected static function booted(): void
    {
        static::saving(function ($subcategory) {
            if (empty($subcategory->slug) && !empty($subcategory->title)) {
                $subcategory->slug = Str::slug($subcategory->title);
            }
        });

        static::created(function ($subcategory) {
            $subcategory->updateQuietly([
                'order' => $subcategory->id,
            ]);
        });
    }
}