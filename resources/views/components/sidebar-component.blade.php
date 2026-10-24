@php
    $menuProducts = collect($commons['menu']['products'] ?? []);
    $menuCategories = collect($commons['menu']['categories'] ?? []);
    $info = $commons['contact']['additional_info'] ?? [];
    $contactEmail = $commons['contact']['email'] ?? '';
    $phone = $info['mobile_numbers'][0]['number'] ?? '';
    $address = $info['address'] ?? '';
    $gstin = $info['gstin'] ?? '';
    $logo = $info['logo'] ?? null;
    $logoUrl = $logo ? asset('uploads/' . $logo) : asset('assets/logo/logo.webp');
    $locationPrefix = !empty($location) ? '/' . $location : '';
    $categoryUrl = fn (array $category) => (!empty($category['seo']) ? $locationPrefix : '') . '/category/' . $category['slug'];
    $productUrl = fn (array $product) => (!empty($product['seo']) ? $locationPrefix : '') . '/product/' . $product['slug'];
    $whatsapp = $info['mobile_numbers'][0]['number'] ?? '+919891076555';
@endphp

<div class="offcanvas offcanvas-end mobile-navbar-offcanvas"
     tabindex="-1"
     id="mobileNavbar"
     aria-labelledby="mobileNavbarLabel">

    <!-- header -->
    <div class="offcanvas-header">
        <a class="mobile-offcanvas-logo" href="/">
            <img src="{{ $logoUrl }}" alt="{{ config('app.name') }}">
        </a>

        <button type="button"
                class="mobile-offcanvas-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="offcanvas-body">

        <!-- navigation heading -->
        <div class="mobile-menu-heading">
            <span>Explore Menu</span>
            <span>{{ strtoupper(config('app.name')) }}</span>
        </div>

        <!-- navigation -->
        <ul class="mobile-navbar-nav">

            <li>
                <a href="/">
                    <span>Home</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <li>
                <a href="/about-us">
                    <span>About Us</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <!-- products -->
            <li class="mobile-collection-item">

                <div class="mobile-collection-head">
                    <a href="/products">
                        <span>Products</span>
                    </a>

                    <button class="mobile-collection-toggle collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#mobileProducts"
                            aria-expanded="false"
                            aria-controls="mobileProducts">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="collapse" id="mobileProducts">
                    <div class="mobile-collection-list"
                         id="mobileProductAccordion">

                        @foreach ($menuCategories as $category)
                            @php
                                $categoryProducts = $menuProducts->where('category_id', $category['id']);
                                $collapseId = 'mobileCategory' . $category['id'];
                            @endphp

                            <div class="mobile-category-item">

                                <div class="mobile-category-head">
                                    <a href="{{ $categoryUrl($category) }}">
                                        {{ $category['title'] }}
                                    </a>

                                    @if ($categoryProducts->isNotEmpty())
                                        <button class="mobile-category-toggle collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#{{ $collapseId }}"
                                                aria-expanded="false"
                                                aria-controls="{{ $collapseId }}">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    @endif
                                </div>

                                @if ($categoryProducts->isNotEmpty())
                                    <div class="collapse"
                                         id="{{ $collapseId }}"
                                         data-bs-parent="#mobileProductAccordion">

                                        <div class="mobile-subcategory-list">
                                            @foreach ($categoryProducts as $product)
                                                <a href="{{ $productUrl($product) }}">
                                                    {{ $product['title'] }}
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            </li>

            <li>
                <a href="/sitemap">
                    <span>Sitemap</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <li>
                <a href="/blogs">
                    <span>Blogs</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <li>
                <a href="{{ $locationPrefix }}/explore">
                    <span>Explore</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <li>
                <a href="{{ $locationPrefix }}/our-presence">
                    <span>Our Presence</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

            <li>
                <a href="/contact-us">
                    <span>Contact Us</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>

        </ul>

        <!-- contact information -->
        <div class="mobile-contact-section">

            <div class="mobile-contact-heading">
                <span>Get In Touch</span>
                <i class="fa-solid fa-address-card"></i>
            </div>

            @if (!empty($phone))
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                   class="mobile-contact-item">

                    <span class="mobile-contact-icon">
                        <i class="fa-solid fa-phone"></i>
                    </span>

                    <span class="mobile-contact-content">
                        <small>Mobile Number</small>
                        <strong>{{ $phone }}</strong>
                    </span>

                    <span class="mobile-contact-arrow">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </a>
            @endif

            @if (!empty($contactEmail))
                <a href="mailto:{{ $contactEmail }}"
                   class="mobile-contact-item">

                    <span class="mobile-contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <span class="mobile-contact-content">
                        <small>Email Id</small>
                        <strong>{{ $contactEmail }}</strong>
                    </span>

                    <span class="mobile-contact-arrow">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </span>
                </a>
            @endif

            @if (!empty($gstin))
                <div class="mobile-contact-item">

                    <span class="mobile-contact-icon">
                        <i class="fa-solid fa-file"></i>
                    </span>

                    <span class="mobile-contact-content">
                        <small>GSTIN</small>
                        <strong>{{ $gstin }}</strong>
                    </span>
                </div>
            @endif

            @if (!empty($address))
                <div class="mobile-contact-item mobile-address-item">

                    <span class="mobile-contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>

                    <span class="mobile-contact-content">
                        <small>Address</small>
                        <strong>{{ $address }}</strong>
                    </span>
                </div>
            @endif

            <!-- whatsapp -->
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}"
               target="_blank"
               rel="noopener noreferrer"
               class="mobile-whatsapp-btn">

                <i class="fa-brands fa-whatsapp"></i>
                <span>Chat With Us on WhatsApp</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>
</div>
<!-- mobile offcanvas end -->
