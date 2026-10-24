{{-- Between Header & Body Scripts --}}
@php
    $betweenScripts = $commons['contact']['additional_info']['between_header_body_scripts'] ?? '';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $ogImage = trim($__env->yieldContent('image'));
    @endphp
    <x-meta-component :og-image="$ogImage" />
    <x-head-links />
    @vite(['resources/css/app.css'])
    @stack('head_links')
</head>

{!! $betweenScripts !!}

<body>
    <x-header-component />
    <x-sidebar-component />
    @include('components.alerts-v2')
    @yield('content')
    <x-footer-component />
    <x-enquiry-component />
    <x-floating-icons-component :detail-title="trim($__env->yieldContent('whatsapp_detail'))" />
    @if (filled(config('app.recaptcha_site_key')))
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha_site_key') }}" defer></script>
        <script>
            window.addEventListener('load', () => {
                if (!window.grecaptcha) {
                    return;
                }

                grecaptcha.ready(() => {
                    grecaptcha.execute(@json(config('app.recaptcha_site_key')), {
                        action: 'submit'
                    }).then((token) => {
                        ['recaptcha_response', 'recaptcha_response2', 'recaptcha_response3', 'recaptcha_response4'].forEach((id) => {
                            const field = document.getElementById(id);
                            if (field) {
                                field.value = token;
                            }
                        });
                    });
                });
            });
        </script>
    @endif

    <x-body-scripts />
    @vite(['resources/js/app.js'])
    @stack('body_scripts')
</body>

</html>