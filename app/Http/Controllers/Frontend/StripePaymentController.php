<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * Show Stripe payment page
     */
    public function stripe(): View
    {
        if (Session::has('billing_data')) {
            $amount = Session::get('billing_data')['total_amount'];
        } else {
            $amount = Cart::total();
        }

        return view('frontend.pages.payments.stripe', compact('amount'));
    }

    /**
     * Process Stripe payment and store order
     */

    public function stripePost(Request $request, PaymentService $paymentService)
    {
        $stripeSecret = env('STRIPE_SECRET');
        Stripe\Stripe::setApiKey($stripeSecret);

        try {
            Stripe\Charge::create([
                'amount' => round($request->payment_amount * 100),
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for FoodPark Order'
            ]);

            $paymentService->orderStore();
            toastr()->success('Payment successful! Your order has been placed.');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
