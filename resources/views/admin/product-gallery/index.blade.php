@extends('admin.layouts.master')

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

        .btn-primary {
            background-color: #F8B803;
            border-color: #F8B803;
            color: #1b1b18;
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e0a503;
            border-color: #e0a503;
            color: #1b1b18;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(248, 184, 3, 0.3);
        }

        .btn-danger {
            background-color: #F53003;
            border-color: #F53003;
            color: white;
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d42a03;
            border-color: #d42a03;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 48, 3, 0.4);
        }

        .table {
            margin-top: 1rem;
        }

        .table thead th {
            background-color: #f9f9f9;
            color: #1b1b18;
            font-weight: 600;
            border-bottom: 2px solid #F8B803;
            padding: 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #fffbf0;
        }

        .table img {
            border-radius: 0.5rem;
            border: 2px solid #e3e3e0;
            transition: all 0.3s ease;
        }

        .table img:hover {
            transform: scale(1.05);
            border-color: #F8B803;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border: 1px solid #e3e3e0;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
        }

        .alert {
            border-radius: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">{{ $product->name }} - Product Gallery</h1>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- Upload Form Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-cloud-upload-alt"></i> Upload New Image</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-gallery.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="image">Select Image <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                   name="image" id="image" accept="image/*" required>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle"></i> Max file size: 2MB. Supported formats: JPG, PNG, GIF, WebP
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <div class="form-group mb-0 w-100">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-upload"></i> Upload Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Gallery Images Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-images"></i> Gallery Images ({{ count($images) }})</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">#</th>
                                            <th>Image Preview</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($images as $index => $image)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>
                                                    <img width="150" height="100" 
                                                         src="{{ asset($image->src) }}" 
                                                         alt="Product Gallery Image"
                                                         style="object-fit: cover;">
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.product-gallery.destroy', $image->id) }}"
                                                       class='btn btn-danger delete-gallery-btn' 
                                                       title='Delete Image'>
                                                        <i class='fas fa-trash'></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    <i class="fas fa-image fa-3x mb-3 d-block" style="opacity: 0.3;"></i>
                                                    <p class="mb-0">No images uploaded yet. Upload your first image above!</p>
                                                </td>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            // Delete gallery image with AJAX
            $('body').on('click', '.delete-gallery-btn', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this image!",
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
                            text: "Please wait while we delete the image.",
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
                                        text: response.message || "Image has been deleted successfully.",
                                        icon: "success",
                                        button: "OK",
                                    }).then(() => {
                                        // Reload page to refresh gallery
                                        window.location.reload();
                                    });
                                } else {
                                    swal("Error!", response.message || "Failed to delete image.", "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                let errorMessage = "Something went wrong while deleting the image.";

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
