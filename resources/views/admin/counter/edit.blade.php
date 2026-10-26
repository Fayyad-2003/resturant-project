@extends('admin.layouts.master')
@section('title', 'Edit Counter')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Counter Statistic</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Edit: {{ $counter->title }}</h4>
                            <a href="{{ route('admin.counters.index') }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> All Counters
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.counters.update', $counter->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Icon Input with Live Preview -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">FontAwesome Icon Class <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i id="icon-preview" class="{{ $counter->icon }} fa-lg text-warning"></i>
                                            </span>
                                            <input type="text" name="icon" id="icon-input" class="form-control" value="{{ old('icon', $counter->icon) }}" required>
                                        </div>
                                        <small class="text-muted">Use standard FontAwesome icons (e.g. <code>fas fa-utensils</code>, <code>fas fa-users</code>, <code>fas fa-calendar-alt</code>, <code>fas fa-trophy</code>).</small>
                                        @error('icon')
                                            <span class="text-danger small d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Number -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Counter Number / Count <span class="text-danger">*</span></label>
                                        <input type="text" name="number" class="form-control" value="{{ old('number', $counter->number) }}" required>
                                        @error('number')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Title / Label <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $counter->title) }}" required>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $counter->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $counter->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Update Counter
                                    </button>
                                    <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary px-4 py-2 ms-2">Cancel</a>
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
        document.getElementById('icon-input').addEventListener('input', function() {
            let iconClass = this.value.trim();
            let preview = document.getElementById('icon-preview');
            preview.className = iconClass + ' fa-lg text-warning';
        });
    </script>
@endpush

