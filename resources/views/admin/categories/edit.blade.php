@extends('admin.layouts.master')

@push('styles')
    <style>
        .image-preview {
            width: 100%;
            height: 300px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            border: 2px dashed #e3e3e0;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .image-preview:hover {
            border-color: #F8B803;
        }

        .image-preview.has-image {
            border-style: solid;
            border-color: #F8B803;
        }

        .image-preview label {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #706f6c;
            font-weight: 500;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .image-preview:hover label {
            color: #F8B803;
            background-color: rgba(248, 249, 250, 0.95);
        }

        .image-preview.has-image label {
            background-color: rgba(27, 27, 24, 0.5);
            color: #ffffff;
            opacity: 0;
        }

        .image-preview.has-image:hover label {
            opacity: 1;
            background-color: rgba(27, 27, 24, 0.7);
        }

        .image-preview input[type="file"] {
            display: none;
        }

        .image-preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .image-preview.has-image .image-preview-img {
            display: block;
        }

        .form-group label {
            font-weight: 600;
            color: #1b1b18;
            margin-bottom: 8px;
        }

        .form-control:focus {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
        }

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
            padding: 2rem 1.5rem;
        }

        .card-footer {
            background-color: #f9f9f9;
            border-top: 1px solid #e3e3e0;
            border-radius: 0 0 0.75rem 0.75rem;
            padding: 1.25rem 1.5rem;
        }

        .btn-primary {
            background-color: #1b1b18;
            border-color: #1b1b18;
            color: #EDEDEC;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

        .btn-secondary {
            background-color: #3E3E3A;
            border-color: #3E3E3A;
            color: #EDEDEC;
        }

        .btn-secondary:hover {
            background-color: #1b1b18;
            border-color: #1b1b18;
        }

        .section-header {
            margin-bottom: 2rem;
        }

        .section-header h1 {
            font-weight: 700;
            color: #1b1b18;
            font-size: 1.875rem;
        }

        .section-header-breadcrumb {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .breadcrumb-item {
            color: #706f6c;
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: #1b1b18;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .breadcrumb-item a:hover {
            color: #F8B803;
        }

        .breadcrumb-item.active {
            color: #F8B803;
            font-weight: 500;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: "/";
            margin-left: 0.5rem;
            color: #A1A09A;
        }

        .text-danger {
            color: #F53003 !important;
        }

        small.text-muted {
            color: #706f6c !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Edit Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="text-capitalize">Category Information</h4>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary text-capitalize">
                                    <i class="fas fa-list-alt"></i> All Categories
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Show at Home -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="show_at_home">Show at Home</label>
                                            <div class="custom-control custom-checkbox mt-2">
                                                <input type="checkbox" class="custom-control-input" name="show_at_home"
                                                    id="show_at_home" value="1"
                                                    {{ old('show_at_home', $category->show_at_home) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="show_at_home">
                                                    Display on homepage
                                                </label>
                                            </div>
                                            @error('show_at_home')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Display current slug -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <strong>Current Slug:</strong> <code>{{ $category->slug }}</code>
                                            <small class="d-block mt-1">The slug will be automatically updated based on the name.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-check-circle"></i> Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Form validation feedback
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Updating...');
            });

            // Live slug preview when name changes
            $('#name').on('input', function() {
                const slug = $(this).val()
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                
                $('.alert-info code').text(slug || '{{ $category->slug }}');
            });
        });
    </script>
@endpush
