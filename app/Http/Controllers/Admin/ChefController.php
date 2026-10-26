<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chef;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChefController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of chefs.
     */
    public function index(): View
    {
        $chefs = Chef::latest()->get();
        return view('admin.chef.index', compact('chefs'));
    }

    /**
     * Show the form for creating a new chef.
     */
    public function create(): View
    {
        return view('admin.chef.create');
    }

    /**
     * Store a newly created chef in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3072'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'behance' => ['nullable', 'string', 'max:255'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', null, '/uploads/chef');

        Chef::create([
            'image' => $imagePath,
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'behance' => $request->behance,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ]);

        toastr()->success('Chef profile created successfully!');
        return redirect()->route('admin.chefs.index');
    }

    /**
     * Show the form for editing the specified chef.
     */
    public function edit(Chef $chef): View
    {
        return view('admin.chef.edit', compact('chef'));
    }

    /**
     * Update the specified chef in storage.
     */
    public function update(Request $request, Chef $chef): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3072'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'behance' => ['nullable', 'string', 'max:255'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', $chef->image, '/uploads/chef');

        $chef->update([
            'image' => !empty($imagePath) ? $imagePath : $chef->image,
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'behance' => $request->behance,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ]);

        toastr()->success('Chef profile updated successfully!');
        return redirect()->route('admin.chefs.index');
    }

    /**
     * Remove the specified chef from storage.
     */
    public function destroy(Chef $chef): JsonResponse
    {
        try {
            $this->removeImage($chef->image);
            $chef->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Chef deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}

