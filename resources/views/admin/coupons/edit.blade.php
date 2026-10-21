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
            transition: all 0.3s ease;
        }

        .card-header .btn-primary:hover {
            background-color: #e0a503;
            border-color: #e0a503;
            color: #1b1b18;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(248, 184, 3, 0.3);
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
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Coupon</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Edit Coupon: {{ $coupon->name }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Back to Coupons
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="name">Coupon Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $coupon->name) }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="code">Coupon Code <span class="text-danger">*</span></label>
                                        <input type="text" name="code" id="code" class="form-control"
                                            value="{{ old('code', $coupon->code) }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="quantity">Quantity (Usage Limit) <span class="text-danger">*</span></label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            value="{{ old('quantity', $coupon->quantity) }}" min="1" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="min_purchase_amount">Minimum Purchase Amount ($) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="min_purchase_amount" id="min_purchase_amount" class="form-control"
                                            value="{{ old('min_purchase_amount', $coupon->min_purchase_amount) }}" min="0" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="expire_date">Expire Date <span class="text-danger">*</span></label>
                                        <input type="date" name="expire_date" id="expire_date" class="form-control"
                                            value="{{ old('expire_date', $coupon->expire_date) }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="discount_type">Discount Type <span class="text-danger">*</span></label>
                                        <select name="discount_type" id="discount_type" class="form-control" required>
                                            <option value="percent" {{ old('discount_type', $coupon->discount_type) === 'percent' ? 'selected' : '' }}>
                                                Percentage (%)
                                            </option>
                                            <option value="amount" {{ old('discount_type', $coupon->discount_type) === 'amount' ? 'selected' : '' }}>
                                                Fixed Amount ($)
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="discount">Discount Value <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="discount" id="discount" class="form-control"
                                            value="{{ old('discount', $coupon->discount) }}" min="0" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="active" {{ old('status', $coupon->status) === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="deactive" {{ old('status', $coupon->status) === 'deactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-left">
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-check-circle"></i> Update Coupon
                                </button>
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary ml-2">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
