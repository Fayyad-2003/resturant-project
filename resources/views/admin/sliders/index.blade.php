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
        }

        .card-header .btn-primary:hover {
            background-color: #e0a503;
            border-color: #e0a503;
            color: #1b1b18;
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

        /* DataTable Customization */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-color: #e3e3e0;
            border-radius: 0.5rem;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
        }

        table.dataTable thead th {
            background-color: #f9f9f9;
            color: #1b1b18;
            font-weight: 600;
            border-bottom: 2px solid #F8B803;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9f9f9;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #1b1b18 !important;
            border-color: #1b1b18 !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #F8B803 !important;
            border-color: #F8B803 !important;
            color: #1b1b18 !important;
        }

        .btn-danger {
            background-color: #F53003;
            border-color: #F53003;
        }

        .btn-danger:hover {
            background-color: #d42a03;
            border-color: #d42a03;
        }

        .btn-warning {
            background-color: #F8B803;
            border-color: #F8B803;
            color: #1b1b18;
        }

        .btn-warning:hover {
            background-color: #e0a503;
            border-color: #e0a503;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Sliders</h1>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex items-center justify-content-between">
                            <h4 class="text-capitalize">List of Sliders</h4>
                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary text-capitalize">
                                <i class="far fa-check-circle"></i> Create Slider
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
        $('#slider-table').on('draw.dt', function() {
            $('#slider-table_processing').hide();
        });

        // Delete item confirmation using SweetAlert (delegated for dynamically loaded datatable rows)
        $(document).ready(function() {
            $('body').on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                swal("Deleted!", "Slider has been deleted.", "success");
                                $('#slider-table').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                swal("Error!", "Something went wrong.", "error");
                            }
                        });
                    } else {
                        swal("Your file is safe!");
                    }
                });
            });
        });
    </script>
@endpush
