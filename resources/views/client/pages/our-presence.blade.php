@extends('client.layout')

@php
    $states = collect($commons['presence'] ?? []);
    $locationCategories = collect($commons['menu']['categories'] ?? [])
        ->filter(fn ($category) => !empty($category['seo']));
    $locationProducts = collect($commons['menu']['products'] ?? [])
        ->filter(fn ($product) => !empty($product['seo']));
    $locationTarget = $locationCategories->first() ?? $locationProducts->first();
    $locationType = $locationCategories->isNotEmpty() ? 'category' : 'product';
    $stateUrl = function (array $state) use ($locationTarget, $locationType): string {
        $slug = $state['slug'] ?? '';

        if ($slug === '') {
            return '/our-presence';
        }

        if ($locationTarget) {
            return '/' . $slug . '/' . $locationType . '/' . $locationTarget['slug'];
        }

        return '/' . $slug . '/our-presence';
    };
@endphp

@section('content')

    <!-- breadcrumb strip start -->
    <section class="breadcrumb-main-div">
        <div class="container">
            <div class="breadcrumb-main-div-content">
                <a href="/">Home</a>
                <i class="fa-solid fa-angle-right"></i>
                <span>Our Presence</span>
            </div>
        </div>
    </section>
    <!-- breadcrumb strip end -->

    <!-- our presence start -->
    <section class="sitemap-section">
        <div class="container">

            <div class="sitemap-main-heading">
                <span class="sitemap-kicker">Where We Supply</span>
                <h1>Our <strong>Presence</strong></h1>
                <p>
                    Herritage Moulds supplies moulded cabinets and enclosure solutions from Delhi to
                    assembly units and distributors across India. Select a state to view the local
                    product information page.
                </p>
            </div>

            <div class="sitemap-group">
                <div class="sitemap-group-heading">
                    <span class="sitemap-heading-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <div>
                        <h2>States We Serve</h2>
                        <p>Choose a state to open the product range available in that location.</p>
                    </div>
                </div>

                <div class="row g-3 sitemap-quick-grid">
                    @forelse ($states as $state)
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="{{ $stateUrl($state) }}" class="sitemap-quick-link">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ $state['location'] ?? $state['slug'] }}</span>
                                <i class="fa-solid fa-arrow-up-right-from-square sitemap-link-arrow"></i>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>Location pages are being updated. Contact the team to confirm supply for your area.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="sitemap-contact">
                <div class="sitemap-contact-content">
                    <span class="sitemap-kicker">Not Sure About Your Area?</span>
                    <h2>Let's Confirm Your Delivery Location</h2>
                    <p>
                        Share the delivery pin code with the team so the supply route and packing can be confirmed.
                    </p>
                </div>

                <a href="/contact-us" class="sitemap-contact-btn">
                    Contact Us
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </section>
    <!-- our presence end -->

@endsection
