<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = require database_path('data/blogs.php');

        foreach ($blogs as $data) {
            Blog::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'image' => $data['image'],
                    'description' => $data['description'],
                    'content' => [
                        'sections' => $data['sections'],
                        'images' => [],
                    ],
                    'status' => true,
                ]
            );
        }
    }
}
