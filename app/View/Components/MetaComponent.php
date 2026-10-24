<?php

namespace App\View\Components;

use App\Services\Metas\MetaService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class MetaComponent extends Component
{
    public array $meta = [];

    public ?string $ogImage = null;

    public function __construct(Request $request, ?string $ogImage = null)
    {
        $this->ogImage = $ogImage;
        $clean_url = $request->get('clean_url');

        // ✅ Safety guard
        if (!$clean_url) {
            $this->meta = [];
            return;
        }

        // ✅ Correct slug resolution (bug fix)
        $pageSlug = $clean_url->slug ?? $clean_url->page ?? null;
        if (!$pageSlug) {
            $this->meta = [];
            return;
        }
        $this->meta = (new MetaService($pageSlug, $clean_url))->index();
    }

    public function render(): View|Closure|string
    {
        return view('components.meta-component');
    }
}