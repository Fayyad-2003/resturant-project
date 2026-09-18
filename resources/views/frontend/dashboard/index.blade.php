@extends('frontend.layouts.master')

@section('title', 'Dashboard')

@section('content')
    {{-- DASHBOARD CONTENT --}}
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_menu">
                            <div class="dasboard_header">
                                <div class="dasboard_header_img">
                                    <img src="{{ asset('frontend/images/dashboard_user.jpg') }}" alt="user"
                                        class="img-fluid w-100">
                                    <label for="upload"><i class="far fa-camera"></i></label>
                                    <input type="file" id="upload" hidden>
                                </div>
                                <h2>User Name</h2>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span> Personal Info</button>
                                <button class="nav-link" id="v-pills-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-address" type="button" role="tab"
                                    aria-controls="v-pills-address" aria-selected="false"><span><i
                                            class="fas fa-map-marker-alt"></i></span> Address</button>
                                <button class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-order" type="button" role="tab"
                                    aria-controls="v-pills-order" aria-selected="false"><span><i
                                            class="fas fa-bags-shopping"></i></span> Order</button>
                                <button class="nav-link" id="v-pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-wishlist" type="button" role="tab"
                                    aria-controls="v-pills-wishlist" aria-selected="false"><span><i
                                            class="far fa-heart"></i></span> Wishlist</button>
                                <button class="nav-link" id="v-pills-review-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-review" type="button" role="tab"
                                    aria-controls="v-pills-review" aria-selected="false"><span><i
                                            class="fas fa-star"></i></span> Reviews</button>
                                <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-password" type="button" role="tab"
                                    aria-controls="v-pills-password" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Change Password </button>
                                <a href="#"><span> <i class="fas fa-sign-out-alt"></i></span> Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="fp_dashboard_body">
                                        <h3>Welcome to your Dashboard!</h3>
                                        <p>Manage your profile, orders, addresses and more.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
