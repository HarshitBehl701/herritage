@php
    $slug = $menu['menu']['products'][0]['slug'] ?? 'our-presence'; // specify correct key
    $page = $slug !== 'our-presence' ? 'product/' . $slug : $slug;
@endphp
<style>
    .location-wrapper h4,
    .location-wrapper h5,
    .location-wrapper h6 {
        position: relative;
        padding-left: 14px;
    }

    .location-wrapper h4::before,
    .location-wrapper h5::before,
    .location-wrapper h6::before {
        content: "";
        position: absolute;
        left: 0;
        top: 6px;
        height: 70%;
        width: 4px;
        border-radius: 4px;
        background: linear-gradient(180deg, #2563eb, #06b6d4);
    }

    /* SECTION CONTAINER */
    .location-section {
        background: #f8fafc;
        padding: 28px;
        border-radius: 18px;
        margin-bottom: 40px;
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    /* CARD */
    .location-card {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border-radius: 12px;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        text-decoration: none;
        color: #0f172a;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .location-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border-color: rgba(37, 99, 235, 0.4);
    }

    /* COUNTRY STYLE */
    .country-card {
        font-weight: 600;
        font-size: 15px;
        background: linear-gradient(135deg, #eff6ff, #f0f9ff);
    }

    /* STATE STYLE */
    .state-card {
        background: #ffffff;
    }

    /* DISTRICT STYLE */
    .district-card {
        background: #fafafa;
        font-size: 13.5px;
    }

    /* CITY STYLE */
    .city-card {
        background: #f9fafb;
        font-size: 13px;
        color: #475569;
    }

    hr {
        opacity: 0.08;
    }

    @media (max-width: 768px) {
        .location-section {
            padding: 18px;
        }
    }
</style>
@if (!empty($locations))
    <div class="container location-wrapper py-4">

        {{-- ================= COUNTRIES SECTION ================= --}}
        <div class="location-section">
            <h4 class="fw-bold mb-4">Countries We Serve</h4>

            <div class="row g-3">
                @foreach ($locations as $country)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="/{{ $country['slug'] }}/{{ $page }}" class="location-card country-card">
                            {{ ucwords(str_replace('-', ' ', $country['slug'])) }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- ================= COUNTRY-WISE STRUCTURE ================= --}}
        @foreach ($locations as $country)
            @if (!empty($country['children']))
                {{-- STATES SECTION --}}
                <div class="location-section">
                    <h4 class="fw-bold mb-4">
                        States We Serve In {{ ucwords(str_replace('-', ' ', $country['slug'])) }}
                    </h4>

                    <div class="row g-3">
                        @foreach ($country['children'] as $state)
                            <div class="col-lg-3 col-md-4 col-6">
                                <a href="/{{ $state['slug'] }}/{{ $page }}" class="location-card state-card">
                                    {{ ucwords(str_replace('-', ' ', $state['slug'])) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


                {{-- DISTRICTS SECTION --}}
                @foreach ($country['children'] as $state)
                    @if (!empty($state['children']))
                        <div class="location-section">
                            <h5 class="fw-semibold mb-4">
                                Districts In {{ ucwords(str_replace('-', ' ', $state['slug'])) }},
                                {{ ucwords(str_replace('-', ' ', $country['slug'])) }}
                            </h5>

                            <div class="row g-3">
                                @foreach ($state['children'] as $district)
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <a href="/{{ $district['slug'] }}/{{ $page }}"
                                            class="location-card district-card">
                                            {{ ucwords(str_replace('-', ' ', $district['slug'])) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach


                {{-- CITIES SECTION --}}
                @foreach ($country['children'] as $state)
                    @foreach ($state['children'] ?? [] as $district)
                        @if (!empty($district['children']))
                            <div class="location-section">
                                <h6 class="fw-semibold mb-4">
                                    Cities In {{ ucwords(str_replace('-', ' ', $district['slug'])) }},
                                    {{ ucwords(str_replace('-', ' ', $state['slug'])) }},
                                    {{ ucwords(str_replace('-', ' ', $country['slug'])) }}
                                </h6>

                                <div class="row g-3">
                                    @foreach ($district['children'] as $city)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="/{{ $city['slug'] }}/{{ $page }}"
                                                class="location-card city-card">
                                                {{ ucwords(str_replace('-', ' ', $city['slug'])) }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
        @endforeach

    </div>
@else
    <br>
    <p class="text-center fs-5"><i>No More Locations...</i></p>
@endif
