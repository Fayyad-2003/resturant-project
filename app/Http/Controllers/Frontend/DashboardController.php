<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Testimonial;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(): View
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->latest()->get();
        $totalOrders = Order::where('user_id', $userId)->count();
        $completedOrders = Order::where('user_id', $userId)->where('status', 'delivered')->count();
        $canceledOrders = Order::where('user_id', $userId)->where('status', 'canceled')->count();
        $wishlists = Wishlist::with('model')->where('user_id', $userId)->latest()->get();
        $myreviews = Review::with('product')->where('user_id', $userId)->latest()->get();
        $reservations = Reservation::where('user_id', $userId)->latest()->get();
        $myTestimonials = Testimonial::where('user_id', $userId)->latest()->get();

        return view('frontend.dashboard.index', compact(
            'orders',
            'totalOrders',
            'completedOrders',
            'canceledOrders',
            'wishlists',
            'myreviews',
            'reservations',
            'myTestimonials'
        ));
    }

    public function orderDetails(string $id): View
    {
        $order = Order::with('orderDetails.products')->where('user_id', Auth::id())->findOrFail($id);
        return view('frontend.pages.orders.index', compact('order'));
    }

    public function orderTrack(Request $request)
    {
        $order = Order::with('orderDetails.products')->where('order_number', $request->order_number)->first();

        if ($order) {
            return view('frontend.pages.orders.track-order', compact('order'))->render();
        } else {
            return response()->json(['error' => 'No order found! Please verify your order number and try again.']);
        }
    }

}
