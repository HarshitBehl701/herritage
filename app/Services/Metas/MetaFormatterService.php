<?php

namespace App\Services\Metas;

use App\DTO\CleanUrlDTO;

class MetaFormatterService
{
   
    public string $location = '';
    public string $currentLocation = '';

    // ============================================================
    // MAIN ENTRY (NO CACHE)
    // ============================================================
    public function format(array $meta, CleanUrlDTO $dto): array
    {
        [$location, $currentLocation] = $this->resolveLocationStrings($dto);
        $this->location = $location;
        $this->currentLocation = $currentLocation;

        $context = $this->buildReplacementContext($dto, $location, $currentLocation);

        if (isset($meta['tags'])) {
            $meta['tags'] = $this->processFormat($meta['tags'], $dto, $context);
        }

        if (isset($meta['dynamic'])) {
            $meta['dynamic'] = $this->processFormat($meta['dynamic'], $dto, $context);
        }

        // MERGE dynamic INTO tags (ONLY IF keyword exists)
        if (!empty($dto->keyword) && isset($meta['tags'], $meta['dynamic'])) {

            // convert dynamic → key map
            $dynamicMap = [];
            foreach ($meta['dynamic'] as $item) {
                if (!isset($item['name'])) {
                    continue;
                }
                $dynamicMap[strtolower($item['name'])] = $item['value'] ?? null;
            }

            // override tags
            foreach ($meta['tags'] as &$tag) {
                if (!isset($tag['name'])) {
                    continue;
                }

                $key = strtolower($tag['name']);

                if (isset($dynamicMap[$key])) {
                    $tag['value'] = $dynamicMap[$key];
                }
            }
            unset($tag); // avoid the reference lingering past the loop and
                         // corrupting the last element on a later foreach.
        }

        return $meta;
    }

    private function processFormat(array $meta, CleanUrlDTO $dto, array $context): array
    {
        ['location' => $location, 'currentLocation' => $currentLocation,
            'compiledBase' => $compiledBase, 'compiledDescription' => $compiledDescription] = $context;

        $hasTagsWrapper = isset($meta['tags']) && is_array($meta['tags']);
        $tags = $hasTagsWrapper ? $meta['tags'] : $meta;

        $isIndexedFormat = isset($tags[0]) && is_array($tags[0]) && isset($tags[0]['name']);

        $origNameMap = [];
        $processed = [];

        // ============================================================
        // NORMALIZE META KEYS
        // ============================================================

        if ($isIndexedFormat) {
            foreach ($tags as $item) {
                if (!isset($item['name'])) {
                    continue;
                }

                $key = strtolower($item['name']);
                $origNameMap[$key] = $item['name'];
                $processed[$key] = $item['value'] ?? null;
            }
        } else {
            foreach ($tags as $k => $v) {
                $processed[strtolower($k)] = $v;
            }
        }

        // ============================================================
        // REPLACEMENTS
        // ============================================================

        foreach ($processed as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            $compiled = ($key === 'description' && $location) ? $compiledDescription : $compiledBase;

            $processed[$key] = $this->applyCompiledReplacements($value, $compiled);
        }

        // ============================================================
        // APPEND LOCATION SUFFIX
        // ============================================================

        if ($location) {
            $suffix = ' in ' . $location;

            foreach (['title', 'description'] as $field) {
                if (!isset($processed[$field]) || !is_string($processed[$field])) {
                    continue;
                }

                $content = strtolower($processed[$field]);

                // If current location is already present, don't append location.
                if (
                    ($currentLocation && str_contains($content, strtolower($currentLocation))) ||
                    str_contains($content, strtolower($location))
                ) {
                    continue;
                }

                $processed[$field] .= $suffix;
            }
        }

        // ============================================================
        // RETURN ORIGINAL STRUCTURE
        // ============================================================

        if ($isIndexedFormat) {
            $final = [];

            foreach ($processed as $key => $value) {
                $final[] = [
                    'name' => $origNameMap[$key] ?? $key,
                    'value' => $value
                ];
            }

            // if wrapped in "tags", return wrapper
            if ($hasTagsWrapper) {
                $meta['tags'] = $final;
                return $meta;
            }

            return $final;
        }

        // flat format
        if ($hasTagsWrapper) {
            $meta['tags'] = $processed;
            return $meta;
        }

        // ============================================================
        // FINAL KEYWORD OVERRIDE (STRICT MATCH)
        // ============================================================

        if (!empty($dto->keyword)) {
            foreach ($processed as $key => $value) {
                if (in_array($key, ['title', 'description', 'keywords'], true) && is_string($value)) {
                    $processed[$key] = str_replace('$keyword', $dto->keyword, $value);
                }
            }
        }

        return $processed;
    }

