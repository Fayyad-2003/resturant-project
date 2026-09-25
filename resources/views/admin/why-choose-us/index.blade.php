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

        /* Enhanced Action Buttons */
        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            font-size: 0.7rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn i {
            font-size: 0.875rem;
        }

        .btn-warning {
            font-weight: 600;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(248, 184, 3, 0.4);
        }

        .btn-danger {
            font-weight: 600;
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 48, 3, 0.4);
        }

        .d-flex.gap-2 {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        /* Enhanced Badge Styles */
        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background-color: #10B981;
            color: white;
        }

        .badge-secondary {
            background-color: #6B7280;
            color: white;
        }

        /* Enhanced Image Styling */
        table.dataTable img {
            transition: all 0.3s ease;
            border: 2px solid #e3e3e0;
        }

        table.dataTable tbody tr:hover img {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-color: #F8B803;
        }

        /* Enhanced Table Styles */
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0;
        }

        table.dataTable thead th {
            padding: 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            transform: scale(1.002);
        }

        /* DataTable Info and Controls */
        .dataTables_info {
            color: #706f6c;
            font-size: 0.875rem;
        }

        .dataTables_length label {
            color: #706f6c;
            font-size: 0.875rem;
        }

        .dataTables_filter label {
            color: #1b1b18;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            padding: 0.375rem 0.75rem;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.5rem;
            margin: 0 2px;
        }

        .card-header .btn-primary {
            transition: all 0.3s ease;
        }

        .card-header .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(248, 184, 3, 0.3);
        }

        /* Accordion Styles */
        .accordion {
            margin-bottom: 1.5rem;
        }

        .accordion-header {
            cursor: pointer;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background-color: #1b1b18 !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .accordion-header:hover {
            background-color: #000 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(27, 27, 24, 0.3);
        }

        .accordion-header h4 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .accordion-header::after {
            content: '\f078';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            transition: transform 0.3s ease;
            margin-left: auto;
        }

        .accordion-header:not(.collapsed)::after {
            transform: rotate(180deg);
        }

        .accordion-body {
            padding: 1.5rem;
            border: 1px solid #e3e3e0;
            border-top: none;
            border-radius: 0 0 0.5rem 0.5rem;
            background-color: #ffffff;
        }

        .accordion-body.show {
            display: block !important;
        }

        .accordion-body .form-group {
            opacity: 1 !important;
            visibility: visible !important;
        }

        .accordion-body .form-group label {
            font-weight: 600;
            color: #1b1b18;
            margin-bottom: 0.5rem;
        }

        .accordion-body .form-control {
            border-color: #e3e3e0;
            border-radius: 0.5rem;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .accordion-body .form-control:focus {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
        }

        .accordion-body .btn-primary {
            background-color: #1b1b18;
            border-color: #1b1b18;
            color: #EDEDEC;
            font-weight: 600;
            padding: 0.625rem 1.5rem;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .accordion-body .btn-primary:hover {
            background-color: #000;
            border-color: #000;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Fix for Bootstrap collapse animation */
        .collapsing {
            transition: height 0.2s ease !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Why Choose Us</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="accordion">
                    <div class="accordion">
                        <div class="accordion-header collapsed bg-primary text-light p-3" role="button"
                            data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
                            <h4>Why Choose Us Section Title</h4>
                        </div>

                        <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                            <form action="{{ route('admin.update-why-choose-us-titles') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="why_choose_us_top_title">Top Title</label>
                                    <input type="text" name="why_choose_us_top_title" id="why_choose_us_top_title"
                                        class="form-control" value="{{ $sectionTitles['why_choose_us_top_title'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="why_choose_us_main_title">Main Title</label>
                                    <input type="text" name="why_choose_us_main_title" id="why_choose_us_main_title"
                                        class="form-control" value="{{ $sectionTitles['why_choose_us_main_title'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="why_choose_us_sub_title">Sub Title</label>
                                    <textarea name="why_choose_us_sub_title" id="why_choose_us_sub_title" class="form-control" rows="3">{{ $sectionTitles['why_choose_us_sub_title'] ?? '' }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Section Titles
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex items-center justify-content-between">
                            <h4 class="text-capitalize">List of Items</h4>
                            <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary text-capitalize">
                                <i class="far fa-check-circle"></i> Create New
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
        // Fix accordion content visibility
        $(document).ready(function() {
            // Ensure inputs are visible when accordion opens
            $('.accordion-header').on('click', function() {
                var target = $(this).data('target');
                $(target).find('.form-control, .btn').css({
                    'opacity': '1',
                    'visibility': 'visible'
                });
            });

            // Also handle Bootstrap collapse events
            $('.accordion-body').on('show.bs.collapse', function() {
                $(this).find('.form-control, .btn, .form-group').css({
                    'opacity': '1',
                    'visibility': 'visible',
                    'display': 'block'
                });
            });
        });

        // Ensure processing indicator hides cleanly once table draws
        $('#why-choose-us-table').on('draw.dt', function() {
            $('#why-choose-us-table_processing').hide();
        });

        // Delete item confirmation using SweetAlert (delegated for dynamically loaded datatable rows)
        $(document).ready(function() {
            $('body').on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this item!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn-secondary",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            value: true,
                            visible: true,
                            className: "btn-danger",
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        // Show loading state
                        swal({
                            title: "Deleting...",
                            text: "Please wait while we delete the item.",
                            icon: "info",
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });

                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    swal({
                                        title: "Deleted!",
                                        text: response.message ||
                                            "Item has been deleted successfully.",
                                        icon: "success",
                                        button: "OK",
                                    }).then(() => {
                                        $('#why-choose-us-table').DataTable()
                                            .ajax
                                            .reload();
                                    });
                                } else {
                                    swal("Error!", response.message ||
                                        "Failed to delete item.", "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                let errorMessage =
                                    "Something went wrong while deleting the item.";

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                swal("Error!", errorMessage, "error");
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        /* SweetAlert Custom Styling */
        .swal-button--confirm {
            background-color: #F53003 !important;
        }

        .swal-button--confirm:hover {
            background-color: #d42a03 !important;
        }

        .swal-button--cancel {
            background-color: #3E3E3A !important;
            color: #EDEDEC !important;
        }

        .swal-button--cancel:hover {
            background-color: #1b1b18 !important;
        }

        .swal-modal {
            border-radius: 0.75rem;
        }

        .swal-title {
            color: #1b1b18;
            font-weight: 700;
        }

        .swal-text {
            color: #706f6c;
        }

        .swal-icon--warning {
            border-color: #F8B803;
        }

        .swal-icon--warning__body,
        .swal-icon--warning__dot {
            background-color: #F8B803;
        }

        .swal-icon--success__ring {
            border-color: #10B981;
        }

        .swal-icon--success__line {
            background-color: #10B981;
        }

        .swal-icon--error {
            border-color: #F53003;
        }

        .swal-icon--error__line {
            background-color: #F53003;
        }
    </style>
@endpush
