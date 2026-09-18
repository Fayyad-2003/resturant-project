@extends('frontend.layouts.master')

@section('title', 'dashboard')

@push('front_style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.4/build/css/intlTelInput.css">
    <style>
        .iti {
            display: block !important;
        }

        .iti__selected-country {
            height: 30px;
            max-height: 100%;
        }

        .iti__country-container {
            /* top: -28px !important; */
        }

        /* Hide edit form by default */
        .fp_dash_personal_info_edit {
            display: none;
        }

        /* Show/hide edit/cancel buttons */
        .dash_info_btn .cancel {
            display: none;
        }

        /* Make the button clickable */
        .dash_info_btn {
            cursor: pointer;
            text-decoration: none !important;
        }

        .dash_info_btn:hover {
            opacity: 0.8;
        }

        /* Change Password Form Styling */
        .fp__change_password .comment_input label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .fp__change_password .comment_input label:first-of-type {
            margin-top: 0;
        }

        .fp__change_password .comment_input input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .fp__change_password .comment_input input[type="password"]:focus {
            border-color: #fe6100;
            outline: none;
            box-shadow: 0 0 0 3px rgba(254, 97, 0, 0.1);
        }

        .fp__change_password .common_btn {
            margin-top: 20px;
            padding: 12px 40px;
        }

        .fp__change_password h3 {
            margin-bottom: 25px;
            text-transform: capitalize;
        }

        .fp__change_password .row {
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <!--BREADCRUMB START-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>dashboard</h1>
                    <ul>
                        {{-- <li><a href="{{ route('home.index') }}">home</a></li> --}}
                        <li><a href="javascript:void();">dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--BREADCRUMB END-->


    <!--DASHBOARD START-->
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_menu">
                            <div class="dasboard_header">
                                <div class="dasboard_header_img">
                                    <img src="{{ auth()->user()->avatar }}" alt="user"
                                        class="img-fluid w-100 photo_preview" id="photo_preview">
                                    <form action="#" method="post" class=" w-full" style="width: 100%;"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="">
                                        <label for="upload"><i class="far fa-camera"></i></label>
                                        <input type="file" id="upload" class="photo" name="photo" hidden>
                                        <button style="display: none;margin-bottom:20px;" id="photo_update_button"
                                            class="photo_update_button common_btn btn-sm mt-2  mb-4 w-full bg-info">upload
                                            now</button>
                                    </form>
                                </div>
                                <h2>{{ auth()->user()->name }}</h2>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span> Parsonal Info</button>

                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false"><span><i
                                            class="fas fa-bags-shopping"></i></span> Order</button>

                                <button class="nav-link" id="v-pills-messages-tab2" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages2" type="button" role="tab"
                                    aria-controls="v-pills-messages2" aria-selected="false"><span><i
                                            class="far fa-heart"></i></span> wishlist</button>

                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false"><span><i
                                            class="fas fa-star"></i></span> Reviews</button>

                                <button class="nav-link w-full" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Change Password </button>

                                <button class="nav-link w-full" id="v-pills-track-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-track" type="button" role="tab"
                                    aria-controls="v-pills-track" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Track Order </button>

                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="nav-link w-full" type="button" style="width: 100%!important;"
                                        onclick="event.preventDefault();this.closest('form').submit();"> <span> <i
                                                class="fas fa-sign-out-alt"></i></span> Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="fp_dashboard_body">
                                        <h3>Welcome to your Profile</h3>

                                        <div class="fp__dsahboard_overview">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>total order <span>(0)</span></h4>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item green">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>Completed <span>(0)</span></h4>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item red">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>cancel <span>(0)</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fp_dash_personal_info">
                                            <h4>Parsonal Information
                                                <a href="#" class="dash_info_btn">
                                                    <span class="edit">edit</span>
                                                    <span class="cancel">cancel</span>
                                                </a>
                                            </h4>

                                            <div class="personal_info_text">
                                                <p><span>Name:</span> {{ auth()->user()->name }}</p>
                                                <p><span>Email:</span> {{ auth()->user()->email }}</p>
                                            </div>

                                            <div class="fp_dash_personal_info_edit comment_input p-0">
                                                <form action="{{ route('profile.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" value="" name="id">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="text" name="name" placeholder="Name"
                                                                value="{{ auth()->user()->name }}">
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6">
                                                            <input type="email" name="email" placeholder="Email"
                                                                value="{{ auth()->user()->email }}">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit" class="common_btn">update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <div class="fp_dashboard_body">
                                        <h3>order list</h3>
                                        <div class="fp_dashboard_order">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="t_header">
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Paid/Unpad</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        {{-- Orders will be listed here dynamically --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="v-pills-messages2" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab2">
                                    <div class="fp_dashboard_body">
                                        <h3>wishlist</h3>
                                        <div class="fp__dashoard_wishlist">
                                            <div class="row">
                                                {{-- Wishlist items will be listed here dynamically --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab">
                                    <div class="fp_dashboard_body dashboard_review">
                                        <h3>review</h3>
                                        <div class="fp__review_area">
                                            <div class="fp__comment pt-0 mt_20">
                                                {{-- Reviews will be listed here dynamically --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab">
                                    <div class="fp_dashboard_body fp__change_password">
                                        <h3>Change Password</h3>
                                        <div class="fp__review_input">
                                            <div class="comment_input pt-0">
                                                <form method="POST" action="{{ route('profile.password.update') }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12">
                                                            <label for="current_password">Current Password</label>
                                                            <input type="password" name="current_password"
                                                                id="current_password" placeholder="Enter current password"
                                                                required>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6">
                                                            <label for="password">New Password</label>
                                                            <input type="password" name="password" id="password"
                                                                placeholder="Enter new password" required>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6">
                                                            <label for="password_confirmation">Confirm New Password</label>
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation"
                                                                placeholder="Confirm new password" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit" class="common_btn mt_20">Update
                                                                Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-track" role="tabpanel"
                                    aria-labelledby="v-pills-track-tab">
                                    <div class="fp_dashboard_body fp__change_password">
                                        <div class="fp__review_input">
                                            <h3>Track Order</h3>
                                            <div class="comment_input pt-0">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <input type="text" name="order_number" id="order_number"
                                                                placeholder="Please enter your order number">
                                                            <button type="button" id="track_order_submit"
                                                                class="track_order_submit common_btn mt_20">Track</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="order_tracking_data" id="order_tracking_data">
                                            {{-- Order tracking results will appear here --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--DASHBOARD END-->

@endsection

@push('front_script')
    <script>
        $(document).ready(function() {
            console.log('Dashboard script loaded');

            // Handle Edit/Cancel button click for personal info
            $('.dash_info_btn').on('click', function(e) {
                e.preventDefault();
                console.log('Edit button clicked');

                const $editBtn = $(this).find('.edit');
                const $cancelBtn = $(this).find('.cancel');
                const $infoText = $('.personal_info_text');
                const $infoEdit = $('.fp_dash_personal_info_edit');

                console.log('Edit form visible:', $infoEdit.is(':visible'));

                // Toggle visibility
                if ($infoEdit.is(':visible')) {
                    // Cancel - hide edit form, show info text
                    console.log('Hiding edit form');
                    $infoEdit.slideUp(300);
                    $infoText.slideDown(300);
                    $editBtn.show();
                    $cancelBtn.hide();
                } else {
                    // Edit - show edit form, hide info text
                    console.log('Showing edit form');
                    $infoText.slideUp(300);
                    $infoEdit.slideDown(300);
                    $editBtn.hide();
                    $cancelBtn.show();
                }
            });
        });
    </script>
@endpush
