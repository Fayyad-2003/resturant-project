<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function allOrders(): View
    {
        $data = Order::with(['user', 'orderDetails'])->latest()->get();
        return view('admin.orders.index', compact('data'));
    }

    public function pendingOrders(): View
    {
        $data = Order::with(['user', 'orderDetails'])->where('status', 'pending')->latest()->get();
        return view('admin.orders.pending', compact('data'));
    }

    public function processingOrders(): View
    {
        $data = Order::with(['user', 'orderDetails'])->where('status', 'progress')->latest()->get();
        return view('admin.orders.progress', compact('data'));
    }

    public function deliveredOrders(): View
    {
        $data = Order::with(['user', 'orderDetails'])->where('status', 'delivered')->latest()->get();
        return view('admin.orders.delivered', compact('data'));
    }

    public function canceledOrders(): View
    {
        $data = Order::with(['user', 'orderDetails'])->where('status', 'canceled')->latest()->get();
        return view('admin.orders.canceled', compact('data'));
    }

    public function viewOrder(string $id): View
    {
        $order = Order::with(['user', 'orderDetails.products'])->findOrFail($id);
        return view('admin.orders.order-details', compact('order'));
    }

    public function approveOrder(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == 'pending') {
            $order->update([
                'status' => 'progress',
                'processing_date' => now()
            ]);

            toastr()->success('Order moved to processing successfully!');
            return back();
        } elseif ($order->status == 'progress') {
            $order->update([
                'status' => 'delivered',
                'delivered_date' => now(),
            ]);
            toastr()->success('Order marked as delivered successfully!');
            return back();
        }

        toastr()->info('Order status updated!');
        return back();
    }

    public function cancelOrder(string $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'canceled',
            'cancel_date' => now()
        ]);

        toastr()->error('Order cancelled successfully!');
        return back();
    }
}
