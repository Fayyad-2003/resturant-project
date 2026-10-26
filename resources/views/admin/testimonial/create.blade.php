@extends('admin.layouts.master')
@section('title', 'Add New Testimonial')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Customer Testimonial</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Client Review Details</h4>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> All Testimonials
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Photo Upload -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Customer Photo <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control" id="client-photo" required accept="image/*">
                                        <small class="text-muted d-block">Recommended size: 150x150px square image.</small>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="photo-preview" src="" alt="preview" style="max-height: 120px; border-radius: 50%; display: none;" class="shadow-sm border">
                                        </div>
                                    </div>

                                    <!-- Customer Name -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Customer Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Sarah Johnson" required>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Designation / Title <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Food Blogger, Regular Customer" required>
                                        @error('designation')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Star Rating <span class="text-danger">*</span></label>
                                        <select name="rating" class="form-control" required>
                                            <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars (⭐⭐⭐⭐⭐)</option>
                                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars (⭐⭐⭐⭐)</option>
                                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars (⭐⭐⭐)</option>
                                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars (⭐⭐)</option>
                                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star (⭐)</option>
                                        </select>
                                        @error('rating')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Details / Message -->
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Feedback Message / Review <span class="text-danger">*</span></label>
                                        <textarea name="details" class="form-control" rows="4" placeholder="Write the customer's testimonial quote here..." required>{{ old('details') }}</textarea>
                                        @error('details')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Save Testimonial
                                    </button>
                                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary px-4 py-2 ms-2">Cancel</a>
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
        document.getElementById('client-photo').addEventListener('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(event) {
                let preview = document.getElementById('photo-preview');
                preview.src = event.target.result;
                preview.style.display = 'block';
            }
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush

