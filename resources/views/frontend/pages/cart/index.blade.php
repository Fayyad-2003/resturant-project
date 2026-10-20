@extends('frontend.layouts.master')
@section('title', 'My Cart')

@section('content')
    <!--BREADCRUMB START-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:void(0);">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--BREADCRUMB END-->

    <!--CART VIEW START-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="fp__pro_img">Image</th>
                                        <th class="fp__pro_name">Details</th>
                                        <th class="fp__pro_status">Price</th>
                                        <th class="fp__pro_select">Quantity</th>
                                        <th class="fp__pro_tk">Total</th>
                                        <th class="fp__pro_icon">
                                            <a class="clear_all" type="button" onclick="cartClear()">
                                                Clear All
                                            </a>
                                        </th>
                                    </tr>
                                </tbody>

                                <tbody class="my_cart_page_content" id="my_cart_page_content">
                                    {{-- Loaded dynamically via AJAX --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <div class="coupon_calculation" id="coupon_calculation">
                            <h6>Total Cart 
                                <span class="subtotal_price">0</span>
                            </h6>
                            <p class="total"><span>Total:</span> <span class="subtotal_price">0</span></p>
                        </div>
                        <a class="common_btn" href="#">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--CART VIEW END-->
@endsection
