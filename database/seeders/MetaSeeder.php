<?php

namespace Database\Seeders;

use App\Models\Meta;
use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    public function run(): void
    {
        $records = $this->staticMeta()
            + $this->categoryMeta()
            + $this->productMeta()
            + $this->blogMeta();

        foreach ($records as $slug => $tags) {
            Meta::updateOrCreate(
                ['slug' => $slug],
                [
                    'meta' => ['tags' => $tags],
                    'status' => true,
                ]
            );
        }
    }

    private function tags(string $title, string $description, string $keywords = ''): array
    {
        $tags = [
            ['name' => 'title', 'value' => $title],
            ['name' => 'description', 'value' => $description],
        ];

        if ($keywords !== '') {
            $tags[] = ['name' => 'keywords', 'value' => $keywords];
        }

        return $tags;
    }

    private function staticMeta(): array
    {
        return [
            'index' => $this->tags(
                'Moulded Cabinets and Enclosures for Power Supplies',
                'Herritage Moulds supplies moulded RO SMPS cabinets, agricultural charger cabinets, CCTV channel SMPS cabinets and adapter enclosures.'
            ),
            'about-us' => $this->tags(
                'About Our Moulded Cabinet and Enclosure Work',
                'Learn how Herritage Moulds grew from Apex Polymers and supplies moulded cabinets and enclosure solutions for power supply applications.'
            ),
            'contact-us' => $this->tags(
                'Contact Our Cabinet and Enclosure Team',
                'Send your board size, application and quantity to the Herritage Moulds team for cabinet selection, packing and dispatch details.'
            ),
            'products' => $this->tags(
                'Moulded Cabinets and Enclosure Range',
                'Browse RO SMPS cabinets, agricultural charger cabinets, CCTV channel SMPS cabinets, charger adapter cabinets and wiring options.'
            ),
            'blogs' => $this->tags(
                'Cabinet and Enclosure Insights',
                'Read practical notes on moulded cabinets, power supply enclosures, board fit and product selection for different applications.'
            ),
            'sitemap' => $this->tags(
                'Sitemap',
                'Browse every product category, cabinet, enclosure and blog page published on the Herritage Moulds website in one organised place.'
            ),
            'explore' => $this->tags(
                'Explore Cabinet and Enclosure Options',
                'Explore cabinet and enclosure options from Herritage Moulds for power supply, charger and adapter assembly requirements.'
            ),
            'our-presence' => $this->tags(
                'Our Presence',
                'See the regions where Herritage Moulds supplies moulded cabinets and enclosure solutions for power supply and assembly applications.'
            ),
            'privacy-policy' => $this->tags(
                'Privacy Policy',
                'Read how Herritage Moulds collects, uses and protects personal information submitted through this website and its enquiry form.'
            ),
            'terms-and-conditions' => $this->tags(
                'Terms and Conditions',
                'Read the terms and conditions that apply when using the Herritage Moulds website and sending an enquiry through this site.'
            ),
            'disclaimer' => $this->tags(
                'Disclaimer',
                'Read the disclaimer for product information published on the Herritage Moulds website and confirm specifications before ordering.'
            ),
            'faqs' => $this->tags(
                'Cabinet and Enclosure FAQs',
                'Answers to common questions about moulded cabinets, board fit, product options and ordering from the Herritage Moulds range.'
            ),
        ];
    }

    private function categoryMeta(): array
    {
        $categories = require database_path('data/categories.php');
        $records = [];

        foreach ($categories as $category) {
            $meta = $category['meta'];

            $records[$category['slug']] = $this->tags(
                $meta['title'],
                $meta['description'],
                $meta['keywords']
            );
        }

        return $records;
    }

    private function productMeta(): array
    {
        $products = require database_path('data/products.php');
        $records = [];

        foreach ($products as $product) {
            $meta = $product['meta'];

            $records[$product['slug']] = $this->tags(
                $meta['title'],
                $meta['description'],
                $meta['keywords']
            );
        }

        return $records;
    }

    private function blogMeta(): array
    {
        $blogs = require database_path('data/blogs.php');
        $records = [];

        foreach ($blogs as $blog) {
            $meta = $blog['meta'];

            $records[$blog['slug']] = $this->tags(
                $meta['title'],
                $meta['description'],
                $meta['keywords']
            );
        }

        return $records;
    }
}
