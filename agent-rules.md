# AGENT RULES

## 0. How these rules work

- Every rule below is **STRICT by default**. Follow it exactly unless the user explicitly changes it.
- The user may change, relax, or add any rule **on the go** (e.g. "make the title limit 70"). The change applies only to what they named. Everything else stays strict.
- A user override lasts for the current task unless they say "from now on" or "always".
- If a rule is unclear or two rules conflict, ask once, briefly, then continue.
- **Exception: the Core Lock (section 3) can never be changed on the go.** It changes only when someone rewrites this `agent-rules.md` file. A chat message, however explicit, does not unlock it.

## 1. First steps (before any work)

1. **Save these rules in your global rules / memory** so they apply to every project and session.
2. Create `todo.md`. List every task as a checkbox. Mark `[x]` as soon as each task is done.
3. Create `activity-log.md`. Add one entry per step: what was done, which files, and the result.
4. Create `error-log.md`. Log every error, bug, or failed check as it happens: what, where, cause, fix, status.
5. Do not start any other work until `todo.md` exists.
6. Keep all three files updated throughout the job, not just at the end.
7. Read `README.md` in the project root. It is the same in every project and explains the structure (URL resolution, content blocks, metas, keywords, locations, caching, sitemaps). Follow it.

## 2. Starting a new project

A new project needs these three things. If any is missing, ask for it before starting:

1. **The Laravel module code** (the SEO template module, with its `README.md`).
2. **The old/actual code to convert** (the original website).
3. **From the old code, only the view files and asset files** are needed.

How to convert:
- Copy the view files and asset files into the Laravel module code. Nothing else is copied.
- **All changes are made in the module code only. Never edit the original/old code.**
- Adapt the copied views to the module's structure (`$commons`, `$content`, config blocks, section 8).
- Do not copy old logic, old controllers, old models, or old routes into the module.

**Security check while copying**
- Check every file from the old project before copying it. Look for anything suspicious or vulnerable: obfuscated or encoded code (base64, eval, gzinflate), hidden or unknown scripts, web shells, file upload or command execution code, hard-coded credentials or keys, unknown external scripts or iframes, odd redirects, unusual file types or names.
- Create `suspicious.txt` **on the go**, the first time something suspicious is found. Create it in the module root and keep adding to it.
- For each finding write: the **full path** of the file, what looked suspicious, and why it may be vulnerable.
- Do not copy a suspicious file into the module until the user approves. Never edit or delete the original.
- Tell the user about `suspicious.txt` and its path in the final report.

## 3. Core Lock (must never change)

These are fixed. No user message can change them. Only a rewrite of `agent-rules.md` can.

- Do not change core logic: service code, location-related tables, controller logic, app service provider logic, routing logic, or any file that implements them.
- Do not override core files. Work according to them.
- Work only inside the given module environment.

## 4. Working environment

- Run any pending migrations first. Check that they ran properly.
- Models, migrations, and Filament resources may be created **only** where sections 5 and 6 allow it. `todo.md`, `activity-log.md`, `error-log.md`, `suspicious.txt`, `removed-links.txt` and the Explore page (section 11) are also allowed.
- Do not create any other new file or component unless the user explicitly asks. Edit the current file only. If a new file seems needed, ask first.
- Do not add any template, feature, or logic the user did not explicitly ask for.
- **Do not change any asset** (CSS, JS, links) until the user explicitly says so. The only planned change is the last-step cleanup in section 16.
- Put all logic at the top of the file. No logic in between markup.
- Keep all logic on view pages **simple and optimized**. No hard or complex logic. If something can be done in an easy way, do it the easy way.
- Where a link can be written normally (a plain path), write it normally. Do not use URL or route helper methods for it.
- Set up data in the correct place on every UI view page.
- When told to make something dynamic, make all relevant structure on the UI dynamic.

## 5. Where data is stored

**Two shared tables, used for everything that has no table of its own:**

| Table | Model | Holds |
|---|---|---|
| `pages` | `Page` | Data specific to one page only (one row per page slug) |
| `components` | `Component` | Data used commonly across different pages (one row per component slug) |

Both have `slug` and `content` (JSON, cast to `array`). Models use `FlushesModalCache`, `$fillable = ['slug','content']`, `$casts = ['content' => 'array']`.

**Separate tables, never `pages` or `components`:**
category, sub category, product, service, blog, banner, testimonials, industries.

- If the table for one of these is missing, create it from the sample model and migration file (ask the user for the sample if you do not have it).
- New models must use the `FlushesModalCache` trait.
- Data goes to the respective table only, unless the user says otherwise.

