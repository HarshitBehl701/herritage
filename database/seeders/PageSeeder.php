<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = require database_path('data/pages.php');

        foreach ($pages as $slug => $content) {
            Page::updateOrCreate(
                ['slug' => $slug],
                ['content' => $content['content'] ?? []]
            );
        }
    }
}
