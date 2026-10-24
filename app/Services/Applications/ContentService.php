<?php

namespace App\Services\Applications;

use App\Services\Database\BlockResolverService;

class ContentService
{
    private array $structure;

    public function __construct(
        public string $page,
        public ?string $matchValue = null,
        public ?string $location = null,
        public ?string $locationId = null,
        public ?string $keyword = null,
        private readonly BlockResolverService $blocks,
    ) {
        $this->structure = config('page_content', []);
    }

    public function get(): array
    {
        if (
            !is_array($this->structure) ||
            empty($this->structure) ||
            !isset($this->structure[$this->page])
        ) {
            return [];
        }

        $blocks = $this->structure[$this->page];

        if (
            !empty($blocks['requires_slug']) &&
            empty($this->matchValue)
        ) {
            return [];
        }

        $context = [
            'matchValue' => $this->matchValue,
            'location' => $this->location,
            'locationId' => $this->locationId,
            'keyword' => $this->keyword,
        ];

        if (isset($blocks['modal'])) {
            return [
                $this->page => $this->blocks->resolve(
                    $blocks,
                    $context,
                    contextual: true
                ),
            ];
        }

        $result = [];

        foreach ($blocks as $key => $config) {
            if (
                !is_array($config) ||
                empty($config['modal'])
            ) {
                continue;
            }

            $result[$key] = $this->blocks->resolve(
                $config,
                $context,
                contextual: true
            );
        }

        return $result;
    }
}