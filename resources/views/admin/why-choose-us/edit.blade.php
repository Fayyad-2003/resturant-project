@extends('admin.layouts.master')

@push('styles')
    <style>
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

        /* Icon Picker Positioning Fix */
        .icon-picker-wrapper {
            position: relative;
            display: inline-block;
            width: auto;
        }

        /* Override iconpicker styles to center it properly */
        .iconpicker-popover.popover {
            position: fixed !important;
            z-index: 9999 !important;
            max-width: 600px !important;
            width: 90% !important;
            max-width: 600px !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            margin: 0 !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
        }

        .iconpicker-popover .popover-title {
            background-color: #1b1b18 !important;
            color: #EDEDEC !important;
            border-bottom: 2px solid #F8B803 !important;
            padding: 12px 15px !important;
        }

        .iconpicker-popover .popover-content {
            max-height: 400px !important;
            overflow-y: auto !important;
            padding: 15px !important;
        }

        /* Add backdrop */
        .iconpicker-popover.popover.show::before {
            content: '' !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            background: rgba(0, 0, 0, 0.5) !important;
            z-index: -1 !important;
            display: block !important;
        }

        /* Ensure button is visible */
        #icon-picker-btn {
            z-index: 1 !important;
        }

        .current-icon-display {
            font-size: 60px;
            text-align: center;
            padding: 20px;
            border: 2px solid #e3e3e0;
            border-radius: 0.5rem;
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="text-capitalize">Edit Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.why-choose-us.index') }}">Items</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.why-choose-us.update', $item->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="text-capitalize">Edit Information</h4>
                                <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-primary text-capitalize">
                                    <i class="fas fa-list-alt"></i> All Items
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <!-- Icon -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon">Icon <span class="text-danger">*</span></label>
                                            <br>
                                            <div class="current-icon-display mb-3">
                                                <i class="{{ $item->icon }}" id="current-icon-preview"></i>
                                            </div>
                                            <div class="icon-picker-wrapper">
                                                <button type="button" class="btn btn-secondary" id="icon-picker-btn"
                                                    data-iconpicker-input="input#icon-input"
                                                    data-icon="{{ old('icon', $item->icon) }}" role="iconpicker"></button>
                                                <input type="hidden" id="icon-input" name="icon"
                                                    value="{{ old('icon', $item->icon) }}" />
                                            </div>
                                            @error('icon')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title', $item->title) }}" placeholder="Enter item title" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror" rows="3"
                                                placeholder="Enter a brief description">{{ old('short_description', $item->short_description) }}</textarea>
                                            @error('short_description')
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
                                                <option value="1" {{ old('status', $item->status) == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ old('status', $item->status) == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-check-circle"></i> Update
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
            // Initialize icon picker with proper container
            var iconPickerInstance = $('#icon-picker-btn').iconpicker({
                align: 'center',
                arrowClass: 'btn-primary',
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                cols: 10,
                footer: true,
                header: true,
                icon: '{{ old('icon', $item->icon) }}',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom',
                rows: 5,
                search: true,
                searchText: 'Search icon',
                selectedClass: 'btn-success',
                unselectedClass: '',
                container: false
            }).on('change', function(e) {
                // Update hidden input when icon changes
                $('#icon-input').val(e.icon);
                // Update preview icon
                $('#current-icon-preview').attr('class', e.icon);
            });

            // Fix positioning after popover is shown
            $('#icon-picker-btn').on('shown.bs.popover', function() {
                var popover = $('.iconpicker-popover');
                if (popover.length) {
                    // Force fixed positioning and center it
                    popover.css({
                        'position': 'fixed',
                        'top': '50%',
                        'left': '50%',
                        'transform': 'translate(-50%, -50%)',
                        'z-index': '9999',
                        'max-width': '600px',
                        'width': '90%'
                    });

                    // Add backdrop
                    if (!$('.iconpicker-backdrop').length) {
                        $('body').append(
                            '<div class="iconpicker-backdrop" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9998;"></div>'
                        );

                        // Close on backdrop click
                        $('.iconpicker-backdrop').on('click', function() {
                            $('#icon-picker-btn').iconpicker('hide');
                        });
                    }
                }
            });

            // Remove backdrop when hidden
            $('#icon-picker-btn').on('hidden.bs.popover', function() {
                $('.iconpicker-backdrop').remove();
            });

            // Form validation feedback
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Updating...');
            });
        });
    </script>
@endpush
