@php
    $metaData = is_array($meta ?? null) ? $meta : [];
    $metaTags = isset($metaData['tags']) && is_array($metaData['tags'])
        ? $metaData['tags']
        : $metaData;
    $metaTitle = config('app.name');
    $metaDescription = '';
    $metaKeywords = '';
    $additionalMeta = [];
    $ogImage = $ogImage ?? null;
    $metaPage = request()->attributes->get('clean_url')->page ?? null;
    $keywordPages = ['product', 'blog', 'service'];

    foreach ($metaTags as $key => $value) {
        $name = is_array($value) ? ($value['name'] ?? null) : $key;
        $val = is_array($value) ? ($value['value'] ?? null) : $value;

        if (!is_string($name) || $name === '') {
            continue;
        }

        if ($name === 'title') {
            $metaTitle = $val;
        } elseif ($name === 'description') {
            $metaDescription = $val;
        } elseif ($name === 'keywords') {
            $metaKeywords = $val;
        } else {
            $additionalMeta[] = [$name, $val];
        }
    }
@endphp

@php
    if (!in_array($metaPage, $keywordPages, true)) {
        $metaKeywords = '';
    } elseif (str_contains($metaKeywords, '{location}') || str_contains($metaKeywords, '{city}')) {
        $keywordParts = array_filter(
            array_map('trim', explode(',', $metaKeywords)),
            fn ($keyword) => !str_contains($keyword, '{location}')
                && !str_contains($keyword, '{city}')
                && !str_contains($keyword, '{full_location}')
        );
        $metaKeywords = implode(', ', $keywordParts);
    }

    if (!empty($metaDescription)) {
        $currentLocationSlug = (string) (request()->attributes->get('clean_url')->location ?? '');
        $currentLocationName = $currentLocationSlug !== ''
            ? ucwords(str_replace('-', ' ', $currentLocationSlug))
            : '';

        if ($currentLocationName !== '') {
            $locationSuffix = ' in ' . $currentLocationName;
            $suffixedPeriod = '.' . $locationSuffix;

            if (str_ends_with($metaDescription, $suffixedPeriod)) {
                $metaDescription = substr($metaDescription, 0, -strlen($suffixedPeriod))
                    . $locationSuffix . '.';
            } elseif (str_ends_with($metaDescription, $locationSuffix)) {
                $metaDescription .= '.';
            }
        }

        if (mb_strlen($metaDescription) > 140) {
            if ($currentLocationName !== '') {
                $metaDescription = preg_replace(
                    '/\s+in\s+' . preg_quote($currentLocationName, '/') . '\.$/iu',
                    '.',
                    $metaDescription
                );
            }

            if (mb_strlen($metaDescription) > 140) {
                $metaDescription = rtrim(mb_substr($metaDescription, 0, 140));
                $metaDescription = preg_replace('/\s+\S*$/u', '', $metaDescription) . '.';
            }
        }

        $metaDescription = preg_replace('/\.\.+$/u', '.', $metaDescription);
    }
@endphp

{{-- Primary Meta --}}
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
@if (!empty($metaKeywords))
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif

{{-- Additional Dynamic Meta --}}
@foreach ($additionalMeta as [$name, $val])
    @if (str_starts_with($name, 'og:'))
        <meta property="{{ $name }}" content="{{ $val }}">
    @else
        <meta name="{{ $name }}" content="{{ $val }}">
    @endif
@endforeach

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ config('app.name') }}">

@if (!empty($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">

@if (!empty($ogImage))
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif

<link rel="canonical" href="{{ url()->current() }}" />
@foreach ($meta['schemas'] ?? $meta['schema'] ?? [] as $schema)
    <script type="application/ld+json">
        {!! $schema['value'] !!}
    </script>
@endforeach

<meta name="robots"
    content="{{ request()->is('explore') || request()->is('*/explore') ? 'noindex, nofollow' : 'index, follow' }}">
