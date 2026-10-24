<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location',
        'slug',
        'is_active',
        'is_selected'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_selected' => 'boolean'
    ];

    public function ancestors()
    {
        return $this->belongsToMany(Location::class, 'location_closures', 'descendant_id', 'ancestor_id')->withPivot('depth');
    }

    public function descendants()
    {
        return $this->belongsToMany(Location::class, 'location_closures', 'ancestor_id', 'descendant_id')->withPivot('depth');
    }

}
