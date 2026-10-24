<?php

namespace App\View\Components;

use App\Services\Locations\LocationsService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class LocationComponent extends Component
{
    public $locations = [];
    public $menu = [];
    public $routePath;
    public ?string $page = null;
    public ?string $slug = null;
    public function __construct(Request $request)
    {
        // Get current path after domain
        $this->routePath = $request->path();
        $clean_url = $request->get('clean_url');
        $this->page = $clean_url->page;
        $this->slug = $clean_url->slug;
        // Fetch locations only
        $service = new LocationsService($clean_url->location);
        $this->locations = $service->build_location_tree();
    }

    public function render(): View|Closure|string
    {
        return view('components.location-component');
    }
}
