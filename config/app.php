<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    */

    'meta_default_location' => env('DEFAULT_LOCATION', ''),

    'meta_modal_name' => env('META_MODAL_NAME', 'Meta'),

    'meta_modal_dir' => env('META_MODAL_DIR', ''),

    'keyword_modal_name' => env('KEYWORD_MODAL_NAME', 'Keywords'),

    'keyword_modal_dir' => env('KEYWORD_MODAL_DIR', ''),

    'default_page' => env('DEFAULT_PAGE', 'index'),

    'static_pages_path' => env('STATIC_PAGES_PATH', 'views/client/pages'),

    'recaptcha_site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY', ''),

    'recaptcha_secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY', ''),

    'location_allowed_pages' => env('LOCATION_ALLOWED_PAGES', ''),

    'sitemap_max_versions' => (int) env('SITEMAP_MAX_VERSIONS', 2),

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    */

    'cache' => [

        'default_ttl' => (int) env('SEO_CACHE_TTL', 604800),

        'negative_ttl' => (int) env('SEO_NEGATIVE_CACHE_TTL', 3600),

        'pages_ttl' => (int) env('SEO_PAGES_CACHE_TTL', 604800),

        'meta_ttl' => (int) env('SEO_META_CACHE_TTL', 604800),

        'locations_ttl' => (int) env('SEO_LOCATIONS_CACHE_TTL', 604800),

        'clean_url_ttl' => (int) env('CLEAN_URL_CACHE_TTL', 604800),

        'prefix' => env('SEO_CACHE_PREFIX', 'seo:v2:'),

    ],
    
    /*
    |--------------------------------------------------------------------------
    | Panel Registrations
    |--------------------------------------------------------------------------
    */

    'panel' => [

        'category_required' => (bool) env('CATEGORY_REQUIRED', true),
        'sub_category_required' => (bool) env('SUB_CATEGORY_REQUIRED', true),
        'product_required' => (bool) env('PRODUCT_REQUIRED', true),
        'service_required' => (bool) env('SERVICE_REQUIRED', true),

    ],

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale
    |--------------------------------------------------------------------------
    */

    'locale' => env(
        'APP_LOCALE',
        'en'
    ),

    'fallback_locale' => env(
        'APP_FALLBACK_LOCALE',
        'en'
    ),

    'faker_locale' => env(
        'APP_FAKER_LOCALE',
        'en_US'
    ),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(
                ',',
                (string) env(
                    'APP_PREVIOUS_KEYS',
                    ''
                )
            )
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode
    |--------------------------------------------------------------------------
    */

    'maintenance' => [
        'driver' => env(
            'APP_MAINTENANCE_DRIVER',
            'file'
        ),

        'store' => env(
            'APP_MAINTENANCE_STORE',
            'database'
        ),
    ],

];