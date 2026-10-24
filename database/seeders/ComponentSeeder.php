<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $components = require database_path('data/components.php');

        foreach ($components as $slug => $content) {
            Component::updateOrCreate(
                ['slug' => $slug],
                ['content' => $content]
            );
        }
    }
}
