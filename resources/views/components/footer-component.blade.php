@php
    $menuProducts = collect($commons['menu']['products'] ?? []);
    $menuCategories = collect($commons['menu']['categories'] ?? []);
    $info = $commons['contact']['additional_info'] ?? [];
    $site = $commons['site']['content'] ?? [];
    $contactEmail = $commons['contact']['email'] ?? '';
    $phone = $info['mobile_numbers'][0]['number'] ?? '';
    $address = $info['address'] ?? '';
    $gstin = $info['gstin'] ?? '';
    $logo = $info['logo'] ?? null;
    $logoUrl = $logo ? asset('uploads/' . $logo) : asset('assets/logo/logo.webp');
    $socialLinks = collect($info['social_links'] ?? []);
    $locationPrefix = !empty($location) ? '/' . $location : '';
    $categoryUrl = fn (array $category) => (!empty($category['seo']) ? $locationPrefix : '') . '/category/' . $category['slug'];
    $productUrl = fn (array $product) => (!empty($product['seo']) ? $locationPrefix : '') . '/product/' . $product['slug'];
@endphp

<!-- footer start -->
<footer class="hm-footer">
    <div class="hm-footer-glow"></div>

    <div class="container">

        <!-- footer main -->
        <div class="hm-footer-main">
            <div class="row g-5">

                <!-- brand -->
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="hm-footer-brand">

                        <a href="/" class="hm-footer-logo">
                            <img src="{{ $logoUrl }}" alt="{{ config('app.name') }}">
                        </a>

                        <p>
                            {{ $site['footer_description'] ?? 'Herritage Moulds supplies moulded cabinets and enclosure solutions for electrical, electronic and power supply applications.' }}
                        </p>

                        <a href="/products" class="hm-footer-button">
                            <span>Explore Products</span>
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>

                    </div>
                </div>

                <!-- quick links -->
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="hm-footer-links">
                        <h3>Quick Links</h3>

                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/products">Products</a></li>
                            <li><a href="/blogs">Blogs</a></li>
                            <li><a href="{{ $locationPrefix }}/our-presence">Our Presence</a></li>
                            <li><a href="/sitemap">Sitemap</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- products -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="hm-footer-links">
                        <h3>Products</h3>

                        <ul>
                            @foreach ($menuCategories as $category)
                            <li><a href="{{ $categoryUrl($category) }}">{{ $category['title'] }}</a></li>
                            @endforeach
                            <li><a href="{{ $locationPrefix }}/explore">Explore</a></li>
                        </ul>
                    </div>
                </div>

                <!-- policies -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                    <div class="hm-footer-links hm-footer-policy">
                        <h3>Policies</h3>

                        <ul>
                            <li><a href="/disclaimer">Disclaimer</a></li>
                            <li><a href="/privacy-policy">Privacy Policy</a></li>
                            <li><a href="/terms-and-conditions">Terms &amp; Conditions</a></li>
                            <li><a href="/faqs">FAQs</a></li>
                        </ul>

                        @if (!empty($gstin))
                            <div class="hm-footer-gst">
                                <span class="hm-gst-icon">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </span>
                                <span>
                                    <small>GST Registration</small>
                                    <strong>{{ $gstin }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!-- contact panel -->
        <div class="hm-footer-contact">

            <div class="hm-contact-heading">
                <div>
                    <span class="hm-footer-eyebrow">Let's Connect</span>
                    <h2>We're here to <span>help.</span></h2>
                </div>
            </div>

            <div class="row g-3">

                @if (!empty($phone))
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="hm-contact-card">
                            <span class="hm-contact-icon">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <span class="hm-contact-info">
                                <small>Mobile Number</small>
                                <strong>{{ $phone }}</strong>
                            </span>
                            <span class="hm-contact-arrow">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </span>
                        </a>
                    </div>
                @endif

                @if (!empty($contactEmail))
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <a href="mailto:{{ $contactEmail }}"
                           class="hm-contact-card">
                            <span class="hm-contact-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <span class="hm-contact-info">
                                <small>Email Id</small>
                                <strong>{{ $contactEmail }}</strong>
                            </span>
                            <span class="hm-contact-arrow">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </span>
                        </a>
                    </div>
                @endif

                @if (!empty($address))
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="hm-contact-card hm-contact-address">
                            <span class="hm-contact-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <span class="hm-contact-info">
                                <small>Address</small>
                                <strong>{{ $address }}</strong>
                            </span>
                            <span class="hm-contact-arrow">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </span>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- footer bottom -->
        <div class="hm-footer-bottom">

            <p>
                &copy; {{ date('Y') }} <strong>{{ $site['copyright'] ?? config('app.name') }}</strong>.
                All Rights Reserved.
                <span class="hm-footer-credit">
                    Designed By
                    <a href="https://hyperformancemedia.in/"
                       target="_blank"
                       rel="noopener noreferrer">Hyperformance Media.</a>
                </span>
            </p>

            @if ($socialLinks->isNotEmpty())
                <div class="hm-footer-social">
                    @foreach ($socialLinks as $social)
                        <a href="{{ $social['url'] ?? 'javascript:void(0)' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="{{ $social['name'] ?? 'Social' }}">
                            <i class="fa-brands fa-{{ $social['icon'] ?? 'link' }}"></i>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>

    </div>
</footer>
<!-- footer end -->
