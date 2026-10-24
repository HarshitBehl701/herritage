<?php

namespace App\Services\Keywords;

use App\DTO\CleanUrlDTO;
use App\Services\Database\ModalService;

class KeywordService
{
    private array $keywords = [];
    private array $keywordMap = [];

    public function __construct(
        private readonly CleanUrlDTO $cleanUrl
    ) {
        $modal = new ModalService(
            config('app.keyword_modal_name', 'Keywords'),
            config('app.keyword_modal_dir', '')
        );

        $record = $modal->whereSelect(
            [
                'entity_id' => $this->cleanUrl->slugId,
                'entity_type' => $this->cleanUrl->modal,
            ],
            ['keywords'],
            1
        )->first();

        $this->keywords = is_array(
            $record?->keywords
        )
            ? $record->keywords
            : [];

        $this->keywordMap =
            array_fill_keys(
                $this->keywords,
                true
            );
    }

    public function getKeywords(): array
    {
        return $this->keywords;
    }

    public function validateKeyword(
        string $keyword
    ): bool {
        return isset(
            $this->keywordMap[$keyword]
        );
    }
}