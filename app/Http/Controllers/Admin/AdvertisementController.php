<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $advertisements = Advertisement::latest()->get();
        return view('admin.advertisement.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3072'],
            'title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'url' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', null, '/uploads/advertisement');

        Advertisement::create([
            'image' => $imagePath,
            'title' => $request->title,
            'details' => $request->details,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toastr()->success('Advertisement banner created successfully!');
        return redirect()->route('admin.advertisements.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $advertisement): View
    {
        return view('admin.advertisement.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3072'],
            'title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'url' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', $advertisement->image, '/uploads/advertisement');

        $advertisement->update([
            'image' => !empty($imagePath) ? $imagePath : $advertisement->image,
            'title' => $request->title,
            'details' => $request->details,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        toastr()->success('Advertisement banner updated successfully!');
        return redirect()->route('admin.advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement): JsonResponse
    {
        try {
            $this->removeImage($advertisement->image);
            $advertisement->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Advertisement banner deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}