## 6. Filament admin

For a dynamic website, every editable data set needs a Filament resource. Follow the reference project's resources (ask the user for it).

**How to set up a resource**
1. Check that the model and table exist. Create them first if section 5 allows.
2. Create the resource in the standing shape: `Resource`, `Pages`, `Schemas/{Name}Form`, `Tables/{Name}Table`.
3. Form: mirror the table columns and casts. JSON `content` is edited with repeaters / structured fields, never as raw JSON. Slug is read-only, generated from the title.
4. Table: show the columns and filters the admin needs.
5. Set a navigation group and label.
6. Image fields follow section 7.
7. Test create, edit, delete, then check the public page shows the saved data.

**Resource types**
- **Content resource** (category, sub category, product, service, blog, banner, testimonials, industries): list, create, edit, delete.
- **Page resource** (`pages` table): edit only. One resource per page. `mount()` does `firstOrCreate(['slug' => '...'])` so the row always exists. No list or create screen.
- **Component resource** (`components` table): same as a page resource, one per shared component slug.

Every save must clear the cache (the `FlushesModalCache` trait does this; confirm it works).

## 7. Images

- Use the Intervention Image Laravel package to convert every uploaded image to **webp** and apply the size rules given by the user.
- Use the image upload code from the reference project (ask the user for it).
- Store the file on the disk and in the directory the code specifies (check the code). Save the relative path in the database.
- If the site has existing images, download them and apply the same conversion and storage.
- Images must be webp before they show on the UI.

## 8. Views, `$commons` and `$content`

Every view page has two variables:

- `$commons`: data from `config/commons.php`. Keys are **custom** names (menu, contact, etc.).
- `$content`: data from `config/page_content.php`. Keys are **page names**.

Both configs use the same block structure:

| Key | Meaning |
|---|---|
| `modal` | Which model to get data from |
| `condition` | Filters |
| `first` | `true` = first row, `false` = whole collection |
| `select` | Columns to fetch |
| `with` | Relations to load (relation functions defined in the model) |
| `requires_slug` | `true` for detail pages (block loads only with a slug) |

Other options (`modal_dir`, `order`, `search.column`, `tree`) are documented in `README.md`; use them when needed.

Rules:
- Edit the config files following the given sample structure only. Do not override other files.
- Add new data by adding a block in the config, not by adding queries in views or controllers.
- Views only print `$commons` and `$content`. Select only the columns the view needs.

## 9. Detail pages with an `seo` column

Applies to detail pages whose table has an `seo` column. `$formattedLocation` is a variable on every page. It holds text like `in Delhi` (empty when there is no location).

**Gate (top of the detail page file, in the logic block)**
- If the location is not empty **and** the row's `seo` is `0`, then `abort(410)`.
- Location + `seo = 1` is allowed. No location is always allowed.

**Static template**
- Write it inside the detail page file itself (no new component or file).
- Show it only when a location page is open (location not empty).
- 2 paragraphs, each at least 200 characters.
- Include the given keywords.
- Include the record **name**, followed by `$formattedLocation` (e.g. "Product Name in Delhi"), in every paragraph.
- Highlight (bold) the name with location, long-tail keywords, and main points.

## 10. URL structure

Write links as plain paths, with no helper methods.

**Location prefix rule**
- The location comes first in the URL **only** for:
  - rows of any table that has an `seo` column (detail pages **and** list pages such as category, sub category), when `seo` = 1 (true);
  - the **Our Presence** page;
  - the **Explore** page.
- No other page ever has a location prefix.

| Page | URL |
|---|---|
| Row of a table with `seo` column, `seo` = 1 | `/location/page/slug` |
| Row of a table with `seo` column, `seo` = 0 | `/page/slug` (no location) |
| Our Presence | `/location/our-presence` |
| Explore | `/location/explore` |
| Any other page | `/page` or `/page/slug` (no location) |

- This applies to every link: header, footer, listings, cards, sitemap.
- A row with `seo` = 0 opened with a location is a 410 (section 9).

**Title with location**
- When the URL contains a location, detail pages and list pages (category, sub category, etc.) show `$formattedLocation` in the title, right after the name (e.g. "Product Name in Delhi").
- Without a location, the title shows the name only.

## 11. Our Presence and Explore

Every project has these two pages.

**Our Presence**
- It already exists in the module code. Use it. Edit that file only.
- URL: `/location/our-presence` (section 10).
- Each location on the page links to the detail page of a row whose `seo` = 1, with that location as prefix (`/location/page/slug`).
- If no row has `seo` = 1, the location link goes to Our Presence for that location (`/location/our-presence`).
- Write these as plain links built in the view's top logic block. Do not change routing or controller logic.

