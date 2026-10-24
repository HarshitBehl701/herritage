<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationPresenceSeeder extends Seeder
{
    public function run(): void
    {
        $slugs = [
            'delhi',
            'gujarat',
            'punjab',
            'uttar-pradesh',
            'telangana',
            'maharashtra',
            'madhya-pradesh',
            'haryana',
            'bihar',
            'assam',
            'rajasthan',
            'odisha',
            'west-bengal',
        ];

        Location::query()
            ->whereIn('slug', $slugs)
            ->where('type', 'state')
            ->update(['is_selected' => true]);
    }
}
