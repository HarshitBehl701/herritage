<?php

namespace App\Console\Commands;

use App\Services\Commons\CommonService;
use App\Services\Database\ModalService;
use App\Services\Locations\LocationsService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Exception;

class GenerateSitemapV2 extends Command
{
    protected $signature = 'sitemap:v2';
    protected $description = 'Generate Flat Sitemap (V2)';

    private int $max_number_of_url = 45000;

    public function handle(CommonService $commons)
    {
        $keywordModel = config('modals_group_structure.seo_group.keywords');
        $modals = config('modals_group_structure.slug_group');
        $typeToModel = [];
        $urls = [];
        $seoFlags = [];
        $hasSeoColumn = [];

        // -------- FETCH DATA --------
        foreach ($modals as $modalKey => $modal) {

            $columns = [
                ['is_active' => true, 'deleted_at' => null, 'field' => 'slug'],
                ['is_active' => true, 'field' => 'slug'],
                ['status' => true, 'deleted_at' => null, 'field' => 'slug'],
                ['status' => true, 'field' => 'slug'],
                ['is_active' => true, 'deleted_at' => null, 'field' => 'slug_url'],
                ['is_active' => true, 'field' => 'slug_url'],
                ['status' => true, 'deleted_at' => null, 'field' => 'slug_url'],
                ['status' => true, 'field' => 'slug_url'],
            ];

            $type = Str::of($modal)
                ->singular()
                ->kebab()
                ->lower()
                ->toString();

            $typeToModel[$type] = $modal;

            foreach ($columns as $config) {
                try {

                    $field = $config['field'];
                    unset($config['field']);

                    $service = new ModalService($modal);

                    try {
                        $data = $service->whereSelect($config, ['id', $field, 'is_seo']);
                        $hasSeoColumn[$modal] = true;
                    } catch (Exception $e2) {
                        try {
                            $data = $service->whereSelect($config, ['id', $field, 'seo']);
                            $hasSeoColumn[$modal] = true;
                        } catch (Exception $e3) {
                            $data = $service->whereSelect($config, ['id', $field]);
                            $hasSeoColumn[$modal] = false;
                        }
                    }

                    if ($data->count()) {

                        foreach ($data as $row) {
                            $slug = $row[$field];
                            $seoValue = $this->getSeoValue($row);

                            $urls[$type][] = [
                                'id' => $row->id,
                                'slug' => $slug,
                            ];

                            $seoFlags[$type][$slug] = $seoValue;
                        }

                        break;
                    }

                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        // -------- GLOBAL SEO CHECK --------
        $anySeoColumnExists = collect($hasSeoColumn)->contains(true);

        // -------- STATIC URLS --------
        $pages = $commons->pages(
            resource_path(config('app.static_pages_path', 'views/client/pages'))
        );

        $dynamicPages = array_keys($urls);
        $pages = array_diff($pages, $dynamicPages);

        $staticUrls = [];
        foreach ($pages as $page) {
            $staticUrls[] = url($page == 'index' ? '' : $page);
        }

        // -------- LOCATIONS --------
        $locations = (new LocationsService(null))->build_location_tree();
        $flatLocations = $this->flattenLocations($locations);

        // -------- XML STREAM --------
        $basePath = public_path("seo/sitemap_v2");
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $fileIndex = 1;
        $count = 0;

        $xml = new \XMLWriter();
        $xml->openURI("{$basePath}/sitemap{$fileIndex}.xml");
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // -------- ADD STATIC FIRST --------
        foreach ($staticUrls as $url) {
            $this->writeUrl($xml, $url, $count, $fileIndex, $basePath);
        }

        // -------- NORMAL URLS --------
        foreach ($urls as $type => $slugs) {

            if (in_array($type, ['blog', 'blogs'])) {
                continue;
            }

            $model = $typeToModel[$type] ?? null;

            foreach ($slugs as $slug) {

                $this->writeUrl($xml, url("{$type}/{$slug['slug']}"), $count, $fileIndex, $basePath);
            }
        }

        // -------- LOCATION URLS --------
        foreach ($urls as $type => $items) {

            if (in_array($type, ['blog', 'blogs'])) {
                continue;
            }

            $model = $typeToModel[$type] ?? null;

            // -------- GLOBAL FALLBACK --------
            if (!$anySeoColumnExists) {

                $keywordsByEntity = $this->loadKeywords(
                    $keywordModel,
                    $model,
                    array_column($items, 'id')
                );

                foreach ($flatLocations as $location) {
                    foreach ($items as $item) {

                        $slug = $item['slug'];
                        $id = $item['id'];

                        // MAIN URL
                        $this->writeUrl(
                            $xml,
                            url("{$location}/{$type}/{$slug}"),
                            $count,
                            $fileIndex,
                            $basePath
                        );

                        // KEYWORDS
                        $keywords = $keywordsByEntity[$id] ?? [];

                        foreach ($keywords as $keyword) {
                            $this->writeUrl(
                                $xml,
                                url("{$location}/{$type}/{$slug}/{$keyword}"),
                                $count,
                                $fileIndex,
                                $basePath
                            );
                        }
                    }
                }

                continue;
            }

            // -------- SEO MODE --------
            if (!($hasSeoColumn[$model] ?? false)) {
                continue;
            }

            $keywordsByEntity = $this->loadKeywords(
                $keywordModel,
                $model,
                array_column($items, 'id')
            );

            foreach ($items as $item) {

                $slug = $item['slug'];
                $id = $item['id'];

                $seoValue = $seoFlags[$type][$slug] ?? false;

                if (!$seoValue) {
                    continue;
                }

                foreach ($flatLocations as $location) {

                    // MAIN URL
                    $this->writeUrl(
                        $xml,
                        url("{$location}/{$type}/{$slug}"),
                        $count,
                        $fileIndex,
                        $basePath
                    );

                    // KEYWORDS
                    $keywords = $keywordsByEntity[$id] ?? [];

                    foreach ($keywords as $keyword) {
                        $this->writeUrl(
                            $xml,
                            url("{$location}/{$type}/{$slug}/{$keyword}"),
                            $count,
                            $fileIndex,
                            $basePath
                        );
                    }
                }
            }
        }

        $xml->endElement();
        $xml->endDocument();

        $index = new \XMLWriter();
        $index->openURI("{$basePath}/sitemap.xml");
        $index->startDocument('1.0', 'UTF-8');
        $index->startElement('sitemapindex');
        $index->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // total files generated
        $totalFiles = $fileIndex;

        for ($i = 1; $i <= $totalFiles; $i++) {

            $index->startElement('sitemap');

            $index->writeElement(
                'loc',
                url("seo/sitemap_v2/sitemap{$i}.xml")
            );

            $index->writeElement(
                'lastmod',
                now()->toAtomString()
            );

            $index->endElement();
        }

        $index->endElement();
        $index->endDocument();

        $this->info("Sitemap V2 Generated Successfully");
    }

    private function writeUrl($xml, $loc, &$count, &$fileIndex, $basePath)
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);
        $xml->writeElement('changefreq', 'weekly');
        $xml->writeElement('priority', '0.8');
        $xml->endElement();

        $count++;

        if ($count >= $this->max_number_of_url) {
            $xml->endElement();
            $xml->endDocument();

            $fileIndex++;
            $count = 0;

            $xml->openURI("{$basePath}/sitemap{$fileIndex}.xml");
            $xml->startDocument('1.0', 'UTF-8');
            $xml->startElement('urlset');
            $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        }
    }

    private function getSeoValue($row)
    {
        // convert model → array safely
        $data = $row instanceof \Illuminate\Database\Eloquent\Model
            ? $row->getAttributes()
            : (array) $row;

        if (array_key_exists('seo', $data)) {
            return (int) $data['seo'] === 1;
        }

        if (array_key_exists('is_seo', $data)) {
            return (int) $data['is_seo'] === 1;
        }

        return false;
    }

    private function flattenLocations($locations, &$result = [])
    {
        foreach ($locations as $location) {
            $result[] = $location['slug'];

            if (!empty($location['children'])) {
                $this->flattenLocations($location['children'], $result);
            }
        }

        return $result;
    }

    // -------- OPTIONAL KEYWORDS --------
    private function loadKeywords($keywordModel, $modelClass, array $entityIds): array
    {
        if (!$keywordModel || $entityIds === []) {
            return [];
        }

        if (!str_contains($keywordModel, '\\')) {
            $keywordModel = "App\\Models\\" . $keywordModel;
        }

        $modals = config('modals_group_structure.slug_group');
        $resolvedModel = array_search($modelClass, $modals, true);

        if (!$resolvedModel) {
            return [];
        }

        try {
            return $keywordModel::query()
                ->where('entity_type', $resolvedModel)
                ->whereIn('entity_id', array_values(array_unique($entityIds)))
                ->get(['entity_id', 'keywords'])
                ->mapWithKeys(fn ($keyword) => [
                    $keyword->entity_id => $keyword->keywords ?? [],
                ])
                ->all();
        } catch (\Exception $e) {
            return [];
        }
    }
}