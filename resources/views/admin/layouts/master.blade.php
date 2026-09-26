<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Park | Admin Dashboard</title>

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/nprogress.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/bootstrap-iconpicker.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/components.css">

    @stack('styles')
</head>

<body class="min-h-screen bg-[#FDFDFC] dark:bg-[#161615]">
    <div class="admin-wrapper">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="admin-main-content">
            @yield('content')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/js/nprogress.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="{{ asset('admin/assets/js/page/modules-toastr.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('admin') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('admin') }}/assets/js/custom.js"></script>

    <script>
        if (typeof toastr !== 'undefined') {
            toastr.options.progressBar = true;
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        } else if (typeof iziToast !== 'undefined') {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    iziToast.error({
                        title: 'Error',
                        message: "{{ $error }}",
                        position: 'topRight'
                    });
                @endforeach
            @endif
        }
    </script>

    <!-- Sidebar Dropdown Script -->
    <script>
        // Use jQuery for better compatibility since it's already loaded
        $(document).ready(function() {
            console.log('jQuery Sidebar dropdown script loaded');

            // Handle dropdown clicks
            $('.sidebar-menu li.has-dropdown > a.has-dropdown').on('click', function(e) {
                e.preventDefault();
                console.log('Dropdown clicked');

                var $this = $(this);
                var $parentLi = $this.parent('li.has-dropdown');
                var $dropdownMenu = $parentLi.find('.dropdown-menu');

                console.log('Parent:', $parentLi);
                console.log('Menu:', $dropdownMenu);

                // Close all other dropdowns
                $('.sidebar-menu li.has-dropdown').not($parentLi).each(function() {
                    $(this).find('a.has-dropdown').removeClass('active');
                    $(this).find('.dropdown-menu').removeClass('show');
                });

                // Toggle current dropdown
                $this.toggleClass('active');
                $dropdownMenu.toggleClass('show');

                console.log('Toggled - Has show class:', $dropdownMenu.hasClass('show'));
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
