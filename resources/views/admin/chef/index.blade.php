@extends('admin.layouts.master')
@section('title', 'Manage Chefs')

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
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Our Chefs / Team</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">All Chefs & Culinary Masters</h4>
                            <a href="{{ route('admin.chefs.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Chef
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-chefs" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Social Links</th>
                                            <th>Show At Home</th>
                                            <th>Status</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($chefs as $key => $chef)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($chef->image) }}" alt="{{ $chef->name }}"
                                                         class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td class="fw-bold">{{ $chef->name }}</td>
                                                <td><span class="badge badge-light border">{{ $chef->designation }}</span></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        @if($chef->facebook)
                                                            <a href="{{ $chef->facebook }}" target="_blank" class="btn btn-sm btn-outline-primary p-1"><i class="fab fa-facebook-f"></i></a>
                                                        @endif
                                                        @if($chef->instagram)
                                                            <a href="{{ $chef->instagram }}" target="_blank" class="btn btn-sm btn-outline-danger p-1"><i class="fab fa-instagram"></i></a>
                                                        @endif
                                                        @if($chef->twitter)
                                                            <a href="{{ $chef->twitter }}" target="_blank" class="btn btn-sm btn-outline-info p-1"><i class="fab fa-twitter"></i></a>
                                                        @endif
                                                        @if($chef->behance)
                                                            <a href="{{ $chef->behance }}" target="_blank" class="btn btn-sm btn-outline-dark p-1"><i class="fab fa-behance"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($chef->show_at_home)
                                                        <span class="badge badge-success"><i class="fas fa-check"></i> Yes</span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($chef->status)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.chefs.edit', $chef->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.chefs.destroy', $chef->id) }}" class="btn btn-sm btn-danger delete-item">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">No chefs added yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#table-chefs').DataTable();

            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire('Deleted!', response.message, 'success').then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush

