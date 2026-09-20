@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Sliders</h1>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-danger">

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
    <script src="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        // Delete item confirmation using SweetAlert (delegated for dynamically loaded datatable rows)
        $(document).ready(function () {
            $('body').on('click', '.delete_btn', function (e) {
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
                            success: function (response) {
                                swal("Deleted!", "Slider has been deleted.", "success");
                                $('#slider-table').DataTable().ajax.reload();
                            },
                            error: function (xhr, status, error) {
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