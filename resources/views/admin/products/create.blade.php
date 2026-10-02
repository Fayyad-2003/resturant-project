@extends('admin.layouts.master')

@push('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

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

        .form-control:focus,
        .form-control:focus-visible {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
            outline: none;
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

        .section-divider {
            border-top: 2px solid #e3e3e0;
            margin: 2rem 0;
            padding-top: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1b1b18;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #F8B803;
            display: inline-block;
        }

        /* Summernote Custom Styling */
        .note-editor.note-frame {
            border: 1px solid #e3e3e0;
            border-radius: 0.5rem;
        }

        .note-editor.note-frame:focus-within {
            border-color: #F8B803;
            box-shadow: 0 0 0 0.2rem rgba(248, 184, 3, 0.25);
        }

        .note-toolbar {
            background-color: #f9f9f9;
            border-bottom: 1px solid #e3e3e0;
            padding: 10px;
        }

        .note-btn-group .note-btn {
            background-color: #fff;
            border: 1px solid #e3e3e0;
            color: #1b1b18;
        }

        .note-btn-group .note-btn:hover {
            background-color: #F8B803;
            border-color: #F8B803;
            color: #1b1b18;
        }

        .note-btn-group .note-btn.active {
            background-color: #1b1b18;
            border-color: #1b1b18;
            color: #fff;
        }

        .note-editable {
            background-color: #fff;
            color: #1b1b18;
            font-size: 14px;
            line-height: 1.6;
        }

        .note-editable:focus {
            background-color: #fff;
        }

        .note-status-output {
            display: none;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Create New Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></div>
                <div class="breadcrumb-item active">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="text-capitalize">Product Information</h4>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-primary text-capitalize">
                                    <i class="fas fa-list-alt"></i> All Products
                                </a>
                            </div>

                            <div class="card-body">
                                <!-- Main Product Image -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h5 class="section-title">Product Image</h5>
                                        <div class="form-group">
                                            <label for="image-upload">Main Product Image <span
                                                    class="text-danger">*</span></label>
                                            <div id="image-preview" class="image-preview">
                                                <img src="" alt="Preview" class="image-preview-img"
                                                    id="preview-img">
                                                <label for="image-upload" id="image-label">
                                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                                    <br>
                                                    Choose Image
                                                </label>
                                                <input type="file" name="main_image" id="image-upload" accept="image/*"
                                                    required>
                                            </div>
                                            @error('main_image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Recommended size: 800x800 pixels. Max
                                                size: 2MB</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Basic Information -->
                                <div class="section-divider">
                                    <h5 class="section-title">Basic Information</h5>
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="Enter product name" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                                <select name="category_id" id="category_id"
                                                    class="form-control @error('category_id') is-invalid @enderror"
                                                    required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="short_description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="short_description" id="short_description"
                                                    class="form-control @error('short_description') is-invalid @enderror" rows="3"
                                                    placeholder="Enter a brief description (max 200 characters)" required>{{ old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">This will be shown in product
                                                    listings</small>
                                            </div>
                                        </div>

                                        <!-- Long Description -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="long_description">Full Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="long_description" id="long_description"
                                                    class="form-control summernote @error('long_description') is-invalid @enderror"
                                                    placeholder="Enter detailed product description" required>{{ old('long_description') }}</textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">This will be shown on the product detail
                                                    page. You can format text, add images, links, etc.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing & Inventory -->
                                <div class="section-divider">
                                    <h5 class="section-title">Pricing & Inventory</h5>
                                    <div class="row">
                                        <!-- Price -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price">Regular Price <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" name="price" id="price" step="0.01"
                                                        min="0"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        value="{{ old('price') }}" placeholder="0.00" required>
                                                    @error('price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Offer Price -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="offer_price">Offer Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" name="offer_price" id="offer_price"
                                                        step="0.01" min="0"
                                                        class="form-control @error('offer_price') is-invalid @enderror"
                                                        value="{{ old('offer_price', 0) }}" placeholder="0.00">
                                                    @error('offer_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <small class="form-text text-muted">Leave 0 if no offer</small>
                                            </div>
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <input type="text" name="sku" id="sku"
                                                    class="form-control @error('sku') is-invalid @enderror"
                                                    value="{{ old('sku') }}" placeholder="e.g., PRD-1234">
                                                @error('sku')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Stock Keeping Unit (optional)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display Settings -->
                                <div class="section-divider">
                                    <h5 class="section-title">Display Settings</h5>
                                    <div class="row">
                                        <!-- Status -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status"
                                                    class="form-control @error('status') is-invalid @enderror" required>
                                                    <option value="1"
                                                        {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Show at Home -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="show_at_home">Show at Home</label>
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="show_at_home" id="show_at_home" value="1"
                                                        {{ old('show_at_home') ? 'checked' : '' }}>
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
                                </div>

                                <!-- SEO Settings -->
                                <div class="section-divider">
                                    <h5 class="section-title">SEO Settings (Optional)</h5>
                                    <div class="row">
                                        <!-- SEO Title -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="seo_title">SEO Title</label>
                                                <input type="text" name="seo_title" id="seo_title"
                                                    class="form-control @error('seo_title') is-invalid @enderror"
                                                    value="{{ old('seo_title') }}"
                                                    placeholder="SEO optimized title (60 characters max)">
                                                @error('seo_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Leave empty to use product name</small>
                                            </div>
                                        </div>

                                        <!-- SEO Description -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="seo_description">SEO Description</label>
                                                <textarea name="seo_description" id="seo_description"
                                                    class="form-control @error('seo_description') is-invalid @enderror" rows="3"
                                                    placeholder="SEO optimized description (160 characters max)">{{ old('seo_description') }}</textarea>
                                                @error('seo_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Leave empty to use short
                                                    description</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-check-circle"></i> Create Product
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
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 300,
                placeholder: 'Enter detailed product description with formatting...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '24', '28', '32', '36'],
                callbacks: {
                    onImageUpload: function(files) {
                        // Handle image upload via AJAX if needed
                        for (let i = 0; i < files.length; i++) {
                            uploadImageToServer(files[i], $(this));
                        }
                    }
                }
            });

            // Optional: Function to upload images to server
            function uploadImageToServer(file, editor) {
                let data = new FormData();
                data.append("image", file);
                data.append("_token", "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('admin.upload-image') }}", // You'll need to create this route
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(response) {
                        if (response.url) {
                            editor.summernote('insertImage', response.url);
                        }
                    },
                    error: function(data) {
                        console.log('Image upload failed');
                        // Fallback: insert as base64
                        let reader = new FileReader();
                        reader.onloadend = function() {
                            editor.summernote('insertImage', reader.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
            // Image upload preview with custom implementation
            $('#image-upload').on('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    // Validate file type
                    if (!file.type.match('image.*')) {
                        alert('Please select a valid image file.');
                        this.value = '';
                        return;
                    }

                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Image size should not exceed 2MB.');
                        this.value = '';
                        return;
                    }

                    // Create FileReader to read the image
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        // Set the image source
                        $('#preview-img').attr('src', event.target.result);

                        // Add the 'has-image' class to show preview
                        $('#image-preview').addClass('has-image');

                        // Update label text
                        $('#image-label').html(
                            '<i class="fas fa-sync-alt fa-2x mb-2"></i><br>Change Image');
                    };

                    // Read the file as Data URL
                    reader.readAsDataURL(file);
                }
            });

            // Validate offer price is less than regular price
            $('#offer_price').on('blur', function() {
                const price = parseFloat($('#price').val()) || 0;
                const offerPrice = parseFloat($(this).val()) || 0;

                if (offerPrice > 0 && offerPrice >= price) {
                    alert('Offer price must be less than regular price.');
                    $(this).val('0.00');
                }
            });

            // Form validation feedback
            $('form').on('submit', function(e) {
                // Sync Summernote content before submit
                $('.summernote').each(function() {
                    $(this).val($(this).summernote('code'));
                });

                // Validate that long description is not empty
                const longDesc = $('#long_description').summernote('code');
                const textOnly = $('<div>').html(longDesc).text().trim();

                if (!textOnly || textOnly === '') {
                    e.preventDefault();
                    alert('Please enter a full description for the product.');
                    return false;
                }

                $(this).find('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Creating...');
            });
        });
    </script>
@endpush
