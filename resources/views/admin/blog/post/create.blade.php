@extends('admin.layouts.master')
@section('title', 'Write Blog Post')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .image-preview {
            width: 100%;
            height: 250px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            border: 2px dashed #e3e3e0;
            border-radius: 0.75rem;
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create New Blog Post</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Write Blog Article</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Thumbnail Image -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Post Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control" id="image-upload" required accept="image/*">
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="image-preview" src="{{ asset('admin/assets/img/news/img01.jpg') }}" alt="preview" style="max-height: 150px; border-radius: 6px; display: none;">
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter catchy title" required>
                                    @error('title')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description (Summernote) -->
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Full Content <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control summernote" rows="8" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- SEO Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}" placeholder="SEO Meta Title">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Publish Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="1">Publish</option>
                                            <option value="0">Draft</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- SEO Description -->
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">SEO Description</label>
                                    <textarea name="seo_description" class="form-control" rows="3" placeholder="Brief summary for search engines">{{ old('seo_description') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg">Publish Article</button>
                                <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250,
                placeholder: 'Write your post content here...'
            });

            $('#image-upload').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endpush

