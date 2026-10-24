@extends('admin.layouts.master')
@section('title', 'Order Details #' . $order->order_number)

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
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Order Details: #{{ $order->order_number }}</h1>
            <a href="{{ route('admin.orders.all') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>

        <div class="section-body">
            @php
                $division = DB::table('divisions')->where('id', $order->division_id)->first();
                $district = DB::table('districts')->where('id', $order->district_id)->first();
                $area = DB::table('upazilas')->where('id', $order->state_id)->first();
                $coupon = !empty($order->coupon_info) ? json_decode($order->coupon_info) : null;
            @endphp

            <div class="row">
                <!-- Order Info -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Order Summary</h4>
                            @if ($order->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif ($order->status === 'progress')
                                <span class="badge badge-info">In Process</span>
                            @elseif ($order->status === 'delivered')
                                <span class="badge badge-success">Delivered</span>
                            @else
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-md mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%">Invoice No:</th>
                                        <td>{{ $order->invoice_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order ID:</th>
                                        <td>#{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Products:</th>
                                        <td>{{ $order->orderDetails->sum('qty') }} item(s)</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Fee:</th>
                                        <td>{{ currencyPosition($division->delivery_fee ?? 0) }}</td>
                                    </tr>
                                    @if ($coupon)
                                        <tr>
                                            <th>Coupon ({{ $coupon->code }}):</th>
                                            <td class="text-success font-weight-bold">
                                                -{{ $coupon->discount_type === 'percent' ? $coupon->discount . '%' : currencyPosition($coupon->discount) }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Total Amount:</th>
                                        <td class="text-primary font-weight-bold fs-5">
                                            {{ currencyPosition($order->amount) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method:</th>
                                        <td class="text-capitalize">{{ $order->payment_method }}
                                            ({{ $order->payment_type }})</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date:</th>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    @if ($order->processing_date)
                                        <tr>
                                            <th>Processing Date:</th>
                                            <td>{{ \Carbon\Carbon::parse($order->processing_date)->format('d M Y, h:i A') }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($order->delivered_date)
                                        <tr>
                                            <th>Delivered Date:</th>
                                            <td>{{ \Carbon\Carbon::parse($order->delivered_date)->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Customer & Delivery Address -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4>Delivery & Customer Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-md mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%">Customer Name:</th>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Governorate:</th>
                                        <td>{{ $division->name ?? '-' }} ({{ $division->bn_name ?? '' }})</td>
                                    </tr>
                                    <tr>
                                        <th>District:</th>
                                        <td>{{ $district->name ?? '-' }} ({{ $district->bn_name ?? '' }})</td>
                                    </tr>
                                    <tr>
                                        <th>Area / Neighborhood:</th>
                                        <td>{{ $area->name ?? '-' }} ({{ $area->bn_name ?? '' }})</td>
                                    </tr>
                                    <tr>
                                        <th>Street / Address:</th>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Postal Code:</th>
                                        <td>{{ $order->post_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Notes:</th>
                                        <td>{{ $order->notes ?? 'No notes provided' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ordered Items Details Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ordered Meals & Items</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Product Name</th>
                                            <th>Size & Options</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $detail)
                                            @php
                                                $options = !empty($detail->options) ? json_decode($detail->options, true) : [];
                                            @endphp
                                            <tr>
                                                <td style="width: 90px;">
                                                    <img src="{{ asset($detail->products->thumbnail ?? 'frontend/images/banner2_img_2.jpg') }}"
                                                        style="height: 60px; width: 75px; object-fit: cover;"
                                                        class="img-thumbnail" alt="">
                                                </td>
                                                <td>
                                                    <strong>{{ $detail->products->name ?? $detail->products->title ?? 'Product' }}</strong>
                                                </td>
                                                <td>
                                                    @if ($detail->size)
                                                        <span class="d-block"><strong>Size:</strong> {{ $detail->size }}</span>
                                                    @endif
                                                    @if (!empty($options))
                                                        <span class="d-block text-muted small"><strong>Options:</strong>
                                                            @foreach ($options as $opt)
                                                                {{ $opt['name'] ?? '' }}
                                                                ({{ currencyPosition($opt['price'] ?? 0) }}){{ !$loop->last ? ', ' : '' }}
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ currencyPosition($detail->price) }}</td>
                                                <td><span
                                                        class="badge badge-light font-weight-bold fs-6">{{ $detail->qty }}</span>
                                                </td>
                                                <td><strong>{{ currencyPosition($detail->price * $detail->qty) }}</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-right">Grand Total:</th>
                                            <th class="text-primary font-weight-bold fs-5">
                                                {{ currencyPosition($order->amount) }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Action Buttons (Approve / Progress / Delivered / Cancel) -->
                        <div class="card-footer bg-whitesmoke text-center py-3">
                            @if ($order->status == 'pending')
                                <a href="{{ route('admin.orders.approve', $order->id) }}" class="btn btn-info btn-lg mr-2">
                                    <i class="fas fa-spinner"></i> Move to Processing
                                </a>
                                <a href="{{ route('admin.orders.cancel', $order->id) }}" class="btn btn-danger btn-lg"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                    <i class="fas fa-times"></i> Cancel Order
                                </a>
                            @elseif ($order->status == 'progress')
                                <a href="{{ route('admin.orders.approve', $order->id) }}" class="btn btn-success btn-lg mr-2">
                                    <i class="fas fa-check-circle"></i> Mark as Delivered
                                </a>
                                <a href="{{ route('admin.orders.cancel', $order->id) }}" class="btn btn-danger btn-lg"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                    <i class="fas fa-times"></i> Cancel Order
                                </a>
                            @elseif ($order->status == 'delivered')
                                <div class="alert alert-success d-inline-block mb-0 py-2 px-4">
                                    <i class="fas fa-check-circle"></i> This order has been completed and delivered
                                    successfully.
                                </div>
                            @elseif ($order->status == 'canceled')
                                <div class="alert alert-danger d-inline-block mb-0 py-2 px-4">
                                    <i class="fas fa-times-circle"></i> This order is cancelled.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection