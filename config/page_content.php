<?php

// Write Page Specific DB Calling Below
return [
    'index' => [
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
                'description',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
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
                'description',
                'category_id',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'blogs' => [
            'modal' => 'Blog',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'sections' => [
            'modal' => 'Component',
            'condition' => [
                'slug in' => [
                    'home-about',
                    'home-highlights',
                    'home-requirements',
                    'home-enquiry',
                    'home-testimonials',
                    'home-faqs',
                    'products-intro',
                    'blogs-intro',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'products' => [
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
                'description',
                'content',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
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
                'description',
                'category_id',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'sections' => [
            'modal' => 'Component',
            'condition' => [
                'slug in' => [
                    'products-intro',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'category' => [
        'requires_slug' => true,
        'category' => [
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
                'description',
                'content',
                'seo',
            ],
            'search' => [
                'column' => 'slug',
            ],
            'first' => true,
            'with' => [
                'faqs',
                'directProducts',
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

    'product' => [
        'requires_slug' => true,
        'product' => [
            'modal' => 'Product',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
                'content',
                'category_id',
                'seo',
            ],
            'search' => [
                'column' => 'slug',
            ],
            'first' => true,
            'with' => [
                'faqs',
                'category',
                'siblings',
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

    'blogs' => [
        'blogs' => [
            'modal' => 'Blog',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'sections' => [
            'modal' => 'Component',
            'condition' => [
                'slug in' => [
                    'blogs-intro',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'blog' => [
        'requires_slug' => true,
        'blog' => [
            'modal' => 'Blog',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
                'content',
            ],
            'search' => [
                'column' => 'slug',
            ],
            'first' => true,
        ],
        'blogs' => [
            'modal' => 'Blog',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
    ],

    'explore' => [
        'products' => [
            'modal' => 'Product',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
                'explore' => true,
            ],
            'select' => [
                'id',
                'slug',
                'title',
                'image',
                'description',
                'content',
                'category_id',
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'sections' => [
            'modal' => 'Component',
            'condition' => [
                'slug in' => [
                    'products-intro',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'sitemap' => [
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
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
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
                'seo',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
        'blogs' => [
            'modal' => 'Blog',
            'condition' => [
                'status' => true,
                'deleted_at' => null,
            ],
            'select' => [
                'id',
                'slug',
                'title',
            ],
            'order' => [
                'id' => 'asc',
            ],
        ],
    ],

    'about-us' => [
        'page' => [
            'modal' => 'Page',
            'condition' => [
                'slug in' => [
                    'about-us',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
        'sections' => [
            'modal' => 'Component',
            'condition' => [
                'slug in' => [
                    'home-highlights',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'contact-us' => [
        'page' => [
            'modal' => 'Page',
            'condition' => [
                'slug in' => [
                    'contact-us',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'faqs' => [
        'page' => [
            'modal' => 'Page',
            'condition' => [
                'slug in' => [
                    'faqs',
                ],
            ],
            'select' => [
                'slug',
                'content',
            ],
        ],
    ],

    'privacy-policy' => [
        'modal' => 'Page',
        'condition' => [
            'slug' => 'privacy-policy',
        ],
        'select' => [
            'slug',
            'content',
        ],
        'first' => true,
    ],

    'terms-and-conditions' => [
        'modal' => 'Page',
        'condition' => [
            'slug' => 'terms-and-conditions',
        ],
        'select' => [
            'slug',
            'content',
        ],
        'first' => true,
    ],

    'disclaimer' => [
        'modal' => 'Page',
        'condition' => [
            'slug' => 'disclaimer',
        ],
        'select' => [
            'slug',
            'content',
        ],
        'first' => true,
    ],
];
