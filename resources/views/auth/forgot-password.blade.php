@extends('frontend.layouts.master')
@section('content')
    <!--====BREADCRUMB START====-->
    <section class="fp__breadcrumb" style="background: url(frontend/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>forgot password</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="forgot-password.html">forgot password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--====BREADCRUMB END====-->

    <!--FORGOT PASSWORD START-->
    <section class="fp__signup" style="background: url(frontend/images/login_bg.jpg);">
        <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">

                        <div class="fp__login_area">
                            <h2>Welcome back!</h2>
                            <p>forgot password</p>

                            <div class="my-2">
                                Forgot your password? No problem.
                                Just enter your email address and we will send you a password reset link.
                            </div>

                            <!-- Status message placeholder -->
                            <div class="alert alert-primary d-none" role="alert">
                                <!-- Insert success message here -->
                            </div>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">

                                    <!-- Email -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Enter your email" required
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">verify mail</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <p class="create_account d-flex justify-content-between">
                                <a href="{{ route('login') }}">login</a>
                                <a href="{{ route('register') }}">Create Account</a>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
