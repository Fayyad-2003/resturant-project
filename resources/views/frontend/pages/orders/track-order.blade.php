<div class="fp__invoice mt-4" style="display: block;">
    <div class="fp__track_order mb-4">
        <ul>
            <li class="active" style="width: 33.33%">Order Pending</li>
            <li class="{{ in_array($order->status, ['progress', 'delivered']) ? 'active' : '' }}" style="width: 33.33%">
                In Process</li>
            <li class="{{ $order->status === 'delivered' ? 'active' : '' }}" style="width: 33.33%">Delivered</li>
        </ul>
    </div>

    @php
        $division = DB::table('divisions')->where('id', $order->division_id)->first();
        $district = DB::table('districts')->where('id', $order->district_id)->first();
        $area = DB::table('upazilas')->where('id', $order->state_id)->first();
    @endphp

    <div class="fp__invoice_header">
        <div class="header_address">
            <h4>Delivery Details</h4>
            <p><strong>Customer:</strong> {{ $order->name }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Destination:</strong> {{ $order->address }}, {{ $area->name ?? '' }}, {{ $district->name ?? '' }}
            </p>
        </div>
        <div class="header_address text-end">
            <p><b>Order ID:</b> <span>#{{ $order->order_number }}</span></p>
            <p><b>Status:</b>
                <span
                    class="badge {{ $order->status === 'delivered' ? 'bg-success' : ($order->status === 'progress' ? 'bg-info' : ($order->status === 'canceled' ? 'bg-danger' : 'bg-warning text-dark')) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><b>Total Amount:</b> <strong>{{ currencyPosition($order->amount) }}</strong></p>
            <a href="{{ route('order.details', $order->id) }}" class="common_btn btn-sm mt-2">View Full Invoice</a>
        </div>
    </div>
</div>