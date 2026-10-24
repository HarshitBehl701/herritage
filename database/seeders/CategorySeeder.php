<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FAQ;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = require database_path('data/categories.php');

        foreach ($categories as $data) {
            $category = Category::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'image' => $data['image'],
                    'description' => $data['description'],
                    'content' => $data['content'],
                    'status' => true,
                    'featured' => (bool) ($data['featured'] ?? false),
                    'explore' => false,
                    'seo' => (bool) ($data['seo'] ?? true),
                ]
            );

            $faq = FAQ::query()
                ->where('entity_type', Category::class)
                ->where('entity_id', $category->id)
                ->first();

            if ($faq) {
                $faq->update(['content' => $data['faqs']]);
            } else {
                FAQ::create([
                    'entity_type' => Category::class,
                    'entity_id' => $category->id,
                    'content' => $data['faqs'],
                ]);
            }
        }
    }
}
