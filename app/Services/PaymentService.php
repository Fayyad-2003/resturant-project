<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentService
{
    public function orderStore()
    {
        $billingData = Session::get('billing_data');
        $coupon = Session::get('coupon');

        $order = Order::create([
            'user_id' => Auth::id(),
            'division_id' => $billingData['division_id'],
            'district_id' => $billingData['district_id'],
            'state_id' => $billingData['state_id'],
            'name' => $billingData['name'],
            'email' => $billingData['email'],
            'phone' => $billingData['phone'],
            'address' => $billingData['address'],
            'post_code' => $billingData['post_code'],
            'notes' => $billingData['notes'],
            'payment_type' => $billingData['payment_type'] ?? 'offline',
            'payment_method' => $billingData['payment_method'],
            'transaction_id' => 'TRANS' . rand(111, 999),
            'amount' => $billingData['total_amount'],
            'currency' => config('settings.site_currency_icon', '$'),
            'order_number' => mt_rand(100000, 999999),
            'invoice_no' => 'invc' . mt_rand(100000, 999999),
            'order_date' => now(),
            'order_month' => now()->format('M'),
            'order_year' => now()->format('Y'),
            'coupon_info' => $coupon ? json_encode($coupon) : null,
            'status' => 'pending'
        ]);

        $cartdata = Cart::content();
        foreach ($cartdata as $item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'size' => $item->options->size ?? null,
                'options' => !empty($item->options->options) ? json_encode($item->options->options) : null,
                'qty' => $item->qty,
                'price' => $item->price
            ]);
        }

        Cart::destroy();
        Session::forget('billing_data');
        Session::forget('coupon');
    }
}