@extends('admin.layouts.master')
@section('title', 'Edit Advertisement')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Advertisement Banner</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Edit: {{ $advertisement->title }}</h4>
                            <a href="{{ route('admin.advertisements.index') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> All Banners
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Banner Image Upload -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Banner Image</label>
                                        <input type="file" name="image" class="form-control" id="banner-image" accept="image/*">
                                        <small class="text-muted d-block">Leave blank if you don't want to change the current image.</small>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="banner-preview" src="{{ asset($advertisement->image) }}" alt="{{ $advertisement->title }}" style="max-height: 140px; border-radius: 8px;" class="shadow-sm border">
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Banner Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $advertisement->title) }}" required>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Target URL -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Target URL (Optional)</label>
                                        <input type="text" name="url" class="form-control" value="{{ old('url', $advertisement->url) }}">
                                        @error('url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $advertisement->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $advertisement->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Details / Description -->
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Offer Description / Subtext <span class="text-danger">*</span></label>
                                        <textarea name="details" class="form-control" rows="3" required>{{ old('details', $advertisement->details) }}</textarea>
                                        @error('details')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Update Banner
                                    </button>
                                    <a href="{{ route('admin.advertisements.index') }}" class="btn btn-secondary px-4 py-2 ms-2">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('banner-image').addEventListener('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(event) {
                let preview = document.getElementById('banner-preview');
                preview.src = event.target.result;
            }
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush

