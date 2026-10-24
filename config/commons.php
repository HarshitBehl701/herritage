<?php

// Write Common DB Callings Below
return [
    'menu' => [
        'products' => [
            'modal' => 'Product',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
                'explore' => false,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'category_id',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'categories' => [
            'modal' => 'Category',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
    ],
    'contact' => [
        'modal' => 'User',
        'first' => true,
        'select' => ['name', 'email', 'additional_info'],
    ],
    'site' => [
        'modal' => 'Component',
        'condition' => [
            'slug' => 'site',
        ],
        'select' => [
            'slug',
            'content',
        ],
        'first' => true,
    ],
    'presence' => [
        'modal' => 'Location',
        'condition' => [
            'is_selected' => true,
            'deleted_at' => null,
        ],
        'select' => [
            'id',
            'location',
            'slug',
            'type',
        ],
        'order' => [
            'location' => 'asc',
        ],
    ],
];
