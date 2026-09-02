<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Park | Admin Dashboard</title>

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/nprogress.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/izitoast/css/iziToast.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/components.css">
</head>

<body class="min-h-screen bg-[#FDFDFC] dark:bg-[#161615]">
    <div class="admin-wrapper">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="admin-main-content">
            @yield('content')

            <!-- Footer -->
            <footer class="mt-16 pt-8 pb-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <div class="flex justify-between items-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    <div>
                        Copyright &copy; {{ date('Y') }} Food Park &bullet; Design By Mehedi Hassan Jibon
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/modules/popper.js"></script>
    <script src="{{ asset('admin') }}/assets/modules/tooltip.js"></script>
    <script src="{{ asset('admin') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/js/nprogress.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/page/modules-toastr.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('admin') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('admin') }}/assets/js/custom.js"></script>

    <script>
        toastr.options.progressBar = true;

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
</body>

</html>
