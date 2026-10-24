@php
    $info = $commons['contact']['additional_info'] ?? [];

    // Dynamic favicon URL
    $favicon = $info['favicon'] ?? null;
    $faviconUrl = $favicon
        ? asset('uploads/' . $favicon)
        : asset('favicon.ico');

    // Header scripts
    $headerScripts = $info['header_scripts'] ?? '';
@endphp

{{-- Dynamic Favicon --}}
<link rel="icon" type="image/webp" href="{{ $faviconUrl }}">
<link rel="shortcut icon" type="image/webp" href="{{ $faviconUrl }}">

{{-- Header Scripts --}}
{!! $headerScripts !!}