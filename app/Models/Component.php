<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use FlushesModalCache;

    protected $table = 'components';

    protected $fillable = [
        'slug',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
