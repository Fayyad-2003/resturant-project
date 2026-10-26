@extends('frontend.layouts.master')

@section('title')
    {{ !empty($category_name) ? $category_name : 'Shop / Food Menu' }} - {{ config('app.name', 'FoodPark') }}
@endsection

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    @if (!empty($category_name))
                        <h1>{{ $category_name }}</h1>
                    @else
                        <h1>Our Popular Foods Menu</h1>
                    @endif
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop Menu</a></li>
                        @if (!empty($category_name))
                            <li><a href="javascript:;">{{ $category_name }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- SHOP / FOOD MENU START -->
    <section class="fp__menu mt_95 xs_mt_45 mb_100 xs_mb_70">
        <div class="container">
            <!-- Category Filter Pills & Search -->
            <!-- Category Filter & Price Sort Tabs -->
            <div class="row mb_45">
                <!-- 1. Categories Pills -->
                <div class="col-12 mb-3">
                    <div class="menu_filter d-flex flex-wrap justify-content-center align-items-center gap-2">
                        <a href="{{ route('shop', array_merge(request()->query(), ['category' => null])) }}"
                            class="btn {{ empty(request('category')) ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                            All Menu
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('shop', array_merge(request()->query(), ['category' => $cat->slug])) }}"
                                class="btn {{ request('category') == $cat->slug ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- 2. Price Sort Tabs & Search -->
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-between align-items-center bg-light p-3 rounded">
                        <!-- Search Input -->
                        <form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center my-1"
                            style="max-width: 320px;">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                                placeholder="Search foods...">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-search"></i></button>
                        </form>

                        <!-- Price Sort Tabs -->
                        <div class="d-flex flex-wrap align-items-center gap-2 my-1">
                            <span class="fw-bold text-muted me-2"><i class="fas fa-sort me-1"></i>Sort By:</span>

                            <!-- Default / Latest -->
                            <a href="{{ route('shop', array_merge(request()->query(), ['sort' => 'latest'])) }}"
                                class="btn btn-sm {{ request('sort', 'latest') == 'latest' ? 'btn-danger' : 'btn-outline-secondary' }}">
                                <i class="far fa-clock me-1"></i> Latest
                            </a>

                            <!-- Price: Low to High -->
                            <a href="{{ route('shop', array_merge(request()->query(), ['sort' => 'price_asc'])) }}"
                                class="btn btn-sm {{ request('sort') == 'price_asc' ? 'btn-danger' : 'btn-outline-secondary' }}">
                                <i class="fas fa-arrow-up-wide-short me-1"></i> Price: Low to High
                            </a>

                            <!-- Price: High to Low -->
                            <a href="{{ route('shop', array_merge(request()->query(), ['sort' => 'price_desc'])) }}"
                                class="btn btn-sm {{ request('sort') == 'price_desc' ? 'btn-danger' : 'btn-outline-secondary' }}">
                                <i class="fas fa-arrow-down-wide-short me-1"></i> Price: High to Low
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4 mb_30 wow fadeInUp" data-wow-duration="1s">
                        <x-frontend.product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="fp__empty_cart">
                            <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No foods found in this section!</h4>
                            <p class="text-muted">Try checking other categories or visit our full menu.</p>
                            <a href="{{ route('shop') }}" class="common_btn mt-3">View All Foods</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="fp__pagination mt_35">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $products->withQueryString()->links('vendor.pagination.food-park-pagination') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- SHOP / FOOD MENU END -->

    <!-- Quick View Cart Popup Modal -->
    @include('frontend.pages.home.components.cart-popup')
@endsection