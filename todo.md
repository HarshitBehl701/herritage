# TODO — Herritage Moulds dynamic build

- [x] Read rules, README, old site and Excel reference
- [x] Create working logs (activity, error, suspicious)
- [x] Copy old views/assets into the module (views + assets only)
- [x] Build category and product reference Excel files (separate files in `docs/data`)
- [x] Add data files, seeders and import categories/products/blogs/pages
- [x] Configure page_content, commons and modals for dynamic pages
- [x] Build header, footer, sidebar, floating icons and layout components
- [x] Build dynamic home, products, category, product, blogs, blog, sitemap pages
- [x] Make about, contact, faqs, privacy content dynamic from pages table
- [x] Wire explore and our-presence pages
- [x] Verify Filament resources (category, product, blog, page, meta, components, keywords)
- [x] Build assets (npm), clear caches, run the URL/link sweep
- [x] Update activity-log, error-log and final report

## Final verification

- 93 public URLs checked with expected 200/410 status, 0 failures.
- 221 location-prefixed category/product detail URLs checked, 0 failures.
- 130 bare-location and static-location URLs checked, all correctly returned 410.
- 64 unique internal links checked across the rendered pages, 0 failures.
- 247 location meta URLs checked: titles <=60, descriptions 120-140, 0 issues.
- Combined content audit across 5 categories, 12 products and 4 blogs: 0 identical lines, 0 Jaccard >=0.50 pairs, 0 first-line collisions, 0 internal five-word repeats.
- Detail pages return 410 when a location is present and `seo = 0`; plain URLs remain 200.
- Our Presence links each of the 13 selected states to a `seo = 1` category detail page.
- `php artisan view:cache` succeeds.
- `npm run build` succeeds; only the existing Font Awesome runtime font-resolution warnings remain.
- All raster images referenced by the views are WebP, including the favicon.
- `/admin` returns 302 and `/admin/login` returns 200.
