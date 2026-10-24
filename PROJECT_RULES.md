# PROJECT RULES — Generic Playbook

**Version 1.0 · 19 Oct 2026 · carry this file into every project**

This is the reusable method for taking any Laravel — or plain-PHP — website into the
SEO template structure this repository implements, for reworking its content to the
content standard, for proving the result, for tracking every change, and for finding
and resolving the errors that appear on the way.

The file is deliberately project-agnostic. Keywords, the data source, the content
source, the locations, the brand and the contact details are **inputs supplied on the
go**; the method below says where each input enters, how it is used and how it is
verified.

`rules.txt` (one per project) is the project's numbered content, meta and implementation
standard.
`activity-log.md`, `error-log.md` and `todo.md` are the project's memory.
This file is the method that produces and audits all four.

PART E (§14–§16) documents how the dynamic mechanisms work and how to add new ones
safely; PART F (§17) is the closing whole-project link and error check that no
delivery skips.

---

## THE ORDER — never change it

1. **Read** the project's `rules.txt`, `activity-log.md`, `error-log.md` and `todo.md`.
   Collect the open questions before touching anything.
2. **Intake** the inputs (§2): keywords, data source, content source, brand, locations,
   media, scope. Missing inputs get documented defaults, never silent guesses.
3. **Audit** the project in this order (§3): filesystem → stack → database and table
   structure → data integrity → routes and URL contract → services → views → content →
   SEO → assets → logs.
4. **Write the rule first**. Append the numbered rule section that governs the work to
   `rules.txt` *before* doing the work (§9.5).
5. **Baseline** the content with the audit numbers (§7) so the before state is provable.
6. **Implement or convert** (§4, §5).
7. **Rework content** to the standard (§6).
8. **Verify** with every audit, the database re-render, the rendered pages and the full
   URL sweep (§7), then run the closing whole-project link and error check (§17). Fix
   and re-run until green.
9. **Log and clean up**: `activity-log.md`, `error-log.md`, `todo.md`, delete temporary
   files, clear the framework cache (§9, §10).
10. **Report**: what changed, the evidence, what stays open and why.

One step is one user-visible outcome. Never mix an unlogged fix into another step.

---

# PART A — START, AUDIT, STRUCTURE, CONVERSION

## 1. The laws

These outrank convenience. They are the reason the rest of the file works.

1.1 **Rule before work.** Every substantive change is governed by a numbered rule that
exists before the change. If the rule is not written, the work has not started.
Rules are appended, never renumbered, and audits cite them.

1.2 **Evidence or it did not happen.** A claim in a log must carry a number, a count, a
quote or a reproducible check. "Checked" without evidence is not a check.

1.3 **Never destroy, never invent.** Do not delete or rewrite a user's file, image,
page or record to make an audit pass. Do not invent a fact (certification, year,
address, specification) that the client did not supply. When a fact is unknown, write
around it or ask.

1.4 **One source of truth.** For content: the project's data file (or database, if that
is the chosen store) is the single source. Views read it; seeders/renderers write it;
audits measure it; logs quote it. Never edit copy in two places.

1.5 **Uniqueness is a hard rule.** No identical line, no near-identical line
(≥ 0.50 Jaccard), no repeated five-word run inside a line, and a unique first line for
every record. This is measured, not judged by reading.

1.6 **Links are structural, not decoration.** Every child links its parent; every parent
lists its children; every published record is reachable. Anchor text is the target's
real title. Stored hrefs are canonical; the renderer adds the location prefix.

1.7 **Log while working.** The activity log is written during the step, not recreated
from memory at the end. Defects go to the error log when found.

1.8 **Leave no trace.** No temporary script, dump, backup or report file remains in the
project at the end of a step. Production `storage/logs` are not shipped with old errors.

1.9 **Scope discipline.** Change only the fields the rule names. Images, metas and
templates are not touched by a copy-only step. Blogs are not touched by a
category/product step. A fix outside scope is recorded, not smuggled in.

1.10 **Ask only when blocked, then ask well.** A question carries the options, the
evidence, the default you would take and the consequence. Everything else is decided
and documented.

1.11 **Generic first, project second.** The method must run on any Laravel/PHP site.
Project-specific values (brand, keywords, block names, counts) live in that project's
`rules.txt` and configuration, not hard-coded into scripts.

1.12 **The module heals itself.** Every defect found must be classified, fixed if safe,
verified, and logged (§8). The loop never ends with "found, did nothing" unless the
client owns the decision.

---

## 2. Intake — the inputs supplied on the go

### 2.1 The intake sheet

Collect, in writing, before the first change. Anything missing is marked *default* or
*asked* — never guessed silently.

| # | Input | Why it matters | Default if missing |
|---|-------|----------------|--------------------|
| 1 | Legal brand name | Used verbatim in every record | Ask |
| 2 | Domain(s), live and staging | Sitemaps, canonical, URL sweep | Ask |
| 3 | Contact e-mail, phone, address, WhatsApp | Contact blocks, chrome, schema | Ask |
| 4 | Primary and secondary keywords per entity | Content, metas, keyword URLs | Ask |
| 5 | Long-tail phrases per entity (or brief to invent them) | Highlights, headings | Write original |
| 6 | Trade roles / service roles for the industry | Keyword set + trust blocks | Use supplied set |
| 7 | Data source (xlsx / CSV / JSON / existing DB / scrape) | Catalogue records | Ask |
| 8 | Content source (client copy / existing site / to be written) | Facts, tone, legal claims | Write original |
| 9 | Locations to publish (country/state/district/city) | URL space, headings, metas | Use existing location table |
| 10 | Modules needed: category, sub-category, product, service | DB migrations + admin | Profile default |
| 11 | Content blocks required per page type | Templates + rules | Standard profile |
| 12 | Media: logo, favicon, banners, product images, blog images | Uploads and image columns | Leave as supplied |
| 13 | Page list: home, about, contact, policies, explore, blogs, sitemap | Routes + metas | Detect from source |
| 14 | Languages / locale / timezone | Copy and dates | en / project default |
| 15 | Anything legally sensitive (claims, prices, guarantees) | Never invented | Excluded |

### 2.2 Keyword sheet format (provided on the go)

One row per entity. The sheet is the only place keywords enter the pipeline.

| entity_key | entity_type | primary | secondary_set | long_tail_set | roles_or_terms | banned |
|---|---|---|---|---|---|---|
| glass-pool | product | glass swimming pools | top rated, best, manufacturers, suppliers, traders, exporters | glass pool structure, transparent pool wall, ... (≥5) | manufacturers; suppliers; traders; exporters | cheap, No.1 |

Rules for the sheet:

- `entity_key` is the slug used everywhere (URL, DB, meta row, audit).
- `primary` is the phrase a buyer types; it must appear in the H1/meta title.
- `secondary_set` is the supplied keyword set (this project: six roles). Every member
  gets the minimum occurrence count in §6.5.
- `long_tail_set` feeds the highlight floor (§6.6). At least five entries per entity.
- `banned` lists words that must never appear (unverifiable superlatives, competitor
  names, claims the client has not approved).

### 2.3 Data-source format (provided on the go)

Accept xlsx, CSV, JSON or an existing table. Normalise to one row per record:

| field | required | rule |
|---|---|---|
| `title` | yes | The client's name for the record; used verbatim in headings |
| `parent_title` | for children | Must resolve to an existing category/service |
| `slug` | generated | Lowercase, hyphenated, unique; never changes after publication |
| `keyword` | yes | From the keyword sheet |
| `short_description` | no | Source copy, not final copy |
| `specifications` | no | Facts only; never invented |
| `image` | no | Stored path relative to `public/uploads`; never rewritten by content work |
| `status` | yes | 1 = published |
| `sort_order` | no | Stable ordering |

Mapping rules:

- The data source is imported once into the project's data file (or DB) and then frozen;
  later edits go through the same file so the audits stay comparable.
- Slugs are generated from the title with a deterministic rule (lowercase, strip
  accents, non-alphanumerics → hyphen, collapse, trim) and de-duplicated with a suffix.
- Parent titles are resolved before import; an unresolved parent is a stop-and-fix, not
  a silently dropped row.
- Facts are copied, never invented. Missing facts are left out of the copy and recorded
  as an open question if they are important.

### 2.4 Content-source decision tree

1. Client supplies final copy → reformat to the standard without changing facts or
   claims; run the same audits; quote the source in the activity log.
2. Existing site copy → treat as fact source; rewrite to the standard; never copy a line
   verbatim from the old site if it collides with another record.
3. No copy → write original content from the data sheet + keyword sheet + verified facts.
4. Mixed → mark every record's source in the data file; audits are identical either way.

### 2.5 Bootstrap a new project

1. Copy this file to the project root.
2. Create `rules.txt` with the project profile (§6.1) and start at section 1.
3. Create `activity-log.md`, `error-log.md`, `todo.md` with the templates in §11.
4. Run the audit in §3 and write the first log entry before changing anything.
5. Write the first rule section, then work.

---

## 3. The project audit (do this before any change)

### 3.1 Filesystem inventory

Record: top-level directories, app structure, config files, migrations, seeders and
data files, views and components, public assets and uploads, existing logs, stray
files, and the framework version.

```powershell
# Example (Windows / PowerShell). Adapt the paths to the project.
Get-ChildItem -Force | Where-Object { $_.Name -notin @('node_modules','vendor','.git') }
Get-ChildItem app -Recurse -File
Get-ChildItem database -Recurse -File
Get-ChildItem resources\views -Recurse -File
Get-ChildItem public -Directory
```

Record counts, not just names. A view that exists but is never routed, a model with no
table, a table with no model, and a migration with no file are all findings.

### 3.2 Stack and configuration

- `composer.json`: PHP and framework versions, admin panel package, image package,
  test stack. Flag any README/requirement mismatch.
- `.env` (never print secrets): `APP_ENV`, `APP_DEBUG`, `APP_URL`, timezone, locale,
  database, cache/session/queue drivers, mail, reCAPTCHA, module flags, location
  settings, sitemap versions.
- `config/app.php`: custom keys (default page, static pages path, location allowed
  pages, cache TTLs, modal names, panel flags).
- Config cache status: a cached config can hide `.env` changes until cleared.

### 3.3 Database and table structure audit

Dump the schema with a disposable PHP script using PDO (the CLI may have no `mysqli`):

- every table with its row count;
- every column: type, nullability, key, default, extra;
- every index and foreign key;
- polymorphic columns and their distinct types;
- integrity checks: orphan children, missing parents, duplicate slugs, NULLs in required
  fields, JSON columns that are not valid JSON, empty required payloads;
- **migration parity**: every file has a row and every row has a file; note guard
  migrations and feature-flagged migrations;
- **disk parity**: every stored image path exists under `public/uploads`; every upload
  file is referenced or consciously kept;
- **meta parity**: one meta row per published URL slug; report the missing ones;
- **feature parity**: a disabled module has no table *and* no reachable admin route;
  a module enabled later needs a new migration, because the original flagged migration
  has already run.

Output goes to a UTF-8 text file. On Windows, PowerShell `>` writes UTF-16 for native
commands — either read it back with `-Encoding Unicode` or have PHP write the file.

```php
// Skeleton: disposable schema dump (delete afterwards).
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=DB;charset=utf8mb4', 'USER', 'PASS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
foreach ($pdo->query('SHOW TABLES') as $row) { /* count + describe each table */ }
```

### 3.4 Content-flow audit

Answer these questions in writing:

- Where does page copy live: config, DB column, JSON column, data file, Blade?
- Who writes it: admin panel, seeder, manual SQL?
- How does a record reach a view: route → controller → service → block resolver →
  model → view? Draw the path.
- What is cached, for how long, and how is the cache invalidated on write?
- Which fields are in scope for a content change, and which must not be touched?

### 3.5 URL audit