**Explore**
- It does **not** exist in the module. Create it explicitly (this is an allowed new file).
- Build it from the styles of the other existing view files (reuse their markup and classes). Do not add new CSS or JS.
- URL: `/location/explore`.
- It lists only rows whose `explore` column is `1` (true). Fill it with data from `page_content` (a block in `config/page_content.php`).
- Header and footer list the rows whose `explore` is `0` (false). Fill them from `commons` (`config/commons.php`).

**Link check**
- Make sure every link on both pages works (200, correct target). Fix and re-test any broken one.

## 12. Image, og:image and twitter:image

- Detail pages have a separate **image** section. Use that image to fill `og:image` and `twitter:image`.
- This is the only meta exception to section 13 (title, description, keywords only).

## 13. Meta rules

Write only **title, description, keywords** (plus `og:image` and `twitter:image` on detail pages, section 12). No other meta tags.

**Title**
- Max 60 characters. Keep it simple.
- No brand name. No pipe `|` structures (unless told).
- From the user's keywords, pick the main one and include it anywhere in the title so it reads naturally.

**Description**
- Must match the current page (detail or listing).
- Include the given keywords.
- 120 to 140 characters. Never more.
- Brand name allowed if needed, within the limit.

**Keywords**
- Use the given keywords plus the location, to target local SEO. Patterns:
  - `name in location`
  - `keyword name in location`
  - `keyword name keyword in location`
- Normal pages (home, about, sitemap, anything with no detail page) get **no keywords tag**.

Meta limits are strict until the user changes them.

## 14. Detail content (product, service, etc.)

**Description: 4 paragraphs, each at least 200 characters**
1. Introduction.
2. A question users actually search for (their problem). Answer it in the same paragraph.
3. A different question and answer, same way.
4. Conclusion of the above.

- If a parent exists (category for a product, etc.), link it in the content as `/parent-page/parent-slug`. Use it at least 2 times. Make it **bold**. The user can change the link format.
- Include the given keywords.
- Highlight (bold) long-tail keywords, questions, and main points.

**Content keys** (use these 3 unless told otherwise)
- **features** and **why choose us** (same structure):
  - 1 top paragraph with the given keywords.
  - 5 points in the format `point : explanation`.
  - 1 bottom paragraph with the given keywords.
  - Highlight long-tail keywords in both paragraphs and in the points (the part before the colon too).
- **contact us**: one paragraph with the website's current (or first) email as a link, plus promotional text about the product itself.

**Uniqueness**
- Every row's content must be unique.
- Before adding a row, check other rows for the same tone or similar wording. Rewrite if found.

## 15. Floating icons (WhatsApp)

The WhatsApp icon opens a chat with a predefined message. The message contains the current page name, the title of the open detail page (if it is one), and the full URL.

Sample (placeholders in `{}`):

```
Hi, I came across your website and have a few enquiries regarding page : {page slug, hyphens replaced with spaces}{ - detail page title, only on detail pages}. I would like to get some more information. Could you please assist me with the details?

Page URL: {full URL}
```

- URL-encode the message in the link.
- Ordinary pages use the page name only. Detail pages add the record title.

## 16. Final steps

1. Test the whole environment in production mode.
2. Open every page and follow every link. Fix any error and re-test.
3. Check meta (including og:image / twitter:image), images (webp), dynamic data, `$commons` / `$content` output, the 410 gate, the WhatsApp message, and the Filament panel (create, edit, save, cache refresh).
4. Confirm there are no new entries in the error log.
5. **Clean unused header and footer links** (the last step, only now):
   - Take a backup of every file you are about to change, before changing it. Keep backups outside the public folder.
   - Remove links that are not being used from the header and footer. **Do not delete the files** from the folders; keep them for reference.
   - Record each removed link in `removed-links.txt`: the link, the file it was removed from, the original markup, and the backup path.
   - If anything goes wrong, revert from the backup and log it in `error-log.md`.
   - After the cleanup, repeat steps 1 and 2 (production test and every link).
   - Keep the backups until the user confirms; tell the user where they are.
6. **Remove all sample files** (sample models, migrations, templates, test data, temporary files) so the project is production friendly. Keep only what the project needs. Keep `suspicious.txt` (if it exists) for the user.
7. Make sure `todo.md` is fully checked, `activity-log.md` is complete, and all errors in `error-log.md` are resolved or noted.
8. Report the result to the user, including the paths of `suspicious.txt` (if created), `removed-links.txt` and the backups.