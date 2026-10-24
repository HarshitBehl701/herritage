<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FAQ;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = require database_path('data/products.php');

        $categories = Category::query()
            ->pluck('id', 'slug');

        foreach ($products as $data) {
            $product = Product::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'category_id' => $categories[$data['category']] ?? null,
                    'title' => $data['title'],
                    'image' => $data['image'],
                    'description' => $data['description'],
                    'content' => $data['content'],
                    'status' => true,
                    'featured' => (bool) ($data['featured'] ?? false),
                    'explore' => (bool) ($data['explore'] ?? false),
                    'seo' => (bool) ($data['seo'] ?? true),
                ]
            );

            $faq = FAQ::query()
                ->where('entity_type', Product::class)
                ->where('entity_id', $product->id)
                ->first();

            if ($faq) {
                $faq->update(['content' => $data['faqs']]);
            } else {
                FAQ::create([
                    'entity_type' => Product::class,
                    'entity_id' => $product->id,
                    'content' => $data['faqs'],
                ]);
            }
        }
    }
}
