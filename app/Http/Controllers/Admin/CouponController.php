<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\CouponCreateRequest;
use App\Http\Requests\Admin\Coupon\CouponUpdateRequest;
use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $datatable)
    {
        return $datatable->render('admin.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponCreateRequest $request): RedirectResponse
    {
        Coupon::create([
            'name' => $request->name,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'min_purchase_amount' => $request->min_purchase_amount,
            'expire_date' => $request->expire_date,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);

        toastr()->success('Coupon created successfully!');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, string $id): RedirectResponse
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'name' => $request->name,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'min_purchase_amount' => $request->min_purchase_amount,
            'expire_date' => $request->expire_date,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);

        toastr()->success('Coupon updated successfully!');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Coupon deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete coupon.'
            ], 500);
        }
    }
}
