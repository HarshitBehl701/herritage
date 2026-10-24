<?php

// For Dynamic Slug Resolve And Clean Url Solve , services will refer the below array
// Define Modals Structure Here
return [
    'slug_group' => [
        'App\Models\Category' => 'Category',
        'App\Models\SubCategory' => 'SubCategory',
        'App\Models\Product' => 'Product',
        'App\Models\Service' => 'Service',
        'App\Models\Blog' => 'Blog',
    ],
    'seo_group' => [
        'meta' => env('META_MODAL_NAME', 'Metas'),
        'keywords' => env("KEYWORD_MODAL_NAME", 'Keywords')
    ]
];