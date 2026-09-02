@extends('frontend.layouts.master')
@section('title', 'Admin Login')
@section('content')
    <!--BREADCRUMB START-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Admin Login</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="javascript:;">admin login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--BREADCRUMB END-->

    <!--ADMIN LOGIN START-->
    <section class="fp__signin" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
        <div class="fp__signin_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <h2>Admin Panel</h2>
                            <p>Sign in to access dashboard</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Enter your email" required
                                                autofocus value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Enter your password"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput fp__login_check_area">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember-me">
                                                <label class="form-check-label" for="remember-me">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">Login to Dashboard</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p class="or"><span>or</span></p>

                            <ul class="d-flex">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>

                            <p class="create_account">
                                Back to main site? <a href="{{ route('home') }}">Go Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--ADMIN LOGIN END-->
@endsection
