@php
    $menuProducts = collect($commons['menu']['products'] ?? []);
    $menuCategories = collect($commons['menu']['categories'] ?? []);
    $info = $commons['contact']['additional_info'] ?? [];
    $contactEmail = $commons['contact']['email'] ?? '';
    $phone = $info['mobile_numbers'][0]['number'] ?? '';
    $logo = $info['logo'] ?? null;
    $logoUrl = $logo ? asset('uploads/' . $logo) : asset('assets/logo/logo.webp');
    $locationPrefix = !empty($location) ? '/' . $location : '';
    $categoryUrl = fn (array $category) => (!empty($category['seo']) ? $locationPrefix : '') . '/category/' . $category['slug'];
    $productUrl = fn (array $product) => (!empty($product['seo']) ? $locationPrefix : '') . '/product/' . $product['slug'];
    $socialLinks = collect($info['social_links'] ?? []);
@endphp

<!-- header start -->
<header class="site-header">

    <!-- topbar -->
    <div class="header-topbar d-none d-lg-block">
        <div class="container">
            <div class="header-topbar-inner">

                <div class="header-topbar-left">
                    @if (!empty($contactEmail))
                        <a href="mailto:{{ $contactEmail }}">
                            <i class="fa-solid fa-envelope"></i>
                            {{ $contactEmail }}
                        </a>
                    @endif

                    @if (!empty($phone))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">
                            <i class="fa-solid fa-phone"></i>
                            {{ $phone }}
                        </a>
                    @endif
                </div>

                @if ($socialLinks->isNotEmpty())
                    <div class="header-topbar-right">
                        <span class="social-label">Follow Us</span>

                        <div class="header-socials">
                            @foreach ($socialLinks as $social)
                                <a href="{{ $social['url'] ?? 'javascript:void(0)' }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="{{ $social['name'] ?? 'Social' }}">
                                    <i class="fa-brands fa-{{ $social['icon'] ?? 'link' }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand site-logo" href="/">
                <img src="{{ $logoUrl }}" alt="{{ config('app.name') }}">
            </a>

            <button class="navbar-toggler d-lg-none shadow-none"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNavbar"
                    aria-controls="mobileNavbar"
                    aria-label="open navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- desktop navigation -->
            <div class="collapse navbar-collapse d-none d-lg-flex">
                <ul class="navbar-nav main-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about-us">About Us</a>
                    </li>

                    <!-- products -->
                    <li class="nav-item dropdown products-dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="/products"
                           role="button"
                           aria-expanded="false">
                            Products
                        </a>

                        <ul class="dropdown-menu product-submenu">
                            @foreach ($menuCategories as $category)
                                @php
                                    $categoryProducts = $menuProducts->where('category_id', $category['id']);
                                @endphp

                                <li class="has-submenu">
                                    <a class="dropdown-item submenu-link" href="{{ $categoryUrl($category) }}">
                                        <span>{{ $category['title'] }}</span>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>

                                    @if ($categoryProducts->isNotEmpty())
                                        <ul class="dropdown-menu nested-submenu">
                                            @foreach ($categoryProducts as $product)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $productUrl($product) }}">
                                                        {{ $product['title'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/sitemap">Sitemap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blogs">Blogs</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/contact-us">Contact Us</a>
                    </li>

                </ul>

                <div class="header-actions">
                    <a href="/contact-us">
                        Get In Touch
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </nav>

</header>
<!-- header end -->