- List every route and the catch-all behaviour.
- List every published URL form: home, static pages, category, product, blog, sitemap,
  policies, location-prefixed variants, keyword variants.
- Record the status of every URL: 200, 301/302, 410, 404. A soft 404 or an accidental
  410 is a defect.
- Check the sitemap count against the published URL list.
- Check robots.txt and the canonical tag.

### 3.6 SEO audit

- One meta row per URL (title, description, keywords, OG, schema where used).
- Meta title ≤ ~60 chars, keyword first, no location in the stored value.
- Meta description ≤ ~120 chars, contains keyword and brand.
- Location is appended by the formatter at render time, never stored twice.
- `noindex` is applied only to pages intentionally excluded (e.g. explore).
- No duplicate meta titles/descriptions across records.

### 3.7 Record the findings

Sort every finding into one of four buckets before fixing anything:

| Bucket | Meaning | Destination |
|---|---|---|
| Defect | A rule breach, broken URL, missing data, crash | `error-log.md` §A, fix this step |
| Production item | Correct locally, wrong at deployment (env, mail, keys, restricted routes) | `error-log.md` §C |
| Decision | The fix changes meaning, scope or published pages | `error-log.md` §D + `todo.md` open questions |
| Observation | Informational, not a breach (overlap runs, dormant features) | `error-log.md` §E/§H |

Never fix a Decision item by yourself. Never leave a Defect item unfixed without a
written reason.

### 3.8 Audit output template

At the end of the audit write a short report:

```
STACK        Laravel x, PHP y, panel z
TABLES       n content, m support; row counts ...
DATA         records: a categories, b products, c blogs, d pages, e metas, f faqs
URLS         n published forms; status summary
CONTENT      blocks present; fields in scope; data source
SEO          metas present/missing; sitemap count; robots line
DEFECTS      numbered, with evidence
DECISIONS    numbered, with options
OBSERVATIONS numbered, with "no action" or a follow-up
```

---

## 4. The target structure (what "converted" means)

### 4.1 Principle

Thin controllers, service classes for resolution and data access, configuration-driven
content blocks, versioned caches, one admin resource per entity, one Blade template per
page type, shared components for chrome and SEO. Content is data, not markup in views.

### 4.2 Directory layout

| Path | Purpose |
|---|---|
| `app/Http/Controllers/Client/PageController.php` | One resolver for every public URL |
| `app/Services/Middlewares/CleanUrlService.php` | Parses segments, validates page/slug/location/keyword, returns `CleanUrlDTO` |
| `app/Services/Applications/ContentService.php` | Loads the blocks configured for the page |
| `app/Services/Database/BlockResolverService.php` | Resolves one configured block: select/conditions/order/search/relations/tree |
| `app/Services/Database/ModalService.php` | Versioned, cached model queries; bumps the version on write |
| `app/Services/Metas/*` | Loads the meta row and formats placeholders/location |
| `app/Services/Keywords/*` | Loads the keyword row for the entity (keyword landing URLs) |
| `app/Services/Locations/*` | Location tree, closure table, parent chain |
| `app/Services/Commons/*` | Shared blocks (menu, contact, SEO) and static page discovery |
| `app/DTO/CleanUrlDTO.php` | Immutable resolution result |
| `app/Enum/LocationType.php` | Country / state / district / city / village |
| `app/Exceptions/GoneException.php` | Turns invalid historical URLs into 410 |
| `app/Console/Commands/*` | Sitemaps, safe migrate, production deploy |
| `app/Filament/Resources/<Entity>/` | Admin CRUD: Resource + Pages + Schema + Table |
| `app/View/Components/*` | Header, footer, sidebar, meta, links, enquiry, floating icons |
| `config/app.php` | Custom keys and module flags |
| `config/commons.php` | Shared block definitions |
| `config/page_content.php` | Page → block definitions |
| `config/modals_group_structure.php` | Slug resolution order and meta/keyword model names |
| `database/migrations/*` | Schema, with feature-flagged modules |
| `database/seeders/*` + `data/*` | Idempotent import of the data source and copy |
| `resources/views/client/pages/*` | One template per page type |
| `resources/views/components/*` | Shared markup |
| `public/uploads/*` | Mirrored media, never rewritten by content work |
| `public/assets/css/completion.css` | Styles for elements the theme misses |
| `public/seo/*` | Generated sitemaps |

### 4.3 Request flow

```
GET /{location?}/{page?}/{slug?}/{keyword?}
  → routes/static.php catch-all
  → PageController::resolve()
      → parseSegments()               (max 4 segments)
      → CleanUrlService::resolve()    (cache-first; validates page, slug group,
                                       location chain, keyword)
      → GoneException → 410
      → validateLocationPage()        (only allowed page types under a location)
      → ContentService::get()
          → BlockResolverService::resolve() per config block
              → ModalService (versioned cache)
              → model query + relations + tree
      → View::share(cleanUrl, location, commons, keyword)
      → response->view('client.pages.{page}')
  → layout + meta component + chrome components
```

A page type that is configured but whose record is missing must 404 cleanly. An invalid
route shape, excessive segments or a disallowed location page must 410, not 404.

### 4.4 Data model

The reference model has three catalogue entities and four content entities. Adapt the
names to the project; keep the conventions.

| Table | Key columns | Relations |
|---|---|---|
| `categories` | `id`, `slug` UNIQUE, `title`, `image`, `description` TEXT, `content` JSON, `status`, `featured`, `explore`, `seo`, soft deletes, timestamps | hasMany products, hasMany subcategories, morphOne FAQ |
| `sub_categories` | parent `category_id` FK, same columns | belongsTo category, hasMany products |
| `products` | `category_id` FK, optional `sub_category_id`, `slug` UNIQUE, `title`, `image`, `description`, `content`, flags, soft deletes, timestamps | belongsTo category, morphOne FAQ, siblings scope |
| `services` | optional self `parent_id`, same catalogue columns | belongsTo parent, hasMany children |
| `blogs` | `slug` UNIQUE, `title`, `image`, `description`, `content` JSON, `status`, soft deletes | siblings scope |
| `pages` | `slug` UNIQUE, `content` JSON | — (static pages) |
| `components` | `slug` UNIQUE, `content` JSON | — (home sections) |
| `banners` | `image`, `video`, `type` (desktop/mobile), `media_type`, `status`, soft deletes | — |
| `metas` | `slug` UNIQUE, `meta` JSON (`[{name,value}]`), `status`, soft deletes | — |
| `faqs` | `entity_type`, `entity_id`, `content` JSON (question/answer pairs) | morphTo entity |
| `keywords` | `entity_type`, `entity_id`, `keywords` JSON | morphTo entity |
| `locations` | `location`, `slug`, `type` ENUM, `is_selected`, `is_active`, soft deletes | closure table |
| `location_closures` | `ancestor_id` FK, `descendant_id` FK, `depth` | tree queries |
| `users` | `name`, `email`, `password`, `additional_info` JSON (branding, contacts, scripts) | admin owner |

Conventions that must survive conversion:

- `id` bigint unsigned auto-increment; `slug` unique and immutable after publication.
- `status` boolean default true; `deleted_at` soft delete on every content table.
- `description` is TEXT (rendered copy) and `content` is JSON (structured blocks).
- `image` stores a path relative to `public/uploads`; it is never rewritten by a copy step.
- Money, dates, units: store raw; format in the view.
- JSON casts on the model; `array` cast for `content`, `meta`, `additional_info`.
- Polymorphic rows are keyed on `(entity_type, entity_id)` with a covering index.
- Foreign keys on catalogue parents; cascade or restrict deliberately, never silently.

### 4.5 Configuration contracts

- `config/page_content.php`: page → block map. Each block names its model (`modal`),
  conditions, select columns, optional `search.column`, `with` relations, `first`,
  `tree`, ordering. A block without a `modal` is skipped, not guessed.
- `config/commons.php`: shared blocks — menu (categories with products), contact (the
  user row that carries branding), SEO (the flagged product, if used).
- `config/modals_group_structure.php`: the order in which a slug is looked up
  (category, product, blog, …) and the model names for metas and keywords.
- `config/app.php`: module flags, allowed location pages, cache TTLs, default page,
  static page path, recipient e-mail, sitemap versions.
- `.env` owns secrets and per-environment values only; no `env()` calls outside config.

The contracts above are the summary. The mechanics behind them — how segments resolve,
how a block becomes data, how metas format, how cache versions work — and step-by-step
recipes for extending any of them are in **PART E (§14–§16)**.

### 4.6 URL grammar

```
/                                  home
/{page}                            static page (about, contact, policies, sitemap, ...)
/{page}/{slug}                     category | product | blog detail
/{location}/{page}/{slug}          location-prefixed detail (allowed page types only)
/{location}/{page}/{slug}/{keyword} keyword landing page (keywords table)
```

Rules:

- One catch-all route; no route per record.
- Max four segments; more is 410.
- A static page name may appear in the first segment; resolution handles the ambiguity.
- A slug is resolved through the configured group; the first match wins and records the
  model class + id in the DTO.
- A location must exist, be active, and have a valid parent chain; otherwise 410.
- A location prefix is allowed only for the page types in `LOCATION_ALLOWED_PAGES`.
- A location prefix on a product detail URL is valid only when the product's `seo` flag
  is true. `seo = false` product location URLs answer 410; their canonical
  `/product/{slug}` URL still works. Location-prefixed explore URLs are governed by
  `LOCATION_ALLOWED_PAGES` and remain available.
- A keyword must exist in the keywords table for the resolved entity, otherwise 410.
- Invalid routes throw `GoneException` → 410. Missing records → 404.

### 4.7 Meta contract

- One `metas` row per URL slug (home, static pages, each category, product, blog).
- `meta` JSON holds `{name, value}` pairs: `title`, `description`, `keywords`, `og:*`,
  and `schema` entries where used.
- Stored title and description are location-free. The formatter appends
  ` in {location}` (or replaces `{location}`, `{full_location}`, `$keyword`).
- Canonical is the current URL; OG/Twitter tags are generated from the same values.
- `noindex` only for intentionally excluded pages.
- Missing meta rows are defects for launch.

### 4.8 Cache contract

- All model reads go through `ModalService` and are cached under a versioned key.
- Writes through `ModalService` bump the model version, which invalidates every derived
  cache key (block, meta, page).
