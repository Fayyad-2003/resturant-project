<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductCreateRequest;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = \App\Models\Category::where('status', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request): RedirectResponse
    {
        try {
            // Handle image upload first
            if (!$request->hasFile('main_image')) {
                toastr()->error('Product image is required.');
                return back()->withInput();
            }

            $imagePath = $this->uploadImage($request, 'main_image');

            if (!$imagePath) {
                toastr()->error('Failed to upload product image. Please try again.');
                return back()->withInput();
            }

            // Create product
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);

            // Check if slug exists and make it unique
            $originalSlug = $product->slug;
            $count = 2;
            while (Product::where('slug', $product->slug)->exists()) {
                $product->slug = $originalSlug . '-' . $count;
                $count++;
            }

            $product->main_image = $imagePath;
            $product->category_id = $request->category_id;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->price = $request->price;
            $product->offer_price = $request->offer_price ?? 0;
            $product->sku = $request->sku;
            $product->seo_title = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->show_at_home = $request->show_at_home ?? 0;
            $product->status = $request->status;
            $product->save();

            toastr()->success('Product created successfully!');
            return to_route('admin.products.index');
        } catch (\Exception $e) {
            \Log::error('Product creation failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            toastr()->error('Failed to create product. Error: ' . $e->getMessage());
            return back()->withInput();
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Upload image for Summernote editor
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048'
        ]);

        try {
            $imagePath = $this->uploadImage($request, 'image', null, '/uploads/editor');

            return response()->json([
                'success' => true,
                'url' => asset($imagePath)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image'
            ], 500);
        }
    }
}
