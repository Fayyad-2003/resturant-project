<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Park | Admin Dashboard</title>

    <!-- Vite Assets -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

    <!-- Scripts -->
    <script src="{{ asset('admin/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/page/modules-datatables.js') }}"></script>

</body>

</html>
