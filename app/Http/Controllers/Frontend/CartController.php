<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ProductSize as Size;
use App\Models\ProductOption as Option;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * add to cart
     */
    public function addToCart(Request $request)
    {
        $product = Product::with(['sizes', 'options'])->findOrFail($request->product_id);

        // size price
        $productPrice = null;
        $sizeId = $request->product_size ?? $request->product_price;
        if ($sizeId) {
            $productPrice = Size::find($sizeId);
        }

        // options
        $productOptions = collect(); // always defined!
        $optionsIds = $request->product_options ?? $request->product_ptions;
        if ($optionsIds) {
            $productOptions = Option::whereIn('id', $optionsIds)->get();
        }

        // map only if not empty
        $options = $productOptions->map(function ($item) {
            return [
                'name' => $item->name,
                'price' => $item->price,
            ];
        })->toArray();

        $basePrice = $product->offer_price ?? $product->price;
        $sizePrice = $productPrice->price ?? 0;
        $optionsPrice = collect($options)->sum('price');

        $finalPrice = $basePrice + $sizePrice + $optionsPrice;

        Cart::add([
            'id' => $product->id,
            'name' => $product->name ?? $product->title,
            'qty' => $request->quantity ?? '1',
            'price' => $finalPrice,
            'weight' => 0,
            'options' => [
                'size_name' => $productPrice->name ?? null,
                'size_price' => $productPrice->price ?? null,
                'options' => $options,
                'slug' => $product->slug,
                'thumbnail' => $product->main_image ?? $product->thumbnail,
            ]
        ]);

        return response()->json('Cart added success');
    }

    /**
     * my cart page
     */
    public function mycart()
    {
        return view('frontend.pages.cart.index');
    }

    /**show my cart view data */
    public function mycartcontent()
    {
        $cartproducts = Cart::content();
        $cartsubtotal = Cart::subtotal();
        return view('frontend.pages.cart.components.cart-content', compact(['cartproducts','cartsubtotal']))->render();
    }

    /**show mini cart data */
    public function minicart()
    {
        $cartproducts = Cart::content();
        return view('frontend.layouts.mini-cart-product', compact(['cartproducts']))->render();
    }

    /**
     * cart count and calculation
     */
    public function cartcount()
    {
        $carttotal = Cart::total();
        $cartcount = Cart::count();
        return response()->json([
            'carttotal' => $carttotal,
            'cartcount' => $cartcount,
        ]);
    }

    /**remove cart item */
    public function removecartitem(Request $request)
    {
        Cart::remove($request->rowId);
        return response()->json('Cart remove success');
    }

    /**
     * cart qty increment
     */
    public function cartqtyincrement(Request $request)
    {
        $cart = Cart::get($request->rowId);
        Cart::update($request->rowId, $cart->qty + 1);

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon) {
                if ($coupon['discount_type'] == 'percent') {
                    Session::put('coupon', [
                        'name' => $coupon['name'],
                        'code' => $coupon['code'],
                        'discount_type' => $coupon['discount_type'],
                        'discount' => $coupon['discount'],
                        'coupon_discount' => Cart::total() * $coupon['discount'] / 100,
                        'coupon_discount_amount' => Cart::total() - Cart::total() * $coupon['discount'] / 100,
                    ]);
                } else {
                    Session::put('coupon', [
                        'name' => $coupon['name'],
                        'code' => $coupon['code'],
                        'discount_type' => $coupon['discount_type'],
                        'discount' => $coupon['discount'],
                        'coupon_discount' => Cart::total() - $coupon['discount'],
                        'coupon_discount_amount' => Cart::total() - $coupon['discount'],
                    ]);
                }
            }
        }
        return response()->json('quantity increment success');
    }

    /**
     * cart qty decrement
     */
    public function cartqtydecrement(Request $request)
    {
        $cart = Cart::get($request->rowId);
        Cart::update($request->rowId, $cart->qty - 1);
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon) {
                if ($coupon['discount_type'] == 'percent') {
                    Session::put('coupon', [
                        'name' => $coupon['name'],
                        'code' => $coupon['code'],
                        'discount_type' => $coupon['discount_type'],
                        'discount' => $coupon['discount'],
                        'coupon_discount' => Cart::total() * $coupon['discount'] / 100,
                        'coupon_discount_amount' => Cart::total() - Cart::total() * $coupon['discount'] / 100,
                    ]);
                } else {
                    Session::put('coupon', [
                        'name' => $coupon['name'],
                        'code' => $coupon['code'],
                        'discount_type' => $coupon['discount_type'],
                        'discount' => $coupon['discount'],
                        'coupon_discount' => Cart::total() - $coupon['discount'],
                        'coupon_discount_amount' => Cart::total() - $coupon['discount'],
                    ]);
                }
            }
        }
        return response()->json('quantity decrement success');
    }

    /**
     * cart clear
     */
    public function cartcleard(Request $request)
    {
        Cart::destroy();
        return response()->json('Cart clear success');
    }
}
