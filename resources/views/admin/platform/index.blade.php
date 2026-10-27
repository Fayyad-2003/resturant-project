@extends('admin.layouts.master')
@section('title', 'Mobile App Platforms')

@push('styles')
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

        .platform-icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #1b1b18;
            color: #F8B803;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mobile App Platforms</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">Download App Store Buttons</h4>
                            <a href="{{ route('admin.platforms.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Add New Platform
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Icon</th>
                                            <th>Small Title</th>
                                            <th>Store Heading</th>
                                            <th>Target URL</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($platforms as $platform)
                                            <tr id="row-{{ $platform->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="platform-icon-circle">
                                                        <i class="{{ $platform->icon }}"></i>
                                                    </span>
                                                </td>
                                                <td>{{ $platform->title }}</td>
                                                <td><strong>{{ $platform->heading }}</strong></td>
                                                <td>
                                                    <a href="{{ $platform->url }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                                        {{ $platform->url }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-status"
                                                            id="status-{{ $platform->id }}"
                                                            data-id="{{ $platform->id }}"
                                                            {{ $platform->status ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="status-{{ $platform->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.platforms.edit', $platform->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $platform->id }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">No app platforms created yet.</td>
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
    <script>
        $(document).ready(function() {
            // Toggle Status AJAX
            $('.toggle-status').on('change', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.platforms.toggle-status', ':id') }}".replace(':id', id);

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Failed to change status.');
                    }
                });
            });

            // Delete Platform
            $('.delete-btn').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.platforms.destroy', ':id') }}".replace(':id', id);

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
                                    $('#row-' + id).fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                    toastr.success(response.message);
                                }
                            },
                            error: function() {
                                toastr.error('Failed to delete platform.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush

