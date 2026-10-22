<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Apply coupon
     */

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupondata)
            ->where('expire_date', '>=', now()->format('Y-m-d'))
            ->where('status', 'active')
            ->first();
        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon code']);
        }

        // Check minimum purchase amount
        $cartTotal = (float) str_replace(',', '', Cart::total());
        if ($coupon->min_purchase_amount > $cartTotal) {
            return response()->json([
                'error' => 'Minimum purchase amount for this coupon is ' . currencyPosition($coupon->min_purchase_amount)
            ]);
        }

        // Calculate discount
        if ($coupon->discount_type === 'percent') {
            $discountAmount = ($cartTotal * $coupon->discount) / 100;
        } else {
            $discountAmount = (float) $coupon->discount;
        }

        $finalTotal = max(0, $cartTotal - $discountAmount);

        Session::put('coupon', [
            'name' => $coupon->name,
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount' => $coupon->discount,
            'coupon_discount' => $discountAmount,
            'coupon_discount_amount' => $finalTotal
        ]);

        return response()->json(['success' => 'Coupon applied successfully!']);
    }

    /**
     * Return dynamic coupon calculation view
     */

    public function couponCalculation()
    {
        return view('frontend.layouts.partials.coupon-calculation');
    }

    /**
     * Remove applied coupon
     */

    public function couponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully!']);
    }
}