- `php artisan optimize:clear` (or the site's optimize route) runs after any data,
  config or view change during development.
- TTLs are configured, not hard-coded; the prefix is configured.
- Cached meta/block payloads must include the model version; otherwise edits look lost.

### 4.9 Admin contract

- **One panel, one login.** Every module has a resource in the standing shape:
  `Resource`, `Pages`, `Schemas/<Entity>Form`, `Tables/<Entity>Table`. The panel is the
  only surface on which content is edited.
- **Four resource kinds**, each with its own shape:
  - *Content resources* — one row per record, full CRUD (catalogue entities, blogs,
    banners, FAQs, metas).
  - *Singleton page resources* — one page row per slug (about, policies, disclaimer):
    Edit page only, route at `/`, `mount()` does `firstOrCreate(['slug' => …])` so the
    row always exists.
  - *Singleton component resources* — one component row per section slug (stats,
    why-choose-us, applications): the same singleton shape.
  - *Settings resource* — the profile row: Edit only, out of the navigation, reached
    from the user menu.
- **Brand comes from the settings row.** Logo, favicon and brand name are read from the
  profile row (`users.additional_info`) — the site renames itself through an edit, not a
  deployment.
- **The user menu carries the operations.** Profile, clear cache and generate sitemap
  call the same routines as the console commands; they are never public URLs of their
  own.
- **Navigation is grouped.** Every resource declares a group and a label; the group set
  is a project decision and stays stable once content exists.
- **Dashboard widgets** add small counts; a widget must survive an empty or missing
  table instead of breaking the dashboard.
- **Module switches.** A flagged resource checks the flag in `canAccess()` and lets
  `shouldRegisterNavigation()` delegate to it — one source of truth, so a switched-off
  module is hidden *and* answers 403 on direct URL (§12.3 H1, §16). Hiding the menu
  alone is not a switch.
- Forms mirror the columns and casts; JSON blocks are edited as repeaters/structured
  fields, not raw JSON where possible; slugs stay read-only, generated from the title.
- The profile row carries branding, contact details and injected scripts; one resource
  edits it.
- Every write path invalidates the cache (through the service or an observer); until
  that exists, the clear-cache action is part of the save workflow.

### 4.10 Deployment contract

- `APP_ENV=production`, `APP_DEBUG=false`; `APP_URL` is the canonical domain.
- `config:cache`, `route:cache`, `view:cache` after deploy; `optimize:clear` before.
- **Commands ship with the project:** sitemap generation, the go-live routine, the
  guarded bulk import and every project-specific command live in the console command
  folder with a signature and a description; a release records which ones ran.
- **The go-live routine rewrites `.env`** (env/debug/session/cache/queue drivers) and
  **rotates `APP_KEY`** (`key:generate --force`): sessions, cookies and encrypted values
  do not survive the rotation — run it once at first deploy, never casually on a live
  database. Re-run `optimize:clear` / `config:cache` after any later `.env` change.
- **Bulk data is guarded and sourced.** The location import runs only while its table is
  missing and reads SQL files kept with the project, so a fresh install rebuilds the
  location tables without the live database (§15.7).
- **Operational endpoints.** `/optimize` (clear + rebuild the framework caches) and
  `/sitemap/{version}` (runs the sitemap command, version bounded by config) sit behind
  the admin authentication, take no free-text input, and mirror console commands; in
  production they are authenticated or removed.
- Scheduler runs the project's scheduled work (session/cache pruning, sitemap refresh);
  a project with nothing scheduled says so explicitly instead of leaving a silent gap.
- Upload permissions verified (§4.11); no file depends on `storage:link`.
- Log channel `daily`; the repository ships no stale `laravel.log`.
- `robots.txt` points at the current sitemap URL on the canonical domain.

### 4.11 Uploads and media contract

- **One disk for uploads.** The project defines a single upload disk whose root is the
  public upload directory (this project: `public_root` → `public/uploads`). No upload
  goes to `storage/app/public`, and no file depends on `storage:link`.
- **One directory per entity.** Each record type and page component keeps its files in
  a directory of its own (`{entity}/{uuid}.{ext}`); the record stores that relative
  path and the view renders it as `uploads/{path}`. The database value and the disk
  path are the same relative string.
- **Images become webp on upload.** The image is decoded and encoded to webp by the
  image library inside the upload handler; the uploaded original format is never
  served. Non-image files keep their own type and extension.
- **Web-root exception.** Files that must be served from the site root (`llms.txt`,
  `robots.txt` if editable) are the only ones outside the upload root, on their own
  disk (`public_root_simple` here) under a fixed name.
- **Enforced in the admin (§4.12), not next to it**: every file field uses the disk,
  the entity directory and the webp handler; table image columns read the same disk.
- **Validate at the field**: `acceptedFileTypes`, `maxSize`, and an exact-dimension
  rule where the layout needs a fixed ratio.

### 4.12 Filament rules

- One resource per entity in the standing shape: `Resource`, `Pages`,
  `Schemas/{Entity}Form`, `Tables/{Entity}Table`.
- A module that is off is hidden from the navigation **and** blocked by `canAccess()`;
  hiding the menu alone is not a switch (§12.3 H1).
- Forms mirror the columns and their casts; JSON content is edited with repeaters and
  structured fields, never typed as raw JSON. Slugs stay read-only, generated from the
  title.
- Every file field follows §4.11: upload disk, entity directory, webp handler for
  images, type and size validation. An image field without the webp handler is a
  defect.
- The profile row (`users.additional_info`) carries brand data, contacts, branding
  files, the brochure, `llms.txt` and custom code; it is edited in one resource.
- Every save must invalidate the caches the site reads. Until an observer bumps the
  model version automatically (§14.7, decision D24), the clear-cache action is part
  of the save workflow.
- Replacing a file leaves the old one on disk (the record keeps the new path); an
  optional maintenance command can remove unreferenced files.

### 4.13 Forms, enquiries and mail contract

- **Every form posts to a named route of its own.** POST endpoints are declared in the
  route file ahead of the dynamic catch-all and keep the web middleware (CSRF on); a
  form never posts to a dynamic URL.
- **Server-side validation is the contract.** Required fields, formats (e-mail, mobile),
  length caps and the anti-spam token are validated in the controller; client-side
  checks are convenience only.
- **Anti-spam is part of the field set.** The layout loads the provider script once when
  a site key is configured; each form carries the hidden token field; the controller
  verifies the token server-side (secret + score threshold) and rejects on failure.
  Missing keys in production fail the form — a launch blocker, not a warning.
- **The recipient comes from the settings row**, with a config fallback — never
  hard-coded in a view. The mail is a mailable class with its own view; subject and view
  name are part of the project.
- **Flash contract.** The controller answers `back()` with a `success` or `error`
  flash; the shared alerts component renders session flashes and validation errors; a
  browser POST never gets a bare JSON body back.
- **Privacy.** Form payloads are not logged; failures surface as generic messages.
- **Field names match everywhere** — form HTML, validation rules and the mail view use
  the same names.

### 4.14 Layout, components and static pages contract

- **One layout.** Every public page renders through the shared layout; the layout owns
  the `<head>` (meta component, head links, per-page stacks), the chrome order (header,
  sidebar, alerts, content, footer, enquiry modal, floating icons), the body scripts
  and the custom code slots from the settings row.
- **Components resolve their own data.** View components are class-backed
  (`App\View\Components\…`): each either resolves what it needs through the services
  (meta, locations) or renders a partial whose top `@php` block reads shared data;
  logic never sits in the markup.
- **Shared view data is set by the resolver** before the view renders — clean-URL DTO,
  formatted location, location chain, commons and keyword. Templates and components
  read those variables; they do not query the database on their own.
- **Page = file name.** A Blade file in the static pages folder is a page (§14.10); the
  default page and the folder are config, not code.
- **A page that declares content must have content.** A page listed in `page_content`
  renders its blocks; when the record is missing or empty the page 404s — fail loudly,
  never render a blank page.
- **Error views extend the same chrome.** 404 and 410 render through the project's
  error views; the resolver maps invalid route shapes to 410 and missing records to
  404.
- **Assets have a fixed order.** Theme CSS first, project CSS after, the completion
  stylesheet last so it wins; scripts at the end of the body; per-page extras travel
  through the layout stacks; CDN files are preloaded with a local fallback.
- **Custom code slots are the only raw script injection.** Header, between head/body
  and body scripts come from the settings row; nothing else injects raw scripts into a
  page.

---

## 5. Converting a project (Laravel or plain PHP)

### 5.1 Map first

Build a mapping table before writing code:

| Source | Target table | Target model | Notes |
|---|---|---|---|
| products sheet | `products` | `Product` | parent resolved from category column |
| category column | `categories` | `Category` | unique titles |
| blog export | `blogs` | `Blog` | slug from title, title verbatim |
| static pages | `pages` | `Page` | content JSON per section |
| contact/branding | `users.additional_info` | `User` | one row |
| images | `public/uploads/{entity}/` | — | bytes unchanged |

Unmapped fields are recorded as open questions; they are not dropped silently.

### 5.2 Freeze the content source

Convert the supplied data into the project's data file (PHP array, JSON or CSV) with one
record per row, stable keys and explicit facts. This file is committed and is the only
input to the seeder. Keep the raw client file outside the repo if it contains private
data.

### 5.3 Migrations

- Create one migration per entity, matching §4.4.
- Feature-gate optional modules (`sub_categories`, `services`) on the config flags.
- Guard migrations that touch pre-existing tables (`if (!Schema::hasTable(...))`,
  `if (!Schema::hasColumn(...))`) so fresh and existing databases both converge.
- Never edit an applied migration. Enabling a module later needs a new migration.
- A migration record with no file (or a file with no record) is drift: document it and
  reconcile before the next deployment.
- Test a fresh install (`migrate:fresh --seed`) in a disposable database before launch.

### 5.4 Seeders and rendering

- Idempotent: `updateOrCreate` keyed on the slug, or on `(entity_type, entity_id)` for
  polymorphic rows.
- The seeder renders structured content into `description`/`content` exactly as the
  project's renderer expects; the renderer is the only producer of those fields.
- Re-running the seeder on an unchanged data file changes nothing.
- After a render: compare every rendered row with the data file (0 mismatches) and clear
  the cache.

### 5.5 Models and relations

- `fillable`, `casts`, `SoftDeletes`, `getRouteKeyName() = 'slug'`.
- Parent and child relations, filtered by `status` where the site requires it.
- `morphOne(FAQ::class, 'entity')` on catalogue records.
- A `siblings()` scope for related items, excluding self.
- Contextual methods (`locationXxx`, `keywordXxx`) only when the site genuinely
  localises content; the resolver finds them by name — document the convention.

### 5.6 Routes and resolution

- Replace per-page routes with the catch-all resolver (§4.3).
- Build `CleanUrlDTO` immutably; no service returns arrays of mixed meaning.
- Validate in this order: page → slug → location → keyword.
- Return 410 for invalid historical shapes and 404 for valid shapes with no record.
- Keep contact-form and utility routes separate and auth-gated where needed.

### 5.7 Views and components

- One template per page type; chrome in components; meta in one component.
- Templates read resolved data and print; they do not query.
- All copy HTML passes through the shared link component that rewrites canonical
  `/category/{slug}` and `/product/{slug}` hrefs to the current location prefix (only
  for records flagged `seo`), leaving anchor text untouched.
- Headings follow the project's heading rule (§6.7).
- Elements the theme does not style are completed in `completion.css`, one commented
  section per element, copied from a styled sibling; markup is not restructured (§6.13).

### 5.8 Metas and keywords

- Seed one meta row per published slug; add missing rows before launch.
- Store location-free values; let the formatter do location and keyword substitution.
- Seed keywords only if keyword landing pages are in scope; otherwise leave the table
  empty deliberately and document it.

### 5.9 Locations

- Import the location hierarchy (SQL dump or seeder) into `locations`.
- Build the closure table (ancestor, descendant, depth) with indexes and FKs.
- Mark the publishable set with `is_selected`; keep the rest inactive.
- Validate the parent chain at resolve time; never trust a slug alone.

### 5.10 Sitemaps, robots, redirects

- Generate sitemaps from the published URL list, not from a hand-written file.
- Re-generate after any slug, status or domain change.
- Keep the old-URL map; 301 where an equivalent exists, 410 where it does not.
- robots.txt points at the canonical sitemap; no sitemap entries for noindex pages.

### 5.11 Assets

- Mirror the live site's `/uploads` bytes exactly; never rename or re-encode during a
  content step.
- Store image paths relative to `public/uploads`; verify every path exists on disk.
- Optimise only on explicit instruction, and record before/after sizes.

### 5.12 Verify the conversion

Run §7 in full before calling the conversion done. A conversion that renders but fails
the URL sweep, metas audit or content audit is not done.

---

# PART B — THE CONTENT STANDARD

## 6. Content rules (generic, parameterised per project)

### 6.1 The profile table

These are the **defaults of the Oases profile**. Each project's `rules.txt` may set
different numbers; the *shape* stays the same.

| Parameter | Default |
|---|---|
| Description paragraphs | 4 |
| Paragraph roles | P1 intro; P2 question; P3 question; P4 conclusion |
| Question placement | inside P2 and P3; Akum override: question-first and highlighted |
| Point blocks | at least two (e.g. features, why choose us / benefits, specifications) |
| Points per block | exactly 5 |
| Point format | `<strong>Heading</strong> : explanation` |
| Block intro / closing | ≥ 250 / ≥ 200 characters |
| Keyword set | supplied set; each keyword ≥ 4 occurrences, in 4 sentences, 4 wordings |
| Record name | ≥ 4 occurrences |
| Parent name | ≥ 4 occurrences; child records link the parent ≥ 3 times in the description (in 3 paragraphs) and ≥ 2 outside |
| Highlights | ≥ 16 per record; ≥ 5 in the description (floor, not target) |
| Highlight form | long-tail phrase, 2+ words (Akum override: 3+), verbatim, never a single word, never inside/around a link |
| Required keyword phrases | Akum override: `top rated`/`best` + product name + `manufacturers`/`suppliers` in P1/P4 and in the features and why-choose intros/closings |
| FAQ | 5 pairs: application, supply/export, customisation, materials/quality, quotation |
| Meta title | ≤ ~60 chars, keyword first, no location |
| Meta description | ≤ ~120 chars, keyword + brand |
| Uniqueness | 0 identical lines; 0 pairs ≥ 0.50 Jaccard; first line unique; no 5-word run inside a line |
| Brand | the legal name only |

> **Akum Globus override (see `rules.txt` rule 14):** P2/P3 open with a highlighted
> question; P1 and P4 carry `top rated`/`best` + product name + manufacturers/suppliers;
> the features and why-choose intros/closings carry all four words with the product name;
> body, FAQ, meta description and keywords are location-free; a meta title may retain a
> location only when the product name itself contains it; the standard contact paragraph
> is excluded from the cross-record similarity comparison.

### 6.2 The block skeleton

Whatever the client calls the sections, each one has a role. Map the role, keep the
shape.

| Role | Shape | Notes |
|---|---|---|
| Description / overview | 4 paragraphs as in §6.1 | Carries the record name, parent links and the highlight floor |
| Proof block (features, specifications, what we do) | intro ≥ 250 chars + exactly five points + closing ≥ 200 chars | Every point explains, not just names |
| Trust block (why choose us, benefits, guarantees) | same shape as the proof block | Different wording from the proof block; no shared lines |
| Applications / use cases | intro + five use cases + closing | Answer "where/for whom"; link the parent where natural |
| Contact block | heading + one closing paragraph + mailto + brand | No repetition from the other blocks |
| FAQ | exactly five Q/A pairs, coverage matrix | Unique stems and answers; brand in the quotation answer |
| Blog | opening + h3 sections + at least one list + closing naming the brand | Title verbatim; ≥ 1 category link |
| Policy pages | numbered clauses, plain English, legal name and domain correct | Not part of the catalogue audit; still unique |

Rules that apply to **all** blocks:

- Answerable: a heading names a real buyer question; the first sentence answers it.
- No block repeats a sentence from another block of the same record.
- Every block that names the parent links it (canonical href, anchor = parent title).
- Keywords are distributed across blocks, never stacked in one line.
- Highlights are placed where they already read naturally; never force a phrase.
- The last block invites contact; earlier blocks do not.

### 6.3 Voice and tone

- Plain, factual English; present tense; second person where it addresses the buyer.
- One idea per sentence; no marketing filler ("world class", "state of the art",
  "one stop solution") unless the keyword sheet explicitly asks for it.
- The legal brand name exactly as supplied; no abbreviations, no other brand names.
- Numbers and units: words where natural ("five"), digits in measurements.
- Consistent regional spelling for the project (British or American), never mixed.
- No sentence ends with ".."; no heading carries a doubled full stop; sentences start
  with a capital letter, including one that opens with a highlighted phrase.
- Claims are only what the client confirmed. Unknown certifications, years, counts or
  guarantees are omitted or asked about.

### 6.4 Answerable content

Content is written for questions a buyer actually asks:

- P2 and P3 of the description each hold one question and answer it in the same
  paragraph. The two questions differ. Akum override: the question opens the paragraph
  and is wrapped in `<strong>...</strong>`.
- Point headings are buyer questions or buyer concerns, answered by the explanation.
- FAQ coverage per record: application ("Which sites/projects is it for?"), supply and
  export ("Can you supply/export to …?"), customisation ("Can it be made to …?"),
  materials and quality ("What is it made of / how is it checked?"), quotation ("How do
  I get a price?"). The quotation answer names the brand and the contact channel.
- Meta titles and the H1 answer "what is this and where", not a slogan.

### 6.5 Keywords ("provided on the go")

Input: the keyword sheet (§2.2). Application:

1. The primary phrase appears in the H1/meta title and early in P1.
2. Every member of the supplied secondary set appears at least the profile count
   (default four) in the record's content, in different sentences and different
   wordings — not four repetitions of one line.
3. Long-tail phrases from the sheet are used where they fit naturally; they are the raw
   material for highlights.
4. Distribution: at least one occurrence in the description and at least one outside it;
   no single line carries the whole set.
5. Density is checked by counting, not by feel. A phrase that cannot be used naturally
   is reported, not forced.
6. Keyword landing URLs (if enabled) require a `keywords` row per entity; otherwise the
   URL form stays off.

### 6.6 Highlights (long-tail, `<strong>`)

- Floor: five highlighted long-tail phrases in every description; sixteen per record
  (this profile). More is allowed when a real phrase exists; the floor is not a target.
- Only phrases of two or more words (Akum override: three or more) that read as one meaningful term.
- The P2/P3 questions and the main keyword phrase in each answer are highlighted in the description.
- Never a single word; never two words that do not form a phrase; never inside a link,
  never wrapping a link.
- Verbatim: the phrase is wrapped exactly as the sentence already writes it. No word is
  added, removed or reordered by the wrapping.
- Spread: a paragraph that offers a phrase carries one; all highlights are not gathered
  in one paragraph.
- Proof of non-destructiveness: strip tags before/after and compare words — 0 changes.
- Tag balance is checked (`<strong>` openings = closings; `<a>` likewise).

### 6.7 Names, headings and parent links

- The record name appears at least four times; the parent/category name at least four
  times (products: three linked mentions in three description paragraphs + two outside).
- Anchor text is the target record's real title, exactly as its own page prints it.
- Stored href: canonical `/category/{slug}` or `/product/{slug}`. No location prefix in
  stored copy. The renderer adds the prefix for the current location (and only for
  records flagged `seo`).
- A product links its own category only; it never links another category as if it were
  its parent.
- Headings:
  - `Key Features of {name}{formattedLocation}`
  - `Why Choose Us For {name}{formattedLocation} ?`
  - `Contact Us For {name}{formattedLocation}`
  On a product page `{name}` is the product; on a category page the per-product feature
  block carries the product title, while why-choose-us and contact carry the category.
- Every published record is linked from its parent listing and from the sitemap page;
  no orphan records.

### 6.8 Uniqueness — the definitions

- **Line** = one sentence of rendered copy with tags stripped, the brand name masked,
  whitespace collapsed, split on sentence-ending punctuation. Audit across categories,
  products and blogs together, including within a record.
- **Identical lines**: 0 allowed.
- **Similarity**: Jaccard on word sets; ≥ 0.50 is a breach. Lines with fewer than eight
  distinct words are exempt from this test (ordinary question stems), but not from the
  identical-line test.
- **First line**: unique per record.
- **Internal repetition**: no line repeats a run of five or more consecutive words
  inside itself.
- **Overlap report** (informational): runs of six consecutive words shared between two
  records. Report the count and the causes (required brand, required e-mail, shared
  keyword phrases). This is not a rule breach; it is a quality signal.
- Every content change re-runs the full audit; a non-destructive edit (highlight wrap,
  link insertion) must return the same numbers before and after.

### 6.9 Meta structure

- One row per published URL: static pages, products and blogs. The home page has no meta
  row; the layout falls back to the application name and omits empty description/keyword
  tags.
- Product title: `Top Rated {product name}` or `Best {product name}`, max 60 characters,
  no location and no brand. Product description: max 120 characters, carrying
  top rated/best and manufacturer/supplier with the product name where the limit allows.
- Product keywords: `{name} in {location}, top rated {name} manufacturers in {location},
  top rated {name} suppliers in {location}, best {name} in {location}, best {name}
  manufacturers in {location}, best {name} suppliers in {location}, {name} manufacturers
  in {location}, {name} suppliers in {location}, {name} traders` (the fixed Akum
  nine-phrase frame; do not add more). `{location}` renders as Haryana on canonical
  product URLs and as the URL location on location-prefixed product URLs (for example
  Delhi at `/delhi/product/{slug}`). Titles and descriptions remain location-free.
- Blog title max 60 characters, description max 120 characters, with blog-specific
  keywords.
- Normal pages except the home page: meta title is the page name only, description max
  120 characters, and no keywords tag.
- Location and keyword substitutions happen at render (`{location}`,
  `{full_location}`, `$keyword`), never twice. A location suffix must not be appended to
  product meta titles or descriptions, including location-prefixed product URLs.
- Explore is a non-product page: `/{location}/explore` is allowed. Its meta title and
  description take the current-location suffix within the 60/120 limits; its H1,
  breadcrumb and card titles use the formatted location. Product meta titles and
  descriptions remain location-free.
- No two product records share a title or description; the same uniqueness test applies
  as a practical check. Generic polyol records may share a title only when the product
  name is genuinely identical; prefer a distinct clean product label.
- Missing meta rows are launch blockers, except the deliberately absent home-page row.

### 6.10 Images

- Content work never rewrites an image column, image list or asset.
- Stored paths are relative to `public/uploads`; every path exists on disk.
- Live-site mirroring means identical bytes at the same relative path.
- If the live site has no image for a record, leave it as the live site has it and record
  the decision; do not invent an image.

### 6.11 Chrome and page furniture

- Desktop header and footer list at most three top-level categories; the sidebar may
  list all. The cap is applied where the list is rendered, so adding a category later
  cannot break the layout.
- The footer links the sitemap page under Quick Links, immediately below Blogs.
- The footer Explore Products link keeps the active location prefix. On
  `/{location}/explore`, only `seo = true` card links use
  `/{location}/product/{slug}`; `seo = false` cards link to the canonical
  `/product/{slug}` and receive no location suffix. A product title that already names a
  location is not given the URL location again.
- The products page keeps `/products` as its canonical form; `/{location}/products` is
  allowed and its H1, breadcrumb and section title use `formattedLocation`. Its cards
  follow the same gate: only `seo = true` cards use `/{location}/product/{slug}` and
  append `formattedLocation`; `seo = false` cards stay canonical and keep the simple
  title. The 7 menu records are not on the supplied whitelist and are therefore
  `seo = false`; the 43 explore records follow the same whitelist rule.
- Akum override: the static location template is written inline in the product detail
  view and may render only on a location-prefixed product route whose record is
  `seo = true`; the products listing has no static block. It has exactly two headings
  (manufacturers and suppliers), four unique paragraphs, and repeats the exact product
  title plus `formattedLocation` in every paragraph and highlight. It is the one
  intentional exception to the location-free body rule and is excluded from the
  cross-record uniqueness comparison (`rules.txt` rule 16). The floating WhatsApp
  component uses the Oases message contract: a default message on ordinary pages, a
  product/category/blog message with the readable slug and location, and a `Page URL`
  line, URL-encoded into both the desktop and mobile links.
- The sitemap page lists quick links, every category with its products under it, and
  every blog, all linked with the site's canonical URL form.
- The contact e-mail appears in each record's contact block as a `mailto:` link with the
  address as visible text, once per record.
- Elements the theme does not style are completed in one commented stylesheet, loaded
  after the responsive sheet; markup is not restructured.

### 6.12 Content QA — per record

Run before saving a record:

- [ ] 4 description paragraphs; P1 intro, P2/P3 each open with a highlighted question,
      P4 conclusion with no question or CTA
- [ ] record name ≥ 4; parent name ≥ 4 (child: 3 linked description mentions in 3
      paragraphs + 2 outside)
- [ ] every keyword from the set ≥ 4 times, in 4 sentences/wordings, distributed
- [ ] highlights ≥ 5 in the description and ≥ 16 in the record; all 3+ words (Akum
      override); none single-word; none in/around a link; spread
- [ ] P1/P4 and the features/why intros/closings carry top rated, best, manufacturers
      and suppliers with the product name; body, FAQ and meta description are location-free
      (the location-only static template is the sole exception)
- [ ] two point blocks: intro ≥ 250 chars, five points, closing ≥ 200 chars
- [ ] contact block with heading, brand, mailto, no repeated wording
- [ ] 5 FAQs covering the five areas; unique stems and answers
- [ ] meta row present; title/description within limits; keyword first
- [ ] no identical line, no ≥ 0.50 pair, unique first line, no 5-word internal run
- [ ] tags balanced; no doubled full stop; legal brand only
- [ ] parent/child links canonical and present in both directions

---

# PART C — PROOF, ERRORS, TRACKING, DELIVERY

## 7. Verification toolkit

### 7.1 Measurement definitions

Fix the definitions once and reuse them; otherwise numbers drift.

```text
LINE          sentence with tags stripped, brand masked, whitespace collapsed,
              split on sentence-ending punctuation and line breaks
SIMILARITY    Jaccard on lowercased word sets; flag >= 0.50
SHORT LINE    fewer than 8 distinct words -> exempt from similarity, not identity
FIRST LINE    the first line of each record (description or rendered content)
WORD RUN      n consecutive words, compared after normalisation
WORD COUNT    tags stripped; brand masked only for the overlap report
```

### 7.2 Required audits

| # | Audit | Pass condition |
|---|---|---|
| 1 | Identical lines across all records | 0 |
| 2 | Line pairs ≥ 0.50 Jaccard | 0 |
| 3 | First-line collisions | 0 |
| 4 | Five-word run inside a line | 0 |
| 5 | Keyword occurrence counts | Every member ≥ profile count, in ≥ profile sentences |
| 6 | Record name / parent name counts | ≥ profile counts |
| 7 | Highlights | ≥ 5 per description, ≥ 16 per record, 2+ words, none single, none in links, tags balanced |
| 8 | Link counts | Parent links inside/outside the regions per the profile; anchor text = title; slug = real parent |
| 9 | Data file ↔ DB parity | 0 mismatches after re-render |
| 10 | Rendered pages | Region checks pass on every category/product/blog page |
| 11 | URL sweep | Every published form 200; intended dead forms 410; no soft 404 |
| 12 | Metas | One row per URL; lengths; keyword first; no duplicates |
| 13 | Sitemap | Count matches the published URL set; canonical domain |
| 14 | Disk parity | Every image path exists; every upload mirrored |
| 15 | Logs | No new application-log entry during the step |

### 7.3 Script patterns

- PHP CLI with PDO; never depend on `mysqli`.
- One disposable script per audit; delete it at the end of the step.
- Print counts and a short list of offenders; write a machine-readable summary when the
  set is large.
- On Windows, avoid `php -r` with complex quoting in PowerShell; write a file instead.
- Do not let PowerShell's default UTF-16 redirection corrupt output; write from PHP or
  read back with `-Encoding Unicode`.
- Audits must read the same source the site renders. If the site renders from the DB,
  compare the DB with the file; do not audit the file alone.

### 7.4 Rendered-page sweep

For every page type (home, static, category, product, blog, sitemap, policies):

1. Fetch the URL with a browser or HTTP client.
2. Isolate each region by its template markers (description, features, why, contact,
   FAQ).
3. Count highlights, links, names and keywords **inside each region**.
4. Re-check tag balance and the absence of single-word highlights.
5. Verify headings contain the record name and formatted location.
6. Verify the contact block contains the mailto link and visible address.
7. Record failures with the URL and the region; fix and re-fetch.

Also fetch location-prefixed variants where the site supports them and verify the stored
canonical links were rewritten correctly at render time.

### 7.5 Data ↔ database parity

- Re-run the project's renderer/seeder for every affected record.
- Read back every rendered field and compare with the data file (trimmed strings, tags
  preserved).
- Report `updated`, `verified`, `mismatches`. Only 0 mismatches passes.
- Clear the framework cache before re-reading the site.

### 7.6 Non-destructive edit proof

For edits that must not change words (highlight wrapping, link insertion):

- Snapshot the rendered plain text (tags stripped) before.
- Apply the edit.
- Compare word by word after. 0 differences = proof.
- Re-run the uniqueness numbers like-for-like; they must match the before run.

### 7.7 Evidence format

Every claim in the logs carries one of: a count (`42 rows, 0 mismatches`), a sample
(`"…" — page /product/x, region description`), a status (`200 on 59/59 URLs`), or a
reproducible command (`php artisan …`). No claim without one of these.

---

## 8. Error checking and self-resolution

### 8.1 The loop

```
SCAN -> CLASSIFY -> FIX (smallest safe change) -> VERIFY -> LOG -> CLEAN UP
```

If any step fails, do not proceed to the next; re-scan after the fix.

### 8.2 Classification

| Class | Examples | Action |
|---|---|---|
| Fix now | Broken link, 500, orphan record, missing meta row, unbalanced tag, wrong slug, stale cache after write, rule breach in copy | Fix, verify, log as fixed |
| Document | Production env/mail/keys, restricted routes, scheduler, stale logs | `error-log.md` §C |
| Ask | Delete/keep a page, change meaning, choose between layouts, source an image | `error-log.md` §D + todo |
| Observe | Overlap runs, dormant feature tables, informational counts | `error-log.md` §E/§H |

When a fix could change the meaning of published copy, it is an Ask even if it looks
small. When a fix is purely structural and provably safe, it is a Fix now.

### 8.3 Standard scans (the self-check catalogue)

| Scan | Catches | How |
|---|---|---|
| Route/URL sweep | 404/410 leaks, soft 404, wrong location variants | Fetch every published form + every sitemap URL |
| Internal link walk | Broken/dangling hrefs, links to unpublished records | Crawl the rendered site; check each href resolves |
| Slug census | Duplicate slugs, missing slugs, slug drift | DB + data file |
| Meta census | Missing/duplicate/overlong metas | Metas table + rendered head |
| Orphan scan | Products without a category, rows with no parent | SQL left joins |
| Disk parity | Missing images, unreferenced uploads | DB paths vs files |
| Migration parity | Files vs `migrations` rows, missing tables | Compare both directions |
| Feature-flag parity | Enabled module with no table, disabled module with a reachable route | Config + schema + admin routes |
| Cache freshness | Edits not visible | Compare DB value with rendered page after `optimize:clear` |
| Content audits | Rule breaches | §7.2 |
| Log scan | New exceptions, warnings | Tail `storage/logs` and compare timestamps |
| HTML sanity | Unbalanced tags, unescaped ampersands, broken entities | Parser/regex audit on rendered regions |
| Admin sanity | Resources for dead modules reachable by URL | Filament `canAccess` check |
| Asset sanity | Mixed content, 404 CSS/JS, CDN failures | Browser console/network |

### 8.4 Common failures and their fixes

- **Edits not visible** → cached block/meta or config cache. Bump the model version /
  `optimize:clear`.
- **Module table missing although the migration "ran"** → the flag was off at run time;
  the migration was recorded doing nothing. Add a new migration or rebuild.
- **Migration row without a file** → drift. Document; reconcile before deployment;
  never delete rows blindly.
- **Admin page 500 for a disabled module** → `shouldRegisterNavigation()` hides the menu
  but does not block the URL; add `canAccess()`.
- **Location-prefixed links stored in copy** → rewrite at render only; stored hrefs stay
  canonical. Add a link component if missing.
- **410 vs 404 confusion** → invalid historical shape = 410; valid shape, missing record
  = 404. Mixed behaviour produces soft 404s.
- **Category images NULL while products have images** → check the template use (OG image
  vs card); record as a decision, not a defect, if no source image exists.
- **`APP_URL` local but sitemaps canonical** → set `APP_URL` at deployment; regenerate
  sitemaps after a domain change.
- **Empty keywords table** → keyword landing URLs are dormant; do not enable the URL
  form until rows exist.
- **JSON columns returning strings** → add the `array` cast; clear caches.
- **Slug collisions** → deterministic de-duplication at import; never publish duplicates.
- **Encoding damage** → UTF-8 end to end; beware PowerShell redirection and Excel.
- **`env()` in runtime code** → move to config; cached config ignores `.env` at runtime.
- **Stale `storage/logs`** → rotate/delete at deployment; use `daily`.

### 8.5 Blocked-work protocol

When something cannot be done:

1. State the exact attempt and the evidence (URLs fetched, statuses, response snippets).
2. List what was ruled out.
3. Offer the options with consequences.
4. Record it as a Decision item; keep working on everything else.
5. Never fake a result to close the item.

### 8.6 Do-not list

- Do not rewrite images or uploads during a copy change.
- Do not delete a page or a record to make an audit pass.
- Do not add a page to the sitemap that is `noindex`.
- Do not silence errors by changing `APP_DEBUG` locally.
- Do not hard-code credentials, domains or keywords in code.
- Do not use a competitor's or client's unverified claim.
- Do not leave debug routes, temp files or test data in the project.

---

## 9. Change tracking and logs

### 9.1 The four files

| File | Purpose | Written |
|---|---|---|
| `rules.txt` | Numbered content, meta and implementation standard, project-specific | Before the work |
| `activity-log.md` | What was done, in order, with evidence | During the work |
| `error-log.md` | Defects, checks, production items, decisions, observations | When found |
| `todo.md` | Phases and open questions | During the work |

### 9.2 Activity log

- One section per step: `## Step N — {outcome} (date)`.
- Content order: the rule written first → what the audit found (numbers) → the work →
  the verification evidence → scope note → cleanup note.
- Quote the page and the sentence when answering a user's doubt.
- Never overwrite an earlier step; append above the "Earlier phases" summary.

Template in §11.5.

### 9.3 Error log

Sections, in this order:

- **A. Defects found and fixed** — per step table: `# | Defect | Evidence | Fix | Status`.
- **B. Errors checked for and not found** — per step table: check, method, result.
- **C. Production configuration items** — `# | Item | Current value | Action | Status`.
- **D. Pending your decision** — `# | Item | Question` with continuous numbering.
- **E. Informational** — overlap counts and similar, explicitly not breaches.
- **F. Earlier phases** — summary pointer.
- **G/H. Audit records** — long evidence that must not be lost (e.g. untargeted-element
  audit, structural audit).

Rules: a defect is logged when found, not when fixed; a decision is never closed
without the user's answer; numbers are continuous across C and D.

### 9.4 Todo

- Sections per phase (`A`, `B`, …), each with checkboxes.
- Every checkbox is a verifiable action, not a topic.
- An "Open questions" section mirrors `error-log.md` §D.
- Stale items are corrected when the facts change (state the correction, e.g.
  "checked: products now have images").

### 9.5 rules.txt

- Append-only numbered sections; never renumber; never delete a rule.
- Write the section **before** the work it governs.
- Each rule states scope, the requirement, the exceptions and the audit.
- Cite the rule numbers in logs and code comments.
- Keep project-specific values (keywords, brand, counts) here, not in scripts.

### 9.6 Session cadence

At the start of a session: read `todo.md` open questions and `error-log.md` §D; check
whether any answer arrived. At the end: close the log section, delete temp files, clear
the cache, state the next action.

---

## 10. Delivery checklist

### 10.1 Content gate

- [ ] Every record passes §6.12.
- [ ] Full audit §7.2: 0 identical lines, 0 ≥ 0.50 pairs, 0 first-line collisions,
      0 five-word runs, all counts at profile, all links present.
- [ ] Data file ↔ DB: 0 mismatches.
- [ ] Rendered pages: all regions pass on every record.
- [ ] Blogs (if in scope) pass the same uniqueness and structure rules.

### 10.2 Technical gate

- [ ] Fresh install migrates and seeds cleanly.
- [ ] Every published URL 200; intended dead URLs 410; no soft 404.
- [ ] Internal link walk clean.
- [ ] Metas: one per URL; lengths; no duplicates.
- [ ] Sitemaps regenerated; count matches; robots points at the canonical one.
- [ ] Images: every path exists; mirror parity where required.
- [ ] Admin: disabled modules blocked; forms match columns; cache invalidates on write.

### 10.3 SEO gate

- [ ] Titles keyword-first, unique, ≤ ~60.
- [ ] Descriptions unique, keyword + brand, ≤ ~120.
- [ ] Canonicals correct; location variants canonicalise to the intended URL.
- [ ] `noindex` only where intended.
- [ ] Headings follow §6.7; H1 present once per page.
- [ ] Parent/child links present in both directions; sitemap page complete.

### 10.4 Hygiene gate

- [ ] `APP_ENV=production`, `APP_DEBUG=false` at deployment.
- [ ] `/optimize` and `/sitemap/{version}` restricted.
- [ ] No temp files; no debug output; no credentials in the repo.
- [ ] `storage/logs` clean/rotated; log channel `daily`.
- [ ] Cache cleared; caches warmed as configured.
- [ ] `.env.example` documents every custom key without secrets.

### 10.5 Handover pack

- `rules.txt` (this project's standard)
- `activity-log.md` (all steps, evidence)
- `error-log.md` (§C production actions, §D open decisions)
- `todo.md` (open questions)
- this playbook (for the next project)
- deployment notes: commands, env keys, sitemap/robots steps, redirect map

---

## 11. Templates

### 11.1 Intake sheet

```text
PROJECT:            ______________________
DOMAIN(S):          ______________________
LEGAL BRAND:        ______________________
CONTACT:            e-mail / phone / address / WhatsApp
KEYWORDS:           sheet attached?  [ ] yes  [ ] no
DATA SOURCE:        [ ] xlsx  [ ] CSV  [ ] JSON  [ ] DB  [ ] scrape  [ ] none
CONTENT SOURCE:     [ ] client copy  [ ] existing site  [ ] write original
LOCATIONS:          ______________________
MODULES:            [ ] category  [ ] sub-category  [ ] product  [ ] service
BLOCKS:             [ ] features  [ ] why choose us  [ ] applications  [ ] FAQ
                    [ ] blog  [ ] policies  [ ] other: ______________________
MEDIA:              logo / favicon / banners / product images / blog images
PAGES:              home / about / contact / explore / blogs / sitemap / policies
LANGUAGES:          ______________________
DEADLINE:           ______________________
NOTES:              ______________________
```

### 11.2 Keyword sheet

```csv
entity_key,entity_type,primary,secondary_set,long_tail_set,roles_or_terms,banned
glass-pool,product,glass swimming pools,"top rated; best; manufacturers; suppliers; traders; exporters","glass pool structure; transparent pool wall; ...","manufacturers; suppliers; traders; exporters","cheap; No.1"
```

### 11.3 Data map

```text
SOURCE COLUMN      -> TARGET COLUMN      RULE
Title              -> title              verbatim
Category           -> parent_title       resolve to categories.title
(derived)          -> slug               lowercase, hyphenated, unique
Keyword            -> keywords row       from keyword sheet
Description        -> (not imported)     rewritten per §6
Image path         -> image              relative to public/uploads, never rewritten
```

### 11.4 Rule section template

```text
N. TITLE (rework of {date})
---------------------------
N.1 Scope: which records, which fields, which pages.
N.2 Requirement: the exact rule, with the default values.
N.3 Exceptions: what is deliberately not covered.
N.4 Preservation: what must not change (words, images, links, metas).
N.5 Audit: how compliance is measured and what must return the same result.
N.6 Interaction: which earlier rules still stand.
```

### 11.5 Activity log step template

```markdown
## Step N — {outcome} ({date})

Rule N (N.1 to N.x) was written into `rules.txt` before any of the work below.

**What the audit found.** {numbers, per record type, with the offenders named}

**The work.** {what changed, where, how many, with the safety checks}

**Verification.** {each audit, each count, each rendered-page sweep, the DB parity,
the URL sweep, the cache clear}

**Scope.** {what was deliberately not touched}

**Clean-up.** {temp files deleted, logs closed, cache cleared}
```

### 11.6 Error log rows

```markdown
| # | Defect | Evidence | Fix | Status |
|---|--------|----------|-----|--------|
| 1 | {what was wrong} | {URL/line/count} | {what was done} | Fixed |

| # | Item | Current value | Action | Status |
|---|------|---------------|--------|--------|
| 1 | {production item} | {current} | {action} | Open |

| # | Item | Question |
|---|------|----------|
| 1 | {decision} | {options, default, consequence} |
```

### 11.7 Audit script skeleton

```php
<?php
// Disposable audit. Delete after the step.
$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=' . getenv('DB_DATABASE') . ';charset=utf8mb4',
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// 1. Load records from the source the site renders (DB or data file).
// 2. Strip tags, mask the brand, split into lines.
// 3. Count identical lines, Jaccard >= 0.50 pairs, first-line collisions, 5-word runs.
// 4. Count keywords, names, highlights, links and tags per record.
// 5. Print PASS/FAIL per audit and the offenders.
```

### 11.8 URL sweep list

```text
/                        (home)
/about                   (static pages actually published)
/contact
/policies
/privacy-policy
/terms-and-conditions
/disclaimer
/explore
/blogs
/sitemap
/blog/{slug}             (each)
/category/{slug}         (each)
/product/{slug}          (each)
/{location}/...          (each allowed location variant)
→ expect 200; invalid historical shapes expect 410; report anything else
```

---

# PART D — REFERENCE IMPLEMENTATION (this repository, 19 Oct 2026)

## 12. What the audit found here

### 12.1 Stack and inventory

- **Stack:** PHP ^8.3, Laravel ^13.17, Filament ^5.0, intervention/image-laravel ^4.1,
  Pest 4 / Pint / Pail in dev. README still says Laravel 12 — documentation lag.
- **Tables (20):** 12 content/support (`categories` 3, `products` 39, `blogs` 5,
  `pages` 5, `components` 5, `banners` 2, `metas` 56, `faqs` 42 rows / 210 pairs,
  `keywords` 0, `users` 1, `locations` 2,121, `location_closures` 4,822), 8 framework
  tables.
- **Locations:** 114 countries (1 selected), 1,313 states (36), 694 districts (434);
  no cities/villages imported.
- **Images:** 39/39 products carry `products/{uuid}.webp` and every file exists;
  3/3 categories have `image = NULL`; 5/5 blogs have local images and every file
  exists. `public/uploads` also holds about, applications, banner and branding files.
- **Metas:** one row each for 3 categories, 39 products, 5 blogs and 9 static slugs;
  no rows for `index`, `blogs`, `explore`.
- **Migrations:** 15 rows against 14 files. Drift: a `create_blogs_table` row
  (`2026_09_19_073252`) has no file; `banners` has no create migration but its guarded
  `add_video` migration creates the table on a fresh install. `sub_categories` and
  `services` migrations are feature-gated and recorded while the flags were false, so
  their tables are absent by design.
- **Module flags:** category/product on; sub-category/service off — matching the
  missing tables. The four flagged resources read the flag in `canAccess()` and let
  `shouldRegisterNavigation()` delegate to it, so an off module answers 403 on direct
  URL (fix of H1, Step 22).
- **Admin panel (17 resources):** full CRUD for categories, products, blogs, banners,
  FAQs and metas; flagged resources for sub-categories and services; four singleton
  page resources (`about-us`, privacy policy, terms and conditions, disclaimer); four
  singleton component resources (why-choose-us, applications, industries-we-serve,
  stats); the profile settings resource (out of the navigation). Brand logo, favicon
  and name read from the profile row; the user menu offers Profile, Clear Cache
  (`/optimize`) and Generate Sitemap (`/sitemap/2`); the dashboard shows the
  `StatsOverview` widget.
- **Forms:** the enquiry modal and the contact page post to `POST /send-query`
  (validation + reCAPTCHA v3 verification + mailable to `mail.mail`, recipient from the
  profile row) and answer with flash toasts (`alerts-v2`).
- **Commands and operational routes:** `sitemap:v1`, `sitemap:v2`, `production:deploy`,
  `safe:migrate`; `/optimize` and `/sitemap/{version}` run behind `auth`.
- **URL flow:** the `routes/static.php` catch-all (registered after the fixed routes,
  GET-only, up to 4 segments) → `PageController` → `CleanUrlService` → `CleanUrlDTO` →
  `ContentService` → `BlockResolverService` → `ModalService` → model → Blade; `web.php`
  holds the fixed endpoints (`/optimize`, `/sitemap/{version}`, `POST /send-query` and
  the `/contact` aliases). 410 for invalid shapes, 404 for missing records, location
  prefixes only for the allowed page types.
- **Cache:** versioned `ModalService`; `optimize:clear` after data changes.
- **Assets:** mirrored uploads, `completion.css` loaded after `responsive.css`,
  sitemaps under `public/seo`.

### 12.2 Confirmed good

- 47 content records, 42 catalogue descriptions, 210 FAQ pairs, 56 metas, 5 local blog
  images, 39 product images, 0 orphan products, 0 missing image files.
- Content audits (Steps 14–18): 0 identical lines, 0 pairs ≥ 0.50, 128 shared six-word
  runs (all explained: required e-mail/brand and shared keyword frames), 0 failures on
  the rendered-page sweeps.
- All published URLs returned 200 at the last recorded sweep (the intended dead forms
  returned 410), and the sitemaps were regenerated on the production domain.

### 12.3 Findings to carry into the logs

- **H1 — fixed 19 Oct 2026 (Step 22).** Disabled admin modules were hidden from
  navigation but reachable by direct URL (their tables do not exist). All four flagged
  resources now gate `canAccess()`; navigation delegates to it, so the two can never
  disagree.
- **H2.** Migration drift (row without a file) — harmless today, reconcile before
  deployment.
- **H3.** Category images are NULL and no category image files exist; decide whether to
  source them.
- **H4.** `keywords` is empty, so keyword landing URLs stay dormant.
- **H5.** Metas for `index`, `blogs`, `explore` are missing (launch blocker).
- **H6.** `APP_URL` is `http://localhost:8000` locally while sitemaps carry the
  production domain — set `APP_URL` at deployment and regenerate sitemaps.
- **H7.** Tests are framework stubs only; add a smoke test for the resolver and the
  catalogue pages.
- **H8.** Direct Eloquent writes — Filament saves, seeders, SQL — do not bump the
  versioned caches (`ModalService` bumps only its own `create/update/delete`). An admin
  edit can stay invisible until the TTL (7 days) or a manual cache clear. Recommended:
  an observer that bumps the model version on save/delete (decision D24).
- **H9.** `DatabaseLocations/locations.sql` and `location_closures.sql` — the bulk
  source `safe:migrate` imports — are absent from the project, so a fresh install
  cannot rebuild the location tables (decision D25).
- **H10.** Housekeeping leftovers: an unused `Sample` model and an unused
  `ClientComponentsMeta` component + view; the `StatsOverview` widget carried imports
  of models that do not exist (imports cleaned in Step 22).

### 12.4 Open decisions (mirror of `error-log.md` §D)

The project already carries items 10–21 (policies page, short FAQ stems, keyword set,
category features block, six-word separation, duplicated e-mail, highlight range,
blog images, footer columns, added category sentences, title-form counts, local vs
live). This audit added D22 (migration drift: document / reconcile / rebuild) and D23
(seed the keywords table or keep keyword URLs off) and adds D24 (bump the caches
automatically on direct writes). Step 22 added D25 (where the bulk location SQL source
lives). Nothing in §D is closed without the user's answer.

## 13. Lessons that became rules here

1. **A highlight wrap must add no word.** Prove it by comparing stripped text before and
   after; re-run uniqueness like-for-like (§7.6).
2. **A link insertion must not disturb keywords or highlights.** Add one sentence where
   the count needs it; never rewrite an existing sentence (§17.7).
3. **Location prefixes belong at render, not in storage.** One link component rewrites
   canonical hrefs; copy stays portable (§17.2).
4. **Feature-flagged migrations only apply on a fresh install.** Enabling a module later
   needs a new migration; document the flag state in the audit.
5. **A missing live asset cannot be mirrored.** Record the evidence (URLs, statuses)
   and ask; never invent an image (§16.6).
6. **Disable the menu is not disable the route.** Gate access as well as navigation.
7. **Stale log lines mislead.** Re-verify current values (images, `APP_URL`) when
   reading older entries; correct the entry with a dated note.
8. **Windows output encoding is a real defect source.** Write UTF-8 from PHP; read
   PowerShell redirection as Unicode.
9. **Caches hide content edits.** Bump the version / clear the cache before declaring a
   content change verified.
10. **The live domain can lag the local build.** When a user reports missing content,
    verify which build they are viewing before changing anything.

---

## Appendix A — Glossary

- **Record**: one category, product, blog, page or component row.
- **Parent/child**: a category/product relationship (or service/sub-service).
- **Canonical href**: the stored, location-free URL (`/category/{slug}`).
- **Location prefix**: the render-time rewrite to `/{location}/category/{slug}`.
- **Line**: the unit of the uniqueness audit (§7.1).
- **Profile**: the numeric content parameters in §6.1 for a project.
- **Data file**: the committed content source consumed by the seeder/renderer.
- **Render**: writing structured copy from the data file into the DB fields.
- **Sweep**: fetching every published URL and checking status + content regions.

## Appendix B — Quick command sheet

```powershell
# Laravel
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan migrate:fresh --seed        # disposable DB only
php artisan sitemap:v1
php artisan sitemap:v2
php artisan production:deploy         # first deploy only; rotates APP_KEY
php artisan safe:migrate              # guarded location import + migrate

# Signed-in admin actions: /optimize (clear + rebuild caches), /sitemap/{version}

# Local server
php artisan serve

# Database schema dump (PDO; delete the script afterwards)
php _schema_audit.php > _schema_audit.txt

# Tests
php artisan test
```

```text
Pre-flight:  .env values -> migrations parity -> DB integrity -> URL sweep
Post-change: render -> DB parity -> audits -> rendered pages -> cache clear -> logs
```

## Appendix C — Content record shape (data file)

```php
[
    'title' => 'Example Product',
    'slug' => 'example-product',
    'parent' => 'Example Category',
    'keyword' => 'example product',
    'sub_name' => 'Three to Seven Word Tagline',
    'description' => [/* 4 paragraphs */],
    'features' => [
        'intro' => '...',
        'points' => [['heading' => '...', 'text' => '...'], /* five */],
        'closing' => '...',
    ],
    'why_choose_us' => [
        'intro' => '...',
        'points' => [/* five */],
        'closing' => '...',
    ],
    'contact' => '...',
    'faqs' => [['question' => '...', 'answer' => '...'], /* five */],
    'meta' => ['title' => '...', 'description' => '...', 'keywords' => '...'],
]
```

---

# PART E — DYNAMIC LOGIC

## 14. How the dynamic things work

### 14.1 What "dynamic" means in this structure

No page is hard-coded. Five drivers decide what a URL renders:

| Driver | Source | Read by |
|---|---|---|
| Records | the database (categories, sub-categories, products, services, blogs, pages, components) | `BlockResolverService` through `ModalService` |
| Blocks | `config/page_content.php` (per page) and `config/commons.php` (shared) | `ContentService`, `CommonService` |
| URL meaning | request segments + slug group + locations + keywords | `CleanUrlService` -> `CleanUrlDTO` |
| Meta | the `metas` row for the page slug + the current location/keyword | `MetaService` + `MetaFormatterService` |
| Freshness | per-model version stamps held in the cache store | `ModalService`, `BlockResolverService`, `MetaService` |

Adding a capability normally means adding a row, a config entry or a view file — not a
route, a controller, or a query inside a template.

### 14.2 Dynamic URLs — from segments to a DTO

- The catch-all route hands the whole path to `PageController::resolve()`.
  `parseSegments()` reads at most **four** segments: `location`, `page`, `slug`,
  `keyword`. Five or more segments is a 410.
- **Static page discovery**: `CommonService::pages($path)` scans the configured
  static-pages folder (`app.static_pages_path`, `views/client/pages`) for Blade file
  names and caches the list under `pages:{hash}`. Dropping `foo.blade.php` into the
  folder makes `/foo` a page — no route, no config entry.
- **Home**: an empty path resolves to `DEFAULT_PAGE` (`index`).
- **Ambiguity**: when the first segment is itself a static page name, the resolver
  treats it as the page and shifts the remaining segments. Keep page names and location
  slugs apart; a collision is resolved in favour of the static page.
- **Slug resolution**: `modals_group_structure.slug_group` is walked **in order**
  (category, product, blog, ...). For each model, `ModalService::hasColumn('slug')`
  picks `slug` or `slug_url`; the first record found wins and the DTO records the model
  class and row id. Keep slugs globally unique across the group — the order decides ties.
- **Location validation**: the slug must exist with `is_selected = 1` and
  `is_active = 1`, and a non-empty ancestor chain must exist. The DTO records the slug,
  its id and the parent slugs (used by headings and metas).
- **Location + SEO gate**: a location URL is valid only for a record flagged for SEO.
  When a location is in the URL and the resolved slug record does not carry `seo = 1`
  - or its record type has no SEO flag at all (a blog) - the route is invalid and the
  controller answers 410. The gate is enforced in the resolver for every slug entity
  and kept at the top of the record templates as well; static pages with a location
  stay governed by `LOCATION_ALLOWED_PAGES`.
- **Product SEO whitelist (Akum, 21 Oct 2026)**: `seo = 1` only when the product name is
  on the supplied whitelist and contains no location in any form. All other products,
  including the 7 menu records, are `seo = 0`. The current split is 26 `seo = 1` and
  24 `seo = 0`. Location-named products remain accessible on `/product/{slug}` but
  answer 410 on `/{location}/product/{slug}` and stay out of the sitemap.
- **Keyword validation**: the keyword must exist in the polymorphic `keywords` row for
  the resolved entity (`entity_type` = model class, `entity_id` = row id).
- **Result**: an immutable `CleanUrlDTO` carrying `valid_route`. An invalid shape throws
  `GoneException` -> 410; a valid shape with no record -> 404; a location prefix on a
  page type outside `LOCATION_ALLOWED_PAGES` -> 410.
- The resolution is itself cached under `clean-url:{sha256(params)}` for
  `clean_url_ttl` (default 7 days).
- **Server rule for links**: copy stores canonical hrefs (`/category/{slug}`,
  `/product/{slug}`, `/blog/{slug}`); the shared link component rewrites them to
  `/{location}/...` at render time, and only for records flagged `seo = 1`. Never store
  a location prefix in the database.

### 14.3 Dynamic content blocks — config to data

A block in `config/page_content.php` is an array:

```php
'blogs' => [
    'modal'     => 'Blog',                 // model name under App\Models
    'modal_dir' => '',                     // optional model sub-directory
    'condition' => ['status' => true, 'deleted_at' => null],
    'select'    => ['slug', 'title', 'image', 'description'],
    'order'     => ['id' => 'asc'],
    'search'    => ['column' => 'slug'],   // single-record mode when a slug is in the URL
    'first'     => true,                   // return one row instead of a list
    'tree'      => false,                  // build parent/child from parent_id
    'with'      => ['products', 'faqs'],   // relations, resolved by reflection
],
```

Mechanics that matter when adding one:

- **Conditions** understand `=`, `!=`, `>=`, `<=`, `>`, `<`, `in` (array), `between`
  and a nested `or` key. Column names come from trusted config only.
- **Relations** are resolved by reflection: methods returning a relation are
  eager-loaded; parameterless builder methods are post-loaded; methods named
  `locationXxx($value)` or `keywordXxx($value)` are **contextual** and run only when the
  URL carries that context. Contextual hydration walks the loaded relations recursively
  and is cycle-safe.
- **Single vs list**: `search.column` plus a slug in the URL = single record; otherwise
  a collection. `first` returns the first item or `[]`. `tree` groups rows by
  `parent_id` under a `children` key and requires `id` in `select` (it throws without it).
- **Output**: models are converted with `toArray()`; views read arrays, not models.
- **Cache key**: `block:v2:{sha256}` over the normalised config, the context
  (location/keyword only when contextual) and the version stamps of the model **and of
  every related model**. Arrays are normalised with `ksort` (list order preserved), so
  equivalent configs share one entry.
- **Shared blocks** live in `config/commons.php` (`menu`, `contact`, `seo`), may be flat
  or grouped, and accept per-call overrides: a list override replaces `select`; an array
  override is merged into the block config.

### 14.4 Dynamic metas — the row and the formatter

- One `metas` row per URL slug. `MetaService` asks `ModalService` for the row whose slug
  is the page name (or the record slug).
- `meta` may hold `tags` and `dynamic`, each a list of `{name, value}` (flat maps also
  work). When the URL carries a **keyword**, values in `dynamic` replace same-named
  `tags` values — this is how keyword landing pages get their own title and description.
- **Placeholders** replaced at render, compiled once with word boundaries:
  `{location}` and `{city}` -> the current location; `{full_location}` -> the ancestor
  chain joined; the configured default-location alias -> the current location;
  `$keyword` -> the keyword, title-cased.
- Descriptions use a modified map: inside a description the location placeholders expand
  to the **full chain**, while titles keep the current location.
- **Suffix rule**: ` in {location}` is appended to title and description only when the
  stored value does not already contain the current location or the full chain. This is
  why stored meta values must stay location-free.
- The formatted meta is cached under `meta:{md5(page, location, keyword, slug, version)}`.

### 14.5 Dynamic locations — the closure tree

- `locations` (country/state/district/city/village, `is_selected`, `is_active`) plus
  `location_closures` (`ancestor_id`, `descendant_id`, `depth`; depth 1 = direct child).
- Every query filters `is_selected` and `is_active`; anything else is invisible to the
  site even if the row exists.
- The repositories cache single lookups (with **negative caching** on the short
  `negative_ttl`), children slugs, parents, ancestors and the direct relations between a
  set of ids.
- `LocationsService` turns the requested slug into an id plus parent chain, lists roots
  (countries) or children for navigation, and builds the full tree for pickers and
  sitemaps.
- The sitemap commands flatten that tree into location prefixes.

### 14.6 Dynamic menus and shared blocks

- The menu is a common block: categories filtered by `status`, `deleted_at`, `explore`,
  with their products eager-loaded. The header and footer cap the list at three at
  render; the sidebar lists all.
- The contact block is the **first user row's** `additional_info` (brand name, logo,
  favicon, e-mail, phones, scripts). Editing that row changes the chrome everywhere.
- Both are cached block results: a change needs the cache cleared or a version bumped.

### 14.7 Dynamic cache — version stamps

- Reads through `ModalService` are keyed `model_{class}_v{version}`; the version lives in
  the cache store (for example `seo:v2:model_app_models_blog_version`).
- `BlockResolverService` and `MetaService` build their keys from the same stamps, so one
  bump invalidates every derived entry.
- **The version bumps only inside `ModalService::create/update/delete`.** A write through
  Eloquent directly — Filament forms, seeders, SQL, tinker — does **not** bump it. The
  site keeps serving the old value until the TTL expires (default 7 days) or the cache is
  cleared. Operating rule: after any direct write, clear the cache
  (`php artisan optimize:clear`, or the admin's Clear Cache). The durable fix is an
  observer/hook on the content models that bumps the version on save/delete.
- Keys normalise arrays (`ksort`; list order kept) and include related-model versions, so
  identical queries share one entry and a relation change invalidates the parent.

### 14.8 Dynamic keyword landing pages

- URL form `/{location}/{page}/{slug}/{keyword}`; `KeywordService` reads the polymorphic
  `keywords` row for the resolved entity.
- An empty `keywords` table silently disables the form (every keyword fails validation
  -> 410) and the sitemap emits no keyword URLs. Seeding rows turns it on with no code
  change; the meta `dynamic` values then take over.

### 14.9 Dynamic sitemaps

- Both commands read `modals_group_structure.slug_group`, the keywords model and the
  location tree; they probe column variants (`status`/`is_active`, `slug`/`slug_url`,
  `seo`/`is_seo`) so the same code runs on slightly different schemas.
- V1 writes grouped files (`public/seo/sitemap/{static,country,state,district}/sitemap*.xml`);
  V2 streams flat files (`public/seo/sitemap_v2/sitemap*.xml`) with a 45,000-URL cap per
  file.
- URLs are built as `/{location?}/{type?}/{slug}{/keyword?}` from the same stores the site
  uses, so a new entity in the slug group joins the sitemap automatically.
- Regenerate after any slug, status, location or domain change; robots points at the
  live one.

### 14.10 Dynamic pages from view files

- `CommonService::pages()` turns every Blade file in the static pages folder into a page
  name, cached. The controller then requires `page_content` only for pages that need
  data: a page with a block renders it; a dynamic page with no content is a 404.
- `app.default_page` decides the root; `app.static_pages_path` decides the folder.
  Both are config (env-backed), not code.

### 14.11 Dynamic pages — template discipline and page furniture

- **Logic at the top.** All PHP logic of a page template sits in the single `@php`
  block at the top of the file; below it the template prints prepared variables only.
  No query, service call or heavy condition lives in the markup.
- **Simple and optimized.** The top block unwraps the content, guards the route and
  prepares the titles, URLs and labels. Reusable work moves into a component or a
  service; nothing is queried that the content service already loaded.
- **The location-only static template.** Location-parameterised copy is written inline
  in the product detail view and renders only when a location is in the URL, right
  after the description and before the feature block. It has exactly two headings and
  four unique paragraphs; the products listing has no static block.
- **The location gate.** Location URL + record without `seo = 1` → 410, enforced in
  the resolver (§14.2) and kept as a guard at the top of the record templates.
- **Page furniture is mandatory.** The floating icons component (go-to-top, WhatsApp,
  call) with its contextual message template renders on every page from the shared
  layout; a template that bypasses the layout loses them and is a defect.

### 14.12 Dynamic forms and mail — the enquiry flow

- **Shape.** A form renders in a shared component (the enquiry modal here) or on a
  page; it posts to a fixed named route declared in the route file — never to the
  dynamic catch-all, which is GET-only.
- **Controller.** Validate (fields, formats, caps, token) → verify the anti-spam token
  against the provider API with the configured secret → resolve the recipient (settings
  row first, config fallback) → send the mailable → `back()->with('success')`; any
  failure answers `back()->with('error')`.
- **Client enrichment.** A form may read shared data to build dependent selects (the
  enquiry component builds category and product lists from the shared menu) and expose
  them to the page scripts as a global; no second query.
- **Flash rendering.** The shared alerts component renders session flashes and
  validation errors as toasts; every POST answer goes through it.
- **The anti-spam pair is config.** Site key and secret key come from config/`.env`;
  the layout loads the provider script only when the site key exists, and a missing
  secret in production fails verification — an explicit launch check (§17).

## 15. Recipes — adding dynamic things safely

### 15.1 A new page type

1. Add `resources/views/client/pages/{name}.blade.php` (discovery is automatic).
2. If it needs data, add `{name}` to `config/page_content.php` with its blocks.
3. Add the meta row (slug = `{name}`), keyword-first, location-free.
4. Link it from the footer/sitemap if it must be reached; add it to
   `LOCATION_ALLOWED_PAGES` only if location variants are wanted.
5. Write the content under the project's rules; run the audits; sweep the new URL
   (200; 410 for invalid shapes); clear the cache.

### 15.2 A new entity type in URL resolution

1. Migration + model (`SoftDeletes`, casts, `getRouteKeyName`, `status`/`seo` flags).
2. Add the model to `config/modals_group_structure.php` (`slug_group`, in the right
   order) and to `seo_group` if it will have keyword pages.
3. Add its blocks to `page_content.php` (list and detail) and its views; keep the
   heading and region contracts of §6.7.
4. Add an admin resource, gated by navigation **and** access.
5. Add metas per record; verify the sitemap output (the commands pick the model up from
   the slug group); run the link audit and the content audits.

### 15.3 A new block on an existing page

1. Add the block config (modal, condition, select, with/search as needed).
2. Use it in the view; check empty-data behaviour (`first` returns `[]`).
3. If it carries copy, the content rules apply (uniqueness, links, highlights).
4. Clear the cache; verify the rendered page and that the cache key includes the right
   model versions.

### 15.4 A new meta placeholder

1. Add it to the replacement maps in `MetaFormatterService` (base map, and the
   description map when it differs).
2. Keep the word-boundary compilation order (longest key first).
3. Test with and without a location/keyword; verify the suffix rule; document the
   placeholder in the project's rules.

### 15.5 Location-aware or keyword-aware content

1. Add a model method named `locationSomething($value)` / `keywordSomething($value)`
   returning a relation, builder or value.
2. The resolver hydrates it recursively (cycle-safe) only when the URL carries that
   context; the block cache key already includes the context.
3. Use it in the views; verify with and without the prefix; keep stored copy
   location-free.

### 15.6 Turning on a feature-flagged module

The original flagged migration has already run, so it will not create the table now:

1. Write a **new** migration that creates the table (guarded with `hasTable`).
2. Run it; flip the flag in config/`.env`.
3. Gate the admin resource by navigation and access; add page_content, views and metas.
4. Rebuild the caches; run the full verification; log the change.

### 15.7 Adding locations

1. Import the rows (SQL/seeder) and keep the source files with the project — they are
   what a fresh install runs (§4.10) — then build the closure rows
   (ancestor/descendant/depth).
2. Mark `is_selected` for the publishable set; keep everything else inserted but inactive.
3. Clear the location caches; verify the parent chain, the allowed pages and the meta
   suffix; regenerate the sitemaps if SEO landing pages apply.

### 15.8 A new form or enquiry type

1. Declare the POST route (named, web middleware, CSRF) in the route file — never on the
   catch-all.
2. Build the form (component or page); mirror the fields in validation; include the
   anti-spam token field and let the layout's script loader fill it.
3. Add the mailable and its view; resolve the recipient from the settings row with the
   config fallback.
4. Answer with `back()->with('success'/'error')`; verify the shared alerts component
   shows the flash.
5. Test the happy path, a validation failure, a bad token and the missing-mail-config
   case (read the log); clear the cache.

### 15.9 A new admin resource (content entity)

1. Generate the resource in the standing shape; point `$model` at the entity; declare
   the navigation group and label.
2. Form: mirror the columns and casts; slug read-only from the title; file fields per
   §4.11 (disk, entity directory, webp); JSON content through structured fields.
3. Table: the columns and filters the operators work with.
4. Feature-flagged module: `canAccess()` reads the flag and
   `shouldRegisterNavigation()` delegates to it.
5. The user model implements the panel access contract; anything finer gets a policy.
6. Rebuild the caches; verify the public page the resource feeds.

### 15.10 A singleton admin page (legal page or component section)

1. Decide the row: a page row (slug) or a component row (section slug).
2. Resource over that model, Edit-only: one page route at `/`; no List/Create pages.
3. `mount()` does `firstOrCreate(['slug' => …])` and fills the form — the operator never
   sees "new record".
4. Override heading and breadcrumb to name the page; trim header actions.
5. Link it into a navigation group; verify the public page renders the saved content
   after the cache clears.

### 15.11 A dashboard widget

1. One small widget with counts for the operators; defensive over empty or missing
   tables.
2. Register it on the panel (discovery or explicit); verify the dashboard renders.

### 15.12 A console command and an operational endpoint

1. Command: a signature, a description, idempotent work, clear output; schedule it if it
   must repeat.
2. Endpoint (when operators need a button): a route behind the admin authentication that
   runs the same command; no free-text input, any version/format bounded by config.
3. The user-menu item or page action points at the route.
4. Document the command in the project's rules; verify the run and the log.

## 16. Dynamic-logic pitfalls — check these first

- **Stale cache after a direct write** — the most common "the site ignores my edit".
  Bump or clear (§14.7).
- **Feature-flagged migration already recorded** — turning the flag on does not create
  the table; add a new migration (§15.6).
- **`tree` mode without `id`** — throws by design; add `id` to `select`.
- **Parameterised relation skipped** — a method with required arguments is not
  eager-loaded; only `location*`/`keyword*` names run contextually.
- **`first` returns `[]`** on an empty result — views must handle it.
- **Slug collisions across the group** — the first model in `slug_group` wins; keep
  slugs globally unique or reorder deliberately.
- **Location slugs that collide with page names** — the resolver prefers the static
  page; rename one of the two.
- **Meta stored with a location inside** — the formatter stops appending; store
  location-free and let the render add it.
- **Keyword URLs silently off** — the `keywords` table is empty; seed rows to enable.
- **`env()` at runtime** — ignored once config is cached; keep values in config.
- **Sitemap silently includes/excludes by flags** — verify counts after status changes;
  the tolerated column variants can also hide a typo.
- **Admin module resources** — hide the navigation *and* block the access;
  `shouldRegisterNavigation()` delegates to `canAccess()` (§4.9, §12.3 H1).
- **A form posting to the catch-all** — the dynamic route is GET-only; declare the POST
  route with the web middleware or the submission dies (405/419).
- **Mail or anti-spam keys missing in production** — the form validates and posts, then
  sending or verification fails; check both keys and the log before launch.
- **The go-live routine rotates `APP_KEY`** — sessions, cookies and encrypted values
  die with the old key; run it once at first deploy, not as a routine.
- **Operational endpoints left public** — `/optimize` and sitemap generation run real
  work; keep them behind the admin authentication.
- **A widget or command over a disabled table** — reads must survive the module being
  off (flag check or guard).
- **Contextual hydration cycles** — protected, but do not build recursive relations with
  side effects; keep the methods pure reads.

---

# PART F — THE LAST THING: THE WHOLE-PROJECT CHECK

## 17. Before you call it done

Run one final check over the whole project — not over the pages that were touched:

1. **Open every page** the site publishes: the home page, every static page, every
   category, product and blog detail, the sitemap page, and every location variant
   that is supposed to exist.
2. **Follow every internal link** on every page, including asset URLs and uploads,
   then fetch the sitemap, `robots.txt` and the admin entry.
3. **Fetch every URL once and record its status.** Every link must resolve — 200, or
   the intended 410 for the blocked URL forms (unknown location, disallowed
   location + page, location + record without `seo = 1`, a fifth segment, the retired
   forms of §5.10).
4. **Check the error channels:** no new entry in the application log, no 500 response,
   a clean browser console on the pages opened.
5. **Any failure found is fixed and the whole check re-runs from the start.** Only a
   full green result closes the delivery.

This is the gate the customer experiences. A page that renders is not enough; the
whole navigation must hold.

---

*End of playbook. Copy it into the next project, fill `rules.txt` with that project's
profile, and follow the order at the top.*
