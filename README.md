# SEO Template Module

A reusable **Laravel 12** SEO module for location-aware websites. It provides database-driven page content, metadata, keywords, dynamic URLs, and sitemap generation.

The module is copied into multiple websites and configured per site: domain models, database, content structure, and branding.

## Table of Contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Environment Configuration](#environment-configuration)
5. [Domain Model Configuration](#domain-model-configuration)
6. [Content Configuration](#content-configuration)
7. [Request Flow](#request-flow)
8. [Locations](#locations)
9. [Metadata and Keywords](#metadata-and-keywords)
10. [Sitemap Generation](#sitemap-generation)
11. [Routes](#routes)
12. [Caching](#caching)
13. [Frontend Assets](#frontend-assets)
14. [Testing and Validation](#testing-and-validation)
15. [Production Checklist](#production-checklist)
16. [Project Structure](#project-structure)
17. [Customization Guidance](#customization-guidance)

---

## Features

- Location-aware URL resolution and parent-location navigation.
- Database-driven content blocks configured in `config/page_content.php`.
- Shared content blocks (such as menus) configured in `config/commons.php`.
- Dynamic metadata formatting for titles, descriptions, keywords, locations, and schemas.
- Keyword validation for SEO landing pages.
- Versioned model caching through `ModalService`.
- Cached location and closure-tree lookups.
- Two sitemap generators:
  - `sitemap:v1` creates grouped XML files.
  - `sitemap:v2` streams flat XML files and avoids loading the whole document in memory.
- Blade components for metadata, alerts, locations, forms, navigation, and shared layout slots.
- Laravel Vite integration for compiled CSS and JavaScript assets.

## Requirements

- PHP 8.2 or newer
- Composer
- Laravel 12
- Node.js and npm (frontend assets)
- A supported Laravel database (MySQL or MariaDB recommended for production)
- Redis (recommended for high-traffic cache, sessions, and queues)

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database and application values in `.env`, then run:

```bash
php artisan migrate --force
npm install
npm run build
```

Local development:

```bash
php artisan serve
npm run dev
```

Or use the Composer development script:

```bash
composer run dev
```

> **Warning:** Never commit `.env`, application keys, database credentials, mail credentials, or reCAPTCHA secrets.

## Environment Configuration

### Application and routing

| Key | Purpose |
| --- | --- |
| `APP_URL` | Canonical application URL used by links and sitemaps. |
| `APP_TIMEZONE` | Application timezone. |
| `DEFAULT_PAGE` | Default page for the root URL, normally `index`. |
| `STATIC_PAGES_PATH` | View directory scanned for static page names. |
| `LOCATION_ALLOWED_PAGES` | Comma-separated pages allowed directly below a location. |
| `SITEMAP_MAX_VERSIONS` | Maximum sitemap command version exposed through the route. |

### Models

| Key | Purpose |
| --- | --- |
| `META_MODAL_NAME` | Eloquent model name used for metadata. |
| `META_MODAL_DIR` | Optional model subdirectory below `App\Models`. |
| `KEYWORD_MODAL_NAME` | Eloquent model name used for keywords. |
| `KEYWORD_MODAL_DIR` | Optional keyword model subdirectory. |

### Cache

| Key | Purpose |
| --- | --- |
| `SEO_CACHE_TTL` | Default SEO cache lifetime in seconds (default: seven days). |
| `SEO_PAGES_CACHE_TTL` | Cache lifetime for discovered static pages. |
| `SEO_META_CACHE_TTL` | Cache lifetime for formatted metadata. |
| `SEO_LOCATIONS_CACHE_TTL` | Cache lifetime for locations and closure data. |
| `SEO_NEGATIVE_CACHE_TTL` | Cache lifetime for missing location lookups. |
| `CLEAN_URL_CACHE_TTL` | Cache lifetime for resolved URLs, in seconds. |
| `SEO_CACHE_PREFIX` | Shared namespace for all module cache keys. |

### reCAPTCHA

| Key | Purpose |
| --- | --- |
| `GOOGLE_RECAPTCHA_SITE_KEY` | Public reCAPTCHA v3 site key. |
| `GOOGLE_RECAPTCHA_SECRET_KEY` | Private reCAPTCHA v3 verification key. |

### Production example

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.example.com
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

After changing environment values on a deployed application, refresh the cached configuration:

```bash
php artisan config:clear
php artisan config:cache
```

## Domain Model Configuration

This repository does not contain the consuming website's business models. Configure the models for each website in `config/modals_group_structure.php`.

The `slug_group` map uses the fully-qualified model class as the key and the model name as the value:

```php
'slug_group' => [
    App\Models\Service::class => 'Service',
    App\Models\Product::class => 'Product',
],
```

Requirements for each configured model:

- It must exist.
- It should normally have a `slug` column. The resolver also supports `slug_url`.
- It should define the fields its page configuration uses, such as `is_active`, `status`, `seo`, `is_seo`, and `deleted_at`.

> **Note:** Do not copy the example `Category` or `Product` names unless those models exist in the consuming application.

## Content Configuration

### Page content

`config/page_content.php` maps page names to content blocks:

```php
'index' => [
    'products' => [
        'modal' => 'Product',
        'condition' => [
            'is_active' => true,
        ],
        'select' => ['id', 'slug', 'title'],
        'with' => ['category'],
    ],
],
```

### Block options

| Option | Description |
| --- | --- |
| `modal` | Model name resolved below `App\Models`. |
| `modal_dir` | Optional model directory. |
| `condition` | Equality and operator conditions, such as `price >=`, `id in`, and `created_at between`. |
| `select` | Columns to retrieve. Use it to reduce database payloads. |
| `with` | Safe Eloquent relationships to eager load. |
| `order` | Column-to-direction ordering map. |
| `search.column` | Enables single-record lookup when a route slug is present. |
| `first` | Returns the first collection item. |
| `tree` | Builds a parent/children tree. Requires `id` in `select`. |
| `requires_slug` | Prevents the block from loading without a route slug. |

> **Security:** Only trusted application configuration should define columns, relations, and operators. These values must not come directly from request input.

### Common blocks

`config/commons.php` defines content shared by multiple pages, such as navigation menus. Common blocks use the same resolver syntax as page blocks and are cached using model version keys.

## Request Flow

1. `PageController` parses the optional route segments.
2. `CleanUrlService` resolves static pages, dynamic slugs, locations, and keywords.
3. `ContentService` loads the configured blocks for the resolved page.
4. `BlockResolverService` applies safe conditions, selects, eager loads, contextual methods, and cache keys.
5. `MetaService` loads and formats database metadata.
6. The shared client layout renders metadata, navigation slots, page content, alerts, and optional reCAPTCHA.

Static pages can resolve without configured domain models. Missing optional models are skipped, so a new website can configure its domain models step by step.

## Locations

Location data is read through `LocationRepository`, and closure relationships through `LocationClosureRepository`. The location tree is built by `LocationsService::build_location_tree()`.

The closure table must be named `location_closures` and should contain at least:

- `ancestor_id`
- `descendant_id`
- `depth`
- `is_selected` (when direct-child filtering requires it)

For production datasets, add these indexes:

```sql
CREATE INDEX location_closures_ancestor_depth
    ON location_closures (ancestor_id, depth);

CREATE INDEX location_closures_descendant_depth
    ON location_closures (descendant_id, depth);

CREATE INDEX locations_slug_active_selected
    ON locations (slug, is_active, is_selected);
```

> **Note:** Check the existing database first to avoid duplicate indexes.

## Metadata and Keywords

### Metadata

Metadata is stored in the configured metadata model and formatted by `MetaFormatterService`. It supports both associative data and indexed `{name, value}` arrays.

Replacement values come from:

- Current location
- Parent locations
- Current keyword
- Resolved content slug
- Configured default location aliases

### Keywords

Keywords are stored through the configured keyword model with `entity_type`, `entity_id`, and a JSON `keywords` field. The keyword model casts the JSON field to an array.

## Sitemap Generation

Run from the CLI:

```bash
php artisan sitemap:v1
php artisan sitemap:v2
```

The authenticated web route `/sitemap/{version}` is also available for administrative use. In production, prefer the CLI or a protected scheduler over web access.

Sitemap generation can produce a very large number of URLs. V2 streams XML output and preloads keyword records per content type to avoid repeated queries. Run it as a queued or scheduled maintenance task for large datasets.

## Routes

| Method | Route | Purpose |
| --- | --- | --- |
| `GET` | `/{segments?}` | Resolves static, location, slug, and keyword routes. |
| `POST` | `/send-query` | Submits the enquiry form and verifies reCAPTCHA. |
| `GET` | `/optimize` | Authenticated Laravel cache optimization. |
| `GET` | `/sitemap/{version}` | Authenticated sitemap generation. |

> **Note:** The optimize and sitemap routes use authentication middleware. Add authorization or an admin gate if more than one authenticated user can access the application.

## Caching

The module uses a centralized, multi-day cache policy for:

- Clean URL resolution
- Model query results (`ModalService`)
- Block results (`BlockResolverService`)
- Location and closure lookups
- Static page discovery
- Formatted metadata

The default SEO cache lifetime is **seven days (`604800` seconds)**, not one or two hours. This suits mostly-static SEO pages that can generate millions of URL variants. Adjust the `SEO_*_TTL` values only when a website needs shorter freshness windows.

### Invalidation

- `ModalService` increments a model version when its mutation methods are used. The version is part of the query, block, and metadata cache keys.
- If data changes outside the service, clear or bump the relevant cache namespace after the write.
- The model version counter is the only intentionally permanent cache entry. It is invalidation state, not page content.

### Multiple servers

Use a shared Redis cache across application servers. The database cache driver is acceptable for development but not ideal for high request volume.

## Frontend Assets

Shared CSS and JavaScript load through Vite in `resources/views/client/layout.blade.php`:

- `resources/css/app.css`
- `resources/js/app.js`

```bash
npm run build   # production build
npm run dev     # Vite development server
```

The alert component uses the bundled JavaScript instead of emitting a script block on every page. reCAPTCHA loads only when a site key is configured.

## Testing and Validation

```bash
php artisan test        # run the test suite
php artisan view:cache  # compile views
php artisan config:cache # compile configuration
npm run build           # validate the frontend bundle
```

> **Note:** Feature tests need the PHP database driver set in the test environment. If SQLite is used, install or enable the SQLite PDO extension.

## Production Checklist

- [ ] Set `APP_ENV=production` and `APP_DEBUG=false`.
- [ ] Set a real `APP_URL` with HTTPS.
- [ ] Generate a unique `APP_KEY`.
- [ ] Configure Redis for cache, sessions, and queues.
- [ ] Install database indexes for location and content lookup columns.
- [ ] Configure real domain models in `config/modals_group_structure.php`.
- [ ] Review `config/page_content.php` and remove blocks for unavailable models.
- [ ] Run `php artisan migrate --force`.
- [ ] Run `php artisan config:cache`, `php artisan route:cache`, and `php artisan view:cache`.
- [ ] Build and publish Vite assets with `npm run build`.
- [ ] Run queue workers if asynchronous jobs are enabled.
- [ ] Schedule sitemap generation outside normal web requests.
- [ ] Use a CDN for static assets and generated sitemap files where appropriate.
- [ ] Load-test URL resolution, content blocks, metadata, and sitemap generation with realistic data.

## Project Structure

```text
app/Console/Commands       Sitemap and deployment commands
app/DTO                    Typed URL data transfer objects
app/Http/Controllers       Request controllers
app/Models                 Shared SEO and location models
app/Services/Applications  Page content orchestration
app/Services/Commons       Shared content and static page discovery
app/Services/Database      Model query and block resolution services
app/Services/Keywords      Keyword loading and validation
app/Services/Locations     Location and closure repositories
app/Services/Metas         Metadata loading and formatting
app/Services/Middlewares   Clean URL resolution
config/                    Application and content configuration
resources/views            Client layouts, pages, and Blade components
resources/css              Vite CSS entrypoint
resources/js               Vite JavaScript entrypoint
database/migrations        Module migrations
```

## Customization Guidance

Keep domain-specific models, relationships, migrations, and page blocks in the consuming website. Keep this module's generic services and configuration conventions stable across sites.

When adding a new service:

1. Keep database access behind a repository or focused service.
2. Select only the columns the view needs.
3. Avoid queries inside nested rendering loops.
4. Add a cache key only when invalidation is defined.
5. Use versioned or tagged cache invalidation for mutable data.
6. Add a focused feature test for the request path.
7. Measure query count and response time with realistic data before and after the change.