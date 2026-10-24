<?php

namespace App\Services\Metas;

use App\DTO\CleanUrlDTO;
use App\Services\Database\ModalService;
use Illuminate\Support\Facades\Cache;

class MetaService
{
    private MetaFormatterService $formatter;
    private ModalService $modal;

    public function __construct(
        private string $page,
        private CleanUrlDTO $cleanUrl,
        ?MetaFormatterService $formatter = null,
    ) {
        $this->formatter = $formatter ?? new MetaFormatterService();

        // Create ModalService once (not on every call)
        $this->modal = new ModalService(
            config('app.meta_modal_name', 'Meta'),
            config('app.meta_modal_dir', 'MetaRepository')
        );
    }

    /**
     * Main index (formatted meta, cache-safe through data-source layer)
     */
    public function index(): array
    {
        return Cache::remember(
            $this->getCacheKey(),
            (int) config('app.cache.meta_ttl', 604800),
            fn() => $this->loadAndFormat()
        );
    }

    private function getCacheKey(): string
    {

        return config('app.cache.prefix', 'seo:v2:') . 'meta:' . md5(json_encode([
            'page' => $this->page,
            'location' => $this->cleanUrl->location ?? '',
            'keyword' => $this->cleanUrl->keyword ?? '',
            'slug' => $this->cleanUrl->slug ?? '',
            'v' => $this->getModelVersion(),
        ], JSON_THROW_ON_ERROR));
    }

    private function getModelVersion(): int
    {
        return Cache::get($this->modal->getVersionKey(), 1);
    }

    /**
     * Load RAW meta + format it
     */
    private function loadAndFormat(): array
    {
        $data = $this->loadDynamicMeta();

        if (empty($data)) {
            return [];
        }

        return $this->formatter->format($data, $this->cleanUrl);
    }

    // =============================================================
    // DYNAMIC META (DB — OPTIMIZED)
    // =============================================================

    private function loadDynamicMeta(): array
    {

        $records = $this->modal->whereSelect(
            ['slug' => $this->page],
            ['meta'],
            1
        );

        if ($records->isEmpty()) {
            return [];
        }

        $meta = $records->first();
        return is_array($meta->meta ?? null) ? $meta->meta : [];
    }
}