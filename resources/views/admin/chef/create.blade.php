@extends('admin.layouts.master')
@section('title', 'Add New Chef')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Chef</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Chef Information</h4>
                            <a href="{{ route('admin.chefs.index') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> All Chefs
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.chefs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Photo Upload -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Chef Photo <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control" id="chef-photo" required accept="image/*">
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="photo-preview" src="" alt="preview" style="max-height: 140px; border-radius: 8px; display: none;" class="shadow-sm border">
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Chef Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Sima Ahmed" required>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Designation / Speciality <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Executive Chef, Pastry Artist" required>
                                        @error('designation')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Show At Home -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Show At Homepage <span class="text-danger">*</span></label>
                                        <select name="show_at_home" class="form-control">
                                            <option value="1" {{ old('show_at_home', 1) == 1 ? 'selected' : '' }}>Yes (Show)</option>
                                            <option value="0" {{ old('show_at_home') === '0' ? 'selected' : '' }}>No (Hide)</option>
                                        </select>
                                        @error('show_at_home')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-3 mb-2">
                                        <h5 class="text-secondary border-bottom pb-2"><i class="fas fa-share-alt me-1"></i> Social Profiles (Optional)</h5>
                                    </div>

                                    <!-- Facebook -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fab fa-facebook text-primary me-1"></i> Facebook URL</label>
                                        <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}" placeholder="https://facebook.com/username">
                                        @error('facebook')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Instagram -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fab fa-instagram text-danger me-1"></i> Instagram URL</label>
                                        <input type="url" name="instagram" class="form-control" value="{{ old('instagram') }}" placeholder="https://instagram.com/username">
                                        @error('instagram')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Twitter -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fab fa-twitter text-info me-1"></i> Twitter / X URL</label>
                                        <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}" placeholder="https://x.com/username">
                                        @error('twitter')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Behance -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><i class="fab fa-behance text-dark me-1"></i> Behance / Portfolio URL</label>
                                        <input type="url" name="behance" class="form-control" value="{{ old('behance') }}" placeholder="https://behance.net/username">
                                        @error('behance')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Save Chef
                                    </button>
                                    <a href="{{ route('admin.chefs.index') }}" class="btn btn-secondary px-4 py-2 ms-2">Cancel</a>
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
        document.getElementById('chef-photo').addEventListener('change', function(e) {
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

