<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Add product to wishlist (AJAX)
     */
    public function addWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to your account first!'
            ]);
        }

        $productId = $request->id;

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('model_id', $productId)
            ->where('model_type', Product::class)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'This product is already in your wishlist!'
            ]);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'model_type' => Product::class,
            'model_id' => $productId,
            'collection_name' => 'default',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to wishlist successfully!'
        ]);
    }

    /**
     * Remove item from wishlist
     */
    public function removeWishlist(string $id)
    {
        $item = Wishlist::where('user_id', Auth::id())->where('id', $id)->first();
        if ($item) {
            $item->delete();
            toastr()->success('Product removed from wishlist!');
        }

        return back();
    }
}
