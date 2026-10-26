@extends('frontend.layouts.master')

@section('title', 'About Us')

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>About FoodPark</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:;">About Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- ABOUT PAGE START -->
    <section class="fp__about_us mt_120 xs_mt_90">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__about_us_img">
                        <img src="{{ asset('frontend/images/about_chef.jpg') }}" alt="About FoodPark" class="img-fluid w-100 rounded shadow-sm">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__section_heading mb_40">
                        <h4>About Company</h4>
                        <h2>Healthy & Delicious Foods Provider</h2>
                        <span>
                            <img src="{{ asset('frontend/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                    </div>
                    <div class="fp__about_us_text">
                        <p>At FoodPark, our culinary journey is defined by passion, authentic flavors, and the finest organic ingredients. From artisanal handcrafted pizzas to sizzled flame-grilled burgers and fresh healthy salads, every recipe is prepared with love and expertise.</p>
                        <p class="mb-4">We believe good food brings people together. Our kitchen combines traditional recipes with modern culinary arts to deliver a memorable dining experience for you and your family.</p>
                        <ul>
                            <li>Delicious & Healthy Foods</li>
                            <li>Specific Family & Kids Zone</li>
                            <li>Best Price & Daily Offers</li>
                            <li>Made By 100% Fresh Ingredients</li>
                            <li>Easy Online Table Reservation</li>
                            <li>Fast & Reliable Home Delivery</li>
                            <li>Music & Calm Pleasant Atmosphere</li>
                            <li>Hygiene & Food Safety Certified</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US COMPONENT -->
    @include('frontend.pages.home.components.why-choose-us')

    <!-- PROMO VIDEO SECTION START -->
    <section class="fp__about_video mt_100 xs_mt_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="fp__about_video_bg" style="background: url({{ asset('frontend/images/about_video_bg.jpg') }});">
                <div class="fp__about_video_overlay">
                    <div class="row">
                        <div class="col-12">
                            <div class="fp__about_video_text">
                                <p>Watch How We Cook</p>
                                <a class="play_btn venobox" data-autoplay="true" data-vbtype="video" href="https://youtu.be/F3zw1Gvn4Mk" target="_blank">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PROMO VIDEO SECTION END -->

    <!-- OUR TEAM / CHEFS COMPONENT -->
    @include('frontend.pages.home.components.our-team')

    <!-- STATS COUNTER COMPONENT -->
    @include('frontend.pages.home.components.counter')

    <!-- TESTIMONIALS COMPONENT -->
    @include('frontend.pages.home.components.testimonial')
    <!-- ABOUT PAGE END -->
@endsection

