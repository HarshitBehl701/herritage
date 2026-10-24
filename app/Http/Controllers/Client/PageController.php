<?php

namespace App\Http\Controllers\Client;

use App\Exceptions\GoneException;
use App\Http\Controllers\Controller;
use App\Services\Applications\ContentService;
use App\Services\Commons\CommonService;
use App\Services\Middlewares\CleanUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function resolve(
        Request $request,
        ?string $segments = null,
        CleanUrlService $cleanUrlService = null,
        CommonService $commonService = null,
    ): Response {
        try {
            $params = $this->parseSegments($segments);

            $cleanUrl = $this->resolveCleanUrl(
                $params,
                $cleanUrlService
            );

            if (!$cleanUrl->valid_route) {
                throw new GoneException('Invalid Route');
            }

            $this->validateLocationPage($cleanUrl);

            $request->attributes->set('clean_url', $cleanUrl);

            $content = $this->getContent($cleanUrl);

            if (
                $commonService?->isPageRequireDynamicContent($cleanUrl->page)
                && empty($content)
            ) {
                abort(404, 'Failed to fetch page content');
            }

            $commons = $commonService ?? app(CommonService::class);

            $formattedLocation = $this->formatLocation(
                $cleanUrl->location
            );

            $shared = [
                'cleanUrl' => $cleanUrl,
                'formattedLocation' => $formattedLocation,
                'location' => $cleanUrl->location,
                'locations' => $cleanUrl->location_parents,
                'commons' => $commons->commons(),
                'keyword' => $cleanUrl->keyword,
            ];

            View::share($shared);

            return response()->view(
                'client.pages.' . $cleanUrl->page,
                [
                    'content' => $content,
                ]
            );
        } catch (GoneException) {
            abort(410);
        }
    }

    private function parseSegments(?string $segments): array
    {
        if ($segments === null || $segments === '') {
            return [
                'location' => null,
                'page' => config('app.default_page'),
                'slug' => null,
                'keyword' => null,
            ];
        }

        $parts = explode('/', trim($segments, '/'));

        if (count($parts) > 4) {
            throw new GoneException('Too Many Arguments');
        }

        return [
            'location' => $parts[0] ?? null,
            'page' => $parts[1]
                ?? $parts[0]
                ?? config('app.default_page'),
            'slug' => $parts[2] ?? null,
            'keyword' => $parts[3] ?? null,
        ];
    }

    private function resolveCleanUrl(
        array $params,
        ?CleanUrlService $service = null,
    ) {
        $service ??= new CleanUrlService($params);

        return $service->resolve();
    }

    private function validateLocationPage($cleanUrl): void
    {
        if (
            $cleanUrl->slug !== null &&
            $cleanUrl->slug !== ''
        ) {
            return;
        }

        if (
            empty($cleanUrl->location) ||
            empty($cleanUrl->page)
        ) {
            return;
        }

        $allowedPages = config(
            'app.location_allowed_pages',
            ''
        );

        if ($allowedPages === '') {
            throw new GoneException(
                'Location Route Is Not Allowed For This Page'
            );
        }

        $allowedPages = array_map(
            'trim',
            explode(',', $allowedPages)
        );

        if (!in_array(
            $cleanUrl->page,
            $allowedPages,
            true
        )) {
            throw new GoneException(
                'Location Route Is Not Allowed For This Page'
            );
        }
    }

    private function getContent($cleanUrl): array
    {
        return app(ContentService::class, [
            'page' => $cleanUrl->page,
            'matchValue' => $cleanUrl->slug,
            'location' => $cleanUrl->location,
            'locationId' => $cleanUrl->locationID,
            'keyword' => $cleanUrl->keyword,
        ])->get();
    }

    private function formatLocation(
        ?string $location
    ): string {
        if (!$location) {
            return '';
        }

        return ' In ' . ucwords(
            str_replace('-', ' ', $location)
        );
    }
}