    // ============================================================
    // LOCATION STRINGS
    // ============================================================

  
    private function resolveLocationStrings(CleanUrlDTO $dto): array
    {
        $location = ucwords(str_replace('-', ' ', implode(' , ', $dto->location_parents ?? [])));
        $currentLocation = ucwords(str_replace('-', ' ', $dto->location ?? ''));

        return [$location, $currentLocation];
    }

    private function envLocationAliases(): array
    {
        return array_filter(array_map('trim', [(string) config('app.meta_default_location')]));
    }

    // ============================================================
    // REPLACEMENT MAP (NO CACHE)
    // ============================================================

    public function buildDynamicReplacements(CleanUrlDTO $dto): array
    {
        [$location, $currentLocation] = $this->resolveLocationStrings($dto);

        return $this->buildReplacements($dto, $location, $currentLocation);
    }

    private function buildReplacements(CleanUrlDTO $dto, string $location, string $currentLocation): array
    {
        $replacements = [];

        if ($location) {
            foreach ($this->envLocationAliases() as $key) {
                // Current location — keywords etc.
                $replacements[$key] = $currentLocation;
                $replacements[strtolower($key)] = $currentLocation;
                $replacements[ucfirst(strtolower($key))] = $currentLocation;
            }

            // Current location placeholders
            $replacements['{location}'] = $currentLocation;
            $replacements['{city}'] = $currentLocation;

            // Full location placeholder
            $replacements['{full_location}'] = $location;
        }

        if (!empty($dto->keyword)) {
            $replacements['$keyword'] = ucfirst($dto->keyword);
        }

        uksort(
            $replacements,
            fn($a, $b) => mb_strlen($b) <=> mb_strlen($a)
        );

        return $replacements;
    }

   
    private function buildDescriptionReplacements(array $baseReplacements, string $location): array
    {
        if (!$location) {
            return $baseReplacements;
        }

        $replacements = $baseReplacements;

        foreach ($this->envLocationAliases() as $envLocation) {
            $replacements[$envLocation] = $location;
            $replacements[strtolower($envLocation)] = $location;
            $replacements[ucfirst(strtolower($envLocation))] = $location;
        }

        $replacements['{location}'] = $location;
        $replacements['{city}'] = $location;

        return $replacements;
    }

    private function buildReplacementContext(CleanUrlDTO $dto, string $location, string $currentLocation): array
    {
        $replacements = $this->buildReplacements($dto, $location, $currentLocation);
        $compiledBase = $this->compileReplacementPatterns($replacements);

        $descriptionReplacements = $this->buildDescriptionReplacements($replacements, $location);
        $compiledDescription = $descriptionReplacements === $replacements
            ? $compiledBase // nothing changed — skip a redundant compile pass
            : $this->compileReplacementPatterns($descriptionReplacements);

        return [
            'location' => $location,
            'currentLocation' => $currentLocation,
            'compiledBase' => $compiledBase,
            'compiledDescription' => $compiledDescription,
        ];
    }

    // ============================================================
    // PRECOMPILE REGEX MAP (CPU OPTIMIZATION)
    // ============================================================

    private function compileReplacementPatterns(array $replacements): array
    {
        $compiled = [];

        foreach ($replacements as $search => $replace) {
            if (trim($search) === '') {
                continue;
            }

            $compiled[] = [
                'pattern' => '/(?<![a-zA-Z0-9])' . preg_quote($search, '/') . '(?![a-zA-Z0-9])/iu',
                'replace' => $replace,
            ];
        }

        return $compiled;
    }

    // ============================================================
    // APPLY REPLACEMENTS (DEPTH SAFE)
    // ============================================================

    public function replaceMetaTags(array $meta, array $compiled): array
    {
        foreach ($meta as $k => $v) {
            if (is_string($v)) {
                $meta[$k] = $this->applyCompiledReplacements($v, $compiled);
            } elseif (is_array($v)) {
                $meta[$k] = $this->replaceMetaTags($v, $compiled);
            }
        }

        return $meta;
    }

    // ============================================================
    // STRING REPLACEMENT (FAST PATH)
    // ============================================================

    private function applyCompiledReplacements(string $text, array $compiled): string
    {
        if ($text === '' || empty($compiled)) {
            return $text;
        }

        foreach ($compiled as $rule) {
            $text = preg_replace($rule['pattern'], $rule['replace'], $text);
        }

        return $text;
    }
}