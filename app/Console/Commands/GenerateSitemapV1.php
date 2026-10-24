<?php

namespace App\Console\Commands;

use App\Services\Commons\CommonService;
use App\Services\Database\ModalService;
use App\Services\Locations\LocationsService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateSitemapV1 extends Command
{
    protected $signature = 'sitemap:v1';
    protected $description = 'Generate SEO sitemaps';

    public function handle(CommonService $commons)
    {
        $modals = config('modals_group_structure.slug_group');
        $keyword = config('modals_group_structure.seo_group.keywords');
        $keywordModal = new ModalService($keyword);
        $urls = [];
        $keywords = [];

        // -------- FETCH DYNAMIC URLS --------
        foreach ($modals as $modalKey => $modal) {
            $data = collect();

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

            foreach ($columns as $config) {
                try {
                    $field = $config['field'];
                    unset($config['field']);

                    $data = (new ModalService($modal))
                        ->whereSelect($config, ['id', $field]);

                    if ($data->count()) {
                        $key = Str::of($modal)
                            ->singular()
                            ->kebab()
                            ->lower()
                            ->toString();

                        $slugs = $data->pluck($field)->toArray();
                        $slugsWithIds = $data->toArray();
                        $urls[$key] = $slugs;

                        $keywordDataByEntity = $keywordModal
                            ->query()
                            ->where('entity_type', $modalKey)
                            ->whereIn(
                                'entity_id',
                                $data->pluck('id')->all()
                            )
                            ->select(['entity_id', 'keywords'])
                            ->get()
                            ->keyBy('entity_id');

                        foreach ($slugsWithIds as $slug) {
                            $keywordData = $keywordDataByEntity->get($slug['id']);

                            if ($keywordData) {
                                $keywords[$key][$slug['slug']] = $keywordData->keywords;
                            }
                        }

                        break;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }



        // -------- STATIC PAGES --------
        $pages = $commons->pages(
            resource_path(config('app.static_pages_path', 'views/client/pages'))
        );
        $dynamicPages = array_keys($urls);
        $pages = array_diff($pages, $dynamicPages);
        // -------- LOCATIONS --------
        $locations = $this->getLocation();

        // -------- BUILD LOCATION URLS --------
        $groupedUrls = $this->buildLocationUrls($locations, $urls);

        // -------- GENERATE LOCATION SITEMAPS --------
        foreach ($groupedUrls as $type => $urlsList) {
            $this->writeChunkedSitemaps($type, $urlsList);
        }

        // -------- KEYWORD SITEMAPS --------
        $keywordUrls = $this->buildKeywordUrls($locations, $urls, $keywords);

        foreach ($keywordUrls as $type => $urlsList) {
            $this->writeChunkedSitemaps("keywords/{$type}", $urlsList);
        }

        // -------- STATIC SITEMAP --------
        $staticUrls = [];

        foreach ($pages as $page) {
            $staticUrls[] = $page == 'index' ? url('') : url($page);
        }

        foreach ($urls as $type => $slugs) {
            foreach ($slugs as $slug) {
                $staticUrls[] = url("{$type}/{$slug}");
            }
        }

        $this->writeChunkedSitemaps('static', $staticUrls);

        // -------- MASTER SITEMAP --------
        $allTypes = array_keys($groupedUrls);
        $allTypes[] = 'static';

        $this->generateMasterSitemap($allTypes);

        $this->info("Sitemap Generated Successfully");
    }

    private function getLocation()
    {
        return (new LocationsService(null))->build_location_tree();
    }

    private function flattenLocationsByType($locations, &$result = [])
    {
        foreach ($locations as $location) {

            $type = $location['type'];
            $slug = $location['slug'];

            $result[$type][] = $slug;

            if (!empty($location['children'])) {
                $this->flattenLocationsByType($location['children'], $result);
            }
        }

        return $result;
    }

    private function buildLocationUrls($locations, $urls)
    {
        $grouped = $this->flattenLocationsByType($locations);
        $result = [];

        foreach ($grouped as $type => $locationSlugs) {

            foreach ($locationSlugs as $location) {

                // dynamic
                foreach ($urls as $contentType => $slugs) {

                    if (preg_match('/blog/i', $contentType))
                        continue;

                    foreach ($slugs as $slug) {
                        $result[$type][] = url("{$location}/{$contentType}/{$slug}");
                    }
                }
            }
        }

        return $result;
    }

    private function writeChunkedSitemaps($type, $urls)
    {
        $baseUrl = config('app.url');
        $basePath = public_path("seo/sitemap/{$type}");

        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $chunks = array_chunk($urls, 45000);
        $files = [];

        foreach ($chunks as $index => $chunk) {

            $xml = new \SimpleXMLElement('<urlset/>');
            $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

            foreach ($chunk as $loc) {
                $url = $xml->addChild('url');
                $url->addChild('loc', $loc);
                $url->addChild('changefreq', 'weekly');
                $url->addChild('priority', '0.8');
            }

            $fileName = "sitemap_" . ($index + 1) . ".xml";
            $xml->asXML("{$basePath}/{$fileName}");

            $files[] = $fileName;
        }

        $this->generateGroupIndex($type, $files);
    }

    private function generateGroupIndex($type, $files)
    {
        $baseUrl = config('app.url');
        $path = public_path("seo/sitemap/{$type}");

        $index = new \SimpleXMLElement('<sitemapindex/>');
        $index->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($files as $file) {
            $sitemap = $index->addChild('sitemap');
            $sitemap->addChild('loc', "{$baseUrl}/seo/sitemap/{$type}/{$file}");
            $sitemap->addChild('lastmod', now()->toAtomString());
        }

        $index->asXML("{$path}/sitemap.xml");
    }

    private function generateMasterSitemap($types)
    {
        $baseUrl = config('app.url');
        $path = public_path('seo/sitemap');

        $index = new \SimpleXMLElement('<sitemapindex/>');
        $index->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($types as $type) {
            $sitemap = $index->addChild('sitemap');
            $sitemap->addChild('loc', "{$baseUrl}/seo/sitemap/{$type}/sitemap.xml");
            $sitemap->addChild('lastmod', now()->toAtomString());
        }

        $index->asXML("{$path}/sitemap.xml");
    }

    private function buildKeywordUrls($locations, $urls, $keywords)
    {
        $grouped = $this->flattenLocationsByType($locations);
        $result = [];

        foreach ($grouped as $type => $locationSlugs) {

            foreach ($locationSlugs as $location) {

                foreach ($keywords as $contentType => $slugKeywords) {

                    if (preg_match('/blog/i', $contentType))
                        continue;

                    foreach ($slugKeywords as $slug => $keywordList) {

                        foreach ($keywordList as $keyword) {

                            $result[$type][] = url("{$location}/{$contentType}/{$slug}/" . Str::slug($keyword));
                        }
                    }
                }
            }
        }

        return $result;
    }
}