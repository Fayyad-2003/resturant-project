<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>FoodPark || home page</title>
    <link rel="icon" type="image/png">
    <link rel="stylesheet" href="frontend/css/all.min.css">
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/spacing.css">
    <link rel="stylesheet" href="frontend/css/slick.css">
    <link rel="stylesheet" href="frontend/css/nice-select.css">
    <link rel="stylesheet" href="frontend/css/venobox.min.css">

    <link rel="stylesheet" href="frontend/css/jquery.exzoom.css">

    <link rel="stylesheet" href="frontend/css/style.css">
    <link rel="stylesheet" href="frontend/css/responsive.css">

    <!-- <link rel="stylesheet" href="frontend/css/rtl.css"> -->
</head>

<body>
    <div id="premiumLoader" class="premiumLoader d-none">
        <span class="loader"></span>
    </div>

    <!--hader tiwth header top bar-->

    <!--=============================
        TOPBAR END
    ==============================-->
    <section class="fp__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8">
                    <ul class="fp__topbar_info d-flex flex-wrap">
                        <li><a><i class="fas fa-envelope"></i>
                                FoodPark</a>
                        </li>
                        <li><a><i class="fas fa-phone-alt"></i>
                                FoodPark</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-md-4 d-none d-md-block">
                    <ul class="topbar_icon d-flex flex-wrap">
                        <li><a><i class="fab fa-facebook-f"></i></a> </li>
                        <li><a><i class="fab fa-twitter"></i></a> </li>
                        <li><a><i class="fab fa-linkedin-in"></i></a> </li>
                        <li><a><i class="fab fa-behance"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        MENU START
    ==============================-->
    @include('frontend.layouts.menu')
    <!--bootstrap js-->

    @yield('content')
    <!-- slick slider -->
    @include('frontend.layouts.footer')
    <!-- isotop js -->

    <!-- simplyCountdownjs -->

    <!-- counter up js -->

    <!-- nice select js -->

    <!-- venobox js -->

    <!-- sticky sidebar js -->

    <!-- wow js -->

    <!-- ex zoom js -->

    <!--main/custom js-->

</body>

</html>
