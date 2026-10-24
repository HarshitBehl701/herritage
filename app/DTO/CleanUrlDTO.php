<?php

namespace App\DTO;

readonly class CleanUrlDTO
{
    public function __construct(
        public ?string $page = null,
        public ?string $slug = null,
        public ?string $slugId = null,
        public ?string $modal = null,
        public ?string $location = null,
        public ?int $locationID = null,
        public array $location_parents = [],
        public array $keywords = [],
        public ?string $keyword = null,
        public bool $valid_route = false
    ) {
    }

    // Clone with updated page
    public function withPage(?string $page): self
    {
        return new self(
            page: $page,
            slug: $this->slug,
            slugId: $this->slugId,
            location: $this->location,
            modal: $this->modal,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }

    public function withSlug(?string $slug): self
    {
        return new self(
            page: $this->page,
            slug: $slug,
            slugId: $this->slugId,
            location: $this->location,
            modal: $this->modal,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }

    public function withLocation(?string $location): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            slugId: $this->slugId,
            location: $location,
            modal: $this->modal,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }

    public function withLocationID(?int $locationID): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            location: $this->location,
            modal: $this->modal,
            slugId: $this->slugId,
            locationID: $locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }

    public function isRouteValid(bool $validRoute): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            location: $this->location,
            modal: $this->modal,
            slugId: $this->slugId,
            locationID: $this->locationID,
            valid_route: $validRoute,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }

    public function withLocationParents(array $parents): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            location: $this->location,
            modal: $this->modal,
            slugId: $this->slugId,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }
    public function withKeywords(array $keywords): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            location: $this->location,
            modal: $this->modal,
            slugId: $this->slugId,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $keywords,
            keyword: $this->keyword
        );
    }
    public function withKeyword(string $keyword): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            location: $this->location,
            modal: $this->modal,
            slugId: $this->slugId,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $keyword
        );
    }
    public function withModal(string $modal): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            slugId: $this->slugId,
            location: $this->location,
            modal: $modal,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }
    public function withSlugId(int $slugId): self
    {
        return new self(
            page: $this->page,
            slug: $this->slug,
            slugId: $slugId,
            location: $this->location,
            modal: $this->modal,
            locationID: $this->locationID,
            valid_route: $this->valid_route,
            location_parents: $this->location_parents,
            keywords: $this->keywords,
            keyword: $this->keyword
        );
    }
}