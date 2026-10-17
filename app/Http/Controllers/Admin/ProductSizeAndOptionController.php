<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductOptionCreateRequest;
use App\Http\Requests\Admin\Products\ProductSizeCreateRequest;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ProductSizeAndOptionController extends Controller
{
    /**
     * Display a listing of sizes and options for the given product.
     */
    public function index(string $productId): View
    {
        $product = Product::with(['sizes', 'options'])->findOrFail($productId);
        $sizes = $product->sizes;
        $options = $product->options;

        return view('admin.product-size-and-option.index', compact('product', 'sizes', 'options'));
    }

    /**
     * Store a newly created product size.
     */
    public function storeSize(ProductSizeCreateRequest $request): RedirectResponse
    {
        $size = new ProductSize();
        $size->product_id = $request->product_id;
        $size->name       = $request->name;
        $size->price      = $request->price;
        $size->save();

        toastr()->success('Product size added successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified product size via AJAX.
     */
    public function destroySize(string $id): JsonResponse
    {
        try {
            $size = ProductSize::findOrFail($id);
            $size->delete();

            return response()->json([
                'status'  => 'success',
                'message' => 'Product size deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Product size deletion error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to delete product size.'
            ], 500);
        }
    }

    /**
     * Store a newly created product option.
     */
    public function storeOption(ProductOptionCreateRequest $request): RedirectResponse
    {
        $option = new ProductOption();
        $option->product_id = $request->product_id;
        $option->name       = $request->name;
        $option->price      = $request->price;
        $option->save();

        toastr()->success('Product option added successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified product option via AJAX.
     */
    public function destroyOption(string $id): JsonResponse
    {
        try {
            $option = ProductOption::findOrFail($id);
            $option->delete();

            return response()->json([
                'status'  => 'success',
                'message' => 'Product option deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Product option deletion error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to delete product option.'
            ], 500);
        }
    }
}

