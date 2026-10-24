<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Keywords extends Model
{
    use FlushesModalCache;

    protected $table = 'keywords';
    protected $fillable = [
        'entity_type',
        'entity_id',
        'keywords',
    ];

    protected $casts = [
        'keywords' => 'array'
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

            if (!is_array($model->keywords)) {
                return;
            }

            $model->keywords = collect($model->keywords)
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
