@php
    $info = $commons['contact']['additional_info'] ?? [];
    $bodyScripts = $info['body_scripts'] ?? '';
@endphp

{{-- Body Scripts as it is --}}
{!! $bodyScripts !!}