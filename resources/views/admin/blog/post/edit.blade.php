@extends('admin.layouts.master')
@section('title', 'Edit Blog Post')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Blog Post</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Article: {{ $post->title }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog-posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Thumbnail Image -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Post Image (Leave empty to keep current)</label>
                                        <input type="file" name="image" class="form-control" id="image-upload" accept="image/*">
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="image-preview" src="{{ asset($post->image) }}" alt="current" style="max-height: 150px; border-radius: 6px;">
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ (old('category_id', $post->category_id) == $cat->id) ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
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
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                                    @error('title')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description (Summernote) -->
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Full Content <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control summernote" rows="8" required>{{ old('description', $post->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- SEO Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $post->seo_title) }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Publish Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Publish</option>
                                            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- SEO Description -->
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">SEO Description</label>
                                    <textarea name="seo_description" class="form-control" rows="3">{{ old('seo_description', $post->seo_description) }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg">Update Article</button>
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
            });

            $('#image-upload').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endpush

