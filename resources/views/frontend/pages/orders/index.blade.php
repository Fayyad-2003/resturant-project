@extends('frontend.layouts.master')
@section('title', 'Order Invoice #' . $order->order_number)

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Order Invoice: #{{ $order->order_number }}</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- DASHBOARD INVOICE START -->
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp_dashboard_body">
                <h3>Invoice - #{{ $order->invoice_no }}</h3>
                <div class="fp__invoice" style="display: block;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a class="go_back" href="{{ route('dashboard') }}">
                            <i class="fas fa-long-arrow-alt-left"></i> Back to Dashboard
                        </a>
                        <a href="javascript:window.print();" class="common_btn btn-sm">
                            <i class="fas fa-print"></i> Print Invoice
                        </a>
                    </div>

                    <!-- Status Tracker -->
                    <div class="fp__track_order mb-4">
                        <ul>
                            <li class="active" style="width: 33.33%">Order Pending</li>
                            <li class="{{ in_array($order->status, ['progress', 'delivered']) ? 'active' : '' }}" style="width: 33.33%">In Process</li>
                            <li class="{{ $order->status === 'delivered' ? 'active' : '' }}" style="width: 33.33%">Delivered</li>
                        </ul>
                    </div>

                    @php
                        $division = DB::table('divisions')->where('id', $order->division_id)->first();
                        $district = DB::table('districts')->where('id', $order->district_id)->first();
                        $area = DB::table('upazilas')->where('id', $order->state_id)->first();
                        $coupon = !empty($order->coupon_info) ? json_decode($order->coupon_info) : null;
                    @endphp

                    <div class="fp__invoice_header">
                        <div class="header_address">
                            <h4>Billed To</h4>
                            <p><strong>Name:</strong> {{ $order->name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            <p><strong>Area:</strong> {{ $area->name ?? '' }}, {{ $district->name ?? '' }}, {{ $division->name ?? '' }}</p>
                            <p><strong>Postal Code:</strong> #{{ $order->post_code }}</p>
                        </div>
                        <div class="header_address text-end">
                            <p><b>Invoice No:</b> <span>{{ $order->invoice_no }}</span></p>
                            <p><b>Order ID:</b> <span>#{{ $order->order_number }}</span></p>
                            <p><b>Date:</b> <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</span></p>
                            <p><b>Payment Method:</b> <span class="text-capitalize">{{ $order->payment_method }}</span></p>
                            <p><b>Status:</b> 
                                <span class="badge {{ $order->status === 'delivered' ? 'bg-success' : ($order->status === 'progress' ? 'bg-info' : 'bg-warning text-dark') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="fp__invoice_body table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Size & Options</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    @php
                                        $options = !empty($item->options) ? json_decode($item->options, true) : [];
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $item->products->name ?? $item->products->title ?? 'Product' }}</strong></td>
                                        <td>
                                            @if ($item->size)
                                                <span>Size: {{ $item->size }}</span><br>
                                            @endif
                                            @if (!empty($options))
                                                <small class="text-muted">Options: 
                                                    @foreach ($options as $opt)
                                                        {{ $opt['name'] ?? '' }} ({{ currencyPosition($opt['price'] ?? 0) }}){{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            @endif
                                        </td>
                                        <td>{{ currencyPosition($item->price) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ currencyPosition($item->price * $item->qty) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end">Delivery Charge:</td>
                                    <td>{{ currencyPosition($division->delivery_fee ?? 0) }}</td>
                                </tr>
                                @if ($coupon)
                                    <tr>
                                        <td colspan="4" class="text-end">Coupon Discount ({{ $coupon->code }}):</td>
                                        <td class="text-success">-{{ $coupon->discount_type === 'percent' ? $coupon->discount . '%' : currencyPosition($coupon->discount) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="text-end fw-bold fs-5">Final Total:</td>
                                    <td class="text-primary fw-bold fs-5">{{ currencyPosition($order->amount) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DASHBOARD INVOICE END -->
@endsection