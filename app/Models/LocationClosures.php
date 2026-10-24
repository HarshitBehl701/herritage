<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationClosures extends Model
{
    protected $guarded = []; // fixed typo

    public function ancestor()
    {
        return $this->belongsTo(Location::class, 'ancestor_id', 'id');
    }

    public function descendant()
    {
        return $this->belongsTo(Location::class, 'descendant_id', 'id');
    }
}
