@extends('frontend.layouts.master')
@section('title', 'Checkout')

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Checkout</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:void(0);">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- CHECKOUT PAGE START -->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <!-- Billing Form -->
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__checkout_form">
                        <form method="GET" action="{{ route('checkout.store') }}">
                            @csrf

                            <!-- Hidden fields -->
                            @if (Session::has('coupon'))
                                <input type="hidden" name="final_total_input" class="findal_total_input"
                                    value="{{ session()->get('coupon')['coupon_discount_amount'] }}">
                            @else
                                <input type="hidden" name="final_total_input" class="findal_total_input"
                                    value="{{ Cart::total() }}">
                            @endif
                            <input type="hidden" name="delivery_charge_input" class="delivery_charge_input" value="0">

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h5>Billing & Delivery Address</h5>
                                </div>

                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-12 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" required placeholder="e.g. +963 9xx xxx xxx">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Division / Governorate -->
                                <div class="col-md-4 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="division_id">Governorate</label>
                                        <select name="division_id" id="division_id" class="nice-select" required>
                                            <option value="" selected disabled>--Choose Governorate--</option>
                                            @foreach ($alldivisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }} ({{ $division->bn_name }})</option>
                                            @endforeach
                                        </select>
                                        @error('division_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- District -->
                                <div class="col-md-4 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="district_id">District</label>
                                        <select name="district_id" id="district_id" class="nice-select" required>
                                            <option value="" selected disabled>--Choose District--</option>
                                        </select>
                                        @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Upazila / Area -->
                                <div class="col-md-4 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="state_id">Area / Neighborhood</label>
                                        <select name="state_id" id="state_id" class="nice-select" required>
                                            <option value="" selected disabled>--Choose Area--</option>
                                        </select>
                                        @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Detailed Address -->
                                <div class="col-12 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="address">Street / Detailed Address</label>
                                        <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address ?? '') }}" placeholder="Building, Street, Floor, Apartment" required>
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Post Code -->
                                <div class="col-12 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="post_code">Postal Code</label>
                                        <input type="text" name="post_code" id="post_code" value="{{ old('post_code', Auth::user()->post_code ?? '0000') }}" required>
                                        @error('post_code') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="col-12 mb-3">
                                    <div class="fp__login_imput">
                                        <label for="notes">Additional Information / Notes</label>
                                        <textarea name="notes" id="notes" placeholder="Order instructions or special delivery notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                <!-- Delivery Fee & Order Total Display -->
                                <div class="col-12 mb-3">
                                    <div class="card p-3 bg-light">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold">Delivery Charge:</span>
                                            <span>{{ config('settings.site_currency_icon', '$') }} <span class="delivery_charge">0</span></span>
                                        </div>
                                        <div class="d-flex justify-content-between fs-5 fw-bold text-success border-top pt-2">
                                            <span>Total Amount:</span>
                                            <span>{{ config('settings.site_currency_icon', '$') }} <span class="findal_total">
                                                @if (Session::has('coupon'))
                                                    {{ round(Session::get('coupon')['coupon_discount_amount'], 2) }}
                                                @else
                                                    {{ Cart::total() }}
                                                @endif
                                            </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Methods Selection -->
                            <div class="row mt-4">
                                <div class="col-12 mb-3">
                                    <h5>Select Payment Method</h5>
                                </div>

                                @php
                                    $payments = [
                                        [
                                            'name' => 'cash on delivery',
                                            'img' => 'https://static.vecteezy.com/system/resources/thumbnails/020/960/669/small/fast-and-free-delivery-design-template-free-delivery-icons-fast-shipping-courier-service-cash-on-delivery-badges-vector.jpg',
                                            'title' => 'Cash On Delivery',
                                            'desc' => 'Pay cash when food arrives',
                                        ],
                                        [
                                            'name' => 'stripe',
                                            'img' => 'https://assets.techrepublic.com/uploads/2024/10/tr_20241002-stripe-review.jpg',
                                            'title' => 'Credit Card (Stripe)',
                                            'desc' => 'Instant secure online card payment',
                                        ],
                                        [
                                            'name' => 'paypal',
                                            'img' => 'https://logowik.com/content/uploads/images/897_paypal.jpg',
                                            'title' => 'PayPal',
                                            'desc' => 'Pay using PayPal wallet',
                                        ],
                                    ];
                                @endphp

                                @foreach ($payments as $payment)
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="payment-card d-flex flex-column align-items-center p-3 shadow-sm rounded-3 text-center w-100 h-100">
                                            <input type="radio" name="payment_method" value="{{ $payment['name'] }}" class="d-none">
                                            <img src="{{ $payment['img'] }}" alt="{{ $payment['title'] }}" class="img-fluid mb-2" style="max-height: 60px; object-fit: contain;">
                                            <h6 class="mb-1">{{ $payment['title'] }}</h6>
                                            <p class="text-muted small">{{ $payment['desc'] }}</p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="common_btn mt-3 w-100">Place Order</button>
                        </form>
                    </div>
                </div>

                <!-- Order Products Summary Sidebar -->
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 fw-bold">My Order Products</h6>
                        </div>
                        <div class="card-body checkout_content" id="checkout_content">
                            @include('frontend.layouts.partials.checkout-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CHECKOUT PAGE END -->
@endsection

@push('front_style')
    <style>
        .payment-card {
            cursor: pointer;
            border: 2px solid #e0e0e0;
            transition: all 0.25s ease-in-out;
            background-color: #fff;
        }
        .payment-card:hover {
            border-color: #ff7c08;
            background-color: #fffaf5;
        }
        .payment-card.selected {
            border-color: #ff7c08;
            background-color: #fff3e6;
            box-shadow: 0 4px 12px rgba(255, 124, 8, 0.2) !important;
        }
        .payment-card h6 {
            font-weight: 600;
        }
        .payment-card p {
            font-size: 0.85rem;
            margin-bottom: 0;
        }
    </style>
@endpush

@push('front_script')
    <script>
        $(document).ready(function() {
            // 1. Division → District
            $(document).on('change', '#division_id', function() {
                var division_id = $(this).val();
                $.get(route('select.district'), {
                    division_id: division_id
                }, function(response) {
                    var html = '<option selected disabled>--Choose District--</option>';
                    $.each(response, function(key, value) {
                        html += `<option value="${value.id}">${value.name} (${value.bn_name})</option>`;
                    });
                    $('#district_id').html(html);
                    if ($('#district_id').niceSelect) {
                        $('#district_id').niceSelect('update');
                    }
                }, 'json');
            });

            // 2. District → Upazila / Area
            $(document).on('change', '#district_id', function() {
                var district_id = $(this).val();
                $.get(route('select.state'), {
                    district_id: district_id
                }, function(response) {
                    var html = '<option selected disabled>--Choose Area--</option>';
                    $.each(response, function(key, value) {
                        html += `<option value="${value.id}">${value.name} (${value.bn_name})</option>`;
                    });
                    $('#state_id').html(html);
                    if ($('#state_id').niceSelect) {
                        $('#state_id').niceSelect('update');
                    }
                }, 'json');
            });

            // 3. Update Delivery Charge & Final Total on Division change
            $(document).on('change', '#division_id', function() {
                var division_id = $(this).val();
                $.get(route('get.delivery.charge'), {
                    division_id: division_id
                }, function(response) {
                    $('.delivery_charge').text(response.delivery_charge);
                    $('.findal_total').text(response.finaltotalprice);
                    $('.findal_total_input').val(response.finaltotalprice);
                    $('.delivery_charge_input').val(response.delivery_charge);
                }, 'json');
            });

            // 4. Payment Card Selection
            $(document).on('click', '.payment-card', function() {
                $('.payment-card').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('input[type=radio]').prop('checked', true);
            });

            // Pre-select first payment card (Cash on Delivery)
            $('.payment-card:first').click();
        });
    </script>
@endpush