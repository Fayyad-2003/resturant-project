<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Review\ReviewCreateRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewCreateRequest $request)
    {
        $alreadyReviewd = Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists();

        if ($alreadyReviewd) {
            toastr()->error('You have already reviewed this product!');
            return redirect()->back();
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'message' => $request->message,
            'status' => 'active',
            'show_at_frontend' => 'active'
        ]);

        toastr()->success('Thanks for your review!');
        return redirect()->back();
    }
}
