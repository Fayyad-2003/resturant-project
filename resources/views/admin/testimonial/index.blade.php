@extends('admin.layouts.master')
@section('title', 'Manage Customer Testimonials')

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
            <h1>Customer Testimonials & Reviews</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">All Reviews Submitted by Customers</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-testimonials" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Customer Name</th>
                                            <th>Designation</th>
                                            <th>Rating</th>
                                            <th>Feedback Message</th>
                                            <th>Status (Click to toggle)</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($testimonials as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($item->image ?: 'frontend/images/client_img_1.jpg') }}" alt="{{ $item->name }}"
                                                         class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td class="fw-bold">
                                                    {{ $item->name }}
                                                    @if($item->user)
                                                        <br><small class="text-muted"><i class="fas fa-check-circle text-success me-1"></i>{{ $item->user->email }}</small>
                                                    @else
                                                        <br><small class="text-muted"><i class="fas fa-user-tag text-info me-1"></i>Guest / Seeded</small>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-light border">{{ $item->designation ?: 'Customer' }}</span></td>
                                                <td>
                                                    <span class="text-warning">
                                                        @for($i=1; $i<=5; $i++)
                                                            @if($i <= $item->rating)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"></i>
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <b class="small ms-1">({{ $item->rating }}/5)</b>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-dark small" style="max-width: 300px; white-space: normal;">
                                                        {{ $item->details }}
                                                    </p>
                                                    <small class="text-muted">{{ $item->created_at->format('d M Y, h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" onclick="toggleStatus('{{ $item->id }}')" id="status-badge-{{ $item->id }}">
                                                        @if ($item->status)
                                                            <span class="badge badge-success"><i class="fas fa-check me-1"></i> Approved</span>
                                                        @else
                                                            <span class="badge badge-warning text-dark"><i class="fas fa-clock me-1"></i> Pending</span>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.testimonials.destroy', $item->id) }}" class="btn btn-sm btn-danger delete-item" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">No customer testimonials submitted yet.</td>
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
        function toggleStatus(id) {
            $.ajax({
                method: 'POST',
                url: "{{ url('admin/testimonials/toggle-status') }}/" + id,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === 'success') {
                        let badgeContainer = $('#status-badge-' + id);
                        if (response.new_status) {
                            badgeContainer.html('<span class="badge badge-success"><i class="fas fa-check me-1"></i> Approved</span>');
                        } else {
                            badgeContainer.html('<span class="badge badge-warning text-dark"><i class="fas fa-clock me-1"></i> Pending</span>');
                        }
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to toggle status.', 'error');
                }
            });
        }

        $(document).ready(function() {
            $('#table-testimonials').DataTable();

            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this testimonial deletion!",
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
