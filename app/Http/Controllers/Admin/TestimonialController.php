<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3072'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', null, '/uploads/testimonial');

        Testimonial::create([
            'image' => $imagePath,
            'name' => $request->name,
            'designation' => $request->designation,
            'details' => $request->details,
            'rating' => $request->rating,
            'status' => $request->status,
        ]);

        toastr()->success('Testimonial created successfully!');
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3072'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', $testimonial->image, '/uploads/testimonial');

        $testimonial->update([
            'image' => !empty($imagePath) ? $imagePath : $testimonial->image,
            'name' => $request->name,
            'designation' => $request->designation,
            'details' => $request->details,
            'rating' => $request->rating,
            'status' => $request->status,
        ]);

        toastr()->success('Testimonial updated successfully!');
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Toggle testimonial status (active / inactive).
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = !$testimonial->status;
        $testimonial->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial status updated successfully!',
            'new_status' => $testimonial->status,
        ]);
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        try {
            $this->removeImage($testimonial->image);
            $testimonial->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}

