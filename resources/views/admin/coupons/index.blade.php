@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .card {
            border: 1px solid #e3e3e0;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1b1b18;
            color: #EDEDEC;
            border-bottom: 2px solid #F8B803;
            border-radius: 0.75rem 0.75rem 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            color: #EDEDEC;
        }

        .card-header .btn-primary {
            background-color: #F8B803;
            border-color: #F8B803;
            color: #1b1b18;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .card-header .btn-primary:hover {
            background-color: #e0a503;
            border-color: #e0a503;
            color: #1b1b18;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(248, 184, 3, 0.3);
        }

        .card-body {
            padding: 1.5rem;
        }

        .section-header {
            margin-bottom: 2rem;
        }

        .section-header h1 {
            font-weight: 700;
            color: #1b1b18;
            font-size: 1.875rem;
        }

        /* Enhanced Action Buttons */
        table.dataTable .btn {
            border-radius: 0.5rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        table.dataTable .btn-warning {
            background-color: #F8B803;
            border-color: #F8B803;
            color: #1b1b18;
        }

        table.dataTable .btn-warning:hover {
            background-color: #e0a503;
            border-color: #e0a503;
            color: #1b1b18;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(248, 184, 3, 0.4);
        }

        table.dataTable .btn-danger {
            background-color: #F53003;
            border-color: #F53003;
            color: #ffffff;
        }

        table.dataTable .btn-danger:hover {
            background-color: #d42a03;
            border-color: #d42a03;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(245, 48, 3, 0.4);
        }

        table.dataTable tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        table.dataTable tbody tr {
            transition: all 0.2s ease;
        }

        table.dataTable tbody tr:hover {
            background-color: #fffbf0;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Coupons</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Coupons</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex items-center justify-content-between">
                            <h4 class="text-capitalize">All Coupons</h4>
                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary text-capitalize">
                                <i class="fas fa-plus"></i> Create Coupon
                            </a>
                        </div>

                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{ $dataTable->scripts() }}

    <script>
        // Ensure processing indicator hides cleanly once table draws
        $('#coupon-table').on('draw.dt', function() {
            $('#coupon-table_processing').hide();
        });

        // Delete item confirmation using SweetAlert (delegated for dynamically loaded datatable rows)
        $(document).ready(function() {
            $('body').on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this coupon!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    swal('Success', response.message, 'success');
                                    $('#coupon-table').DataTable().draw();
                                } else {
                                    swal('Error', response.message, 'error');
                                }
                            },
                            error: function(xhr, status, error) {
                                swal('Error', 'Something went wrong!', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
