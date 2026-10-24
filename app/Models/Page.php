<?php

namespace App\Models;

use App\Models\Concerns\FlushesModalCache;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use FlushesModalCache;

    protected $table = 'pages';

    protected $fillable = [
        'slug',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
