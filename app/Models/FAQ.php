<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FAQ extends Model
{
    use FlushesModalCache;

    protected $table = 'faqs';
    protected $fillable = [
        'entity_type',
        'entity_id',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Polymorphic Entity
    |--------------------------------------------------------------------------
    */
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted()
    {
        static::saving(function ($model) {

            if (!is_array($model->content)) {
                return;
            }

            $model->content = collect($model->content)
                ->map(function ($value) {

                    if (is_string($value)) {

                        // Remove HTML tags & spaces
                        $clean = trim(strip_tags($value));

                        return $clean === '' ? null : $value;
                    }

                    return $value;
                })
                ->filter(fn($value) => !is_null($value)) // remove null keys
                ->toArray();
        });
    }
}
