<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
{
    use SoftDeletes;
    protected $fillable = [
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
}
