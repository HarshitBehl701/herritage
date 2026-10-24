<?php

namespace App\Services\Locations;

use App\Enum\LocationType;

class LocationsService
{
    private LocationRepository $locationsRepo;
    private LocationClosureRepository $closuresRepo;
    private ?object $cachedCurrentLocation = null;
    private ?LocationType $locationType = null;

    public function __construct(private ?string $currentLocation = null)
    {
        if (!empty($currentLocation)) {
            $this->validate_location();
        }
    }

    private function initRepos(): void
    {
        $this->locationsRepo ??= new LocationRepository();
        $this->closuresRepo ??= new LocationClosureRepository();
    }

    // ----------------------------------------------------
    // GET Parent Locations
    // ----------------------------------------------------

    public function getParentLocations(): array
    {
        $current = $this->cachedCurrentLocation;
        if (!$current) {
            return [];
        }

        $this->initRepos();

        return $this->locationsRepo->getParentsSlugs($current->id, true);
    }

    // ----------------------------------------------------
    // VALIDATION
    // ----------------------------------------------------
    public function validate_location(): bool
    {
        if (empty($this->currentLocation)) {
            return false;
        }

        if ($this->cachedCurrentLocation !== null) {
            return true;
        }

        $this->initRepos();

        $location = $this->locationsRepo->getBySlug($this->currentLocation);

        if (is_null($location)) {
            return false;
        }

        $this->cachedCurrentLocation = $location;
        return true;
    }

    // ----------------------------------------------------
    // CURRENT LOCATION ID
    // ----------------------------------------------------
    public function getCurrentLocationId(): ?int
    {
        if (!$this->cachedCurrentLocation) {
            if (!$this->validate_location()) {
                return null;
            }
        }
        return $this->cachedCurrentLocation?->id;
    }

    // ----------------------------------------------------
    // DYNAMIC LOCATIONS
    // ----------------------------------------------------
    public function get_locations(): array
    {
        $this->initRepos();

        $this->locationType = empty($this->currentLocation) ? LocationType::ROOT : LocationType::SUB;
        return match ($this->locationType) {
            LocationType::ROOT => $this->getRootLocations(),
            LocationType::SUB => $this->getSubLocations(),
            default => $this->getRootLocations(),
        };
    }

    public function build_location_tree(): array
    {
        $this->initRepos();

        // 1️⃣ Get all selected + active locations
        $locations = $this->locationsRepo->getAllSelectedActive();

        if (empty($locations)) {
            return [];
        }

        // 2️⃣ Index nodes
        $nodes = [];
        foreach ($locations as $location) {
            $nodes[$location->id] = [
                'slug' => $location->slug,
                'type' => $location->type,
                'children' => []
            ];
        }

        // 3️⃣ Get direct relationships from closure repo
        $relations = $this->closuresRepo->getDirectRelations(
            array_keys($nodes)
        );

        $hasParent = [];

        foreach ($relations as $relation) {
            $parentId = $relation->ancestor_id;
            $childId = $relation->descendant_id;

            if (isset($nodes[$parentId], $nodes[$childId])) {
                $nodes[$parentId]['children'][$nodes[$childId]['slug']] = &$nodes[$childId];
                $hasParent[$childId] = true;
            }
        }

        // 4️⃣ Extract root nodes
        $tree = [];

        foreach ($nodes as $id => $node) {
            if (!isset($hasParent[$id])) {
                $tree[$node['slug']] = $node;
            }
        }

        return $tree;
    }

    private function getRootLocations(): array
    {
        $type = LocationType::COUNTRY->value;
        return $this->locationsRepo->getByType($type);
    }

    private function getSubLocations(): array
    {
        $current = $this->cachedCurrentLocation;
        if (!$current) {
            return [];
        }

        if (($current->type ?? null) === LocationType::VILLAGE->value) {
            return [];
        }

        return $this->locationsRepo->getChildrenSlugs($current->id);
    }
}