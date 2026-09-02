@extends('frontend.layouts.master')

@section('content')
    <!--BREADCRUMB START-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Reset Password</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="javascript:;">reset password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--BREADCRUMB END-->

    <!--RESET PASSWORD START-->
    <section class="fp__signup" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
        <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">

                        <div class="fp__login_area">
                            <h2>Reset Your Password</h2>
                            <p>Enter your email and new password</p>

                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="row">

                                    <!-- Email -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Enter your email" required
                                                value="{{ old('email', $request->email) }}">
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>New Password</label>
                                            <input type="password" name="password" placeholder="Enter new password"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm new password" required>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">Reset Password</button>
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
                                Remember your password? <a href="{{ route('login') }}">Login</a>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
