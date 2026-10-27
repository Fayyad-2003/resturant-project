@extends('admin.layouts.master')
@section('title', 'Add New Mobile Platform')

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
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Mobile Platform</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">Add Store Platform Button</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.platforms.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Icon Class (FontAwesome)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i id="icon-preview" class="fab fa-google-play"></i></span>
                                        </div>
                                        <input type="text" name="icon" id="icon-input" class="form-control @error('icon') is-invalid @enderror"
                                            value="{{ old('icon', 'fab fa-google-play') }}" placeholder="e.g. fab fa-google-play or fab fa-apple" required>
                                    </div>
                                    <small class="text-muted">Examples: <code>fab fa-google-play</code>, <code>fab fa-apple</code>, <code>fab fa-windows</code></small>
                                    @error('icon')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Small Upper Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', 'Available on the') }}" placeholder="e.g. Available on the or Download on the" required>
                                    @error('title')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Store Heading</label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror"
                                        value="{{ old('heading', 'Google Play') }}" placeholder="e.g. Google Play or Apple Store" required>
                                    @error('heading')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Store Download URL</label>
                                    <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                                        value="{{ old('url', 'https://play.google.com') }}" placeholder="https://play.google.com/store/apps/details?id=...">
                                    @error('url')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('admin.platforms.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Save Platform</button>
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
    $('#icon-input').on('input', function() {
        $('#icon-preview').attr('class', $(this).val());
    });
</script>
@endpush

