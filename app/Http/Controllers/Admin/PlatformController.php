<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of platforms.
     */
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platform.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.platform.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'heading' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        Platform::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'heading' => $request->heading,
            'url' => $request->url ?? '#',
            'status' => $request->status,
        ]);

        toastr()->success('Mobile platform created successfully!');
        return redirect()->route('admin.platforms.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platform.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'heading' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        $platform = Platform::findOrFail($id);
        $platform->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'heading' => $request->heading,
            'url' => $request->url ?? '#',
            'status' => $request->status,
        ]);

        toastr()->success('Mobile platform updated successfully!');
        return redirect()->route('admin.platforms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Platform deleted successfully!',
        ]);
    }

    /**
     * Toggle platform active status via AJAX.
     */
    public function toggleStatus(string $id)
    {
        $platform = Platform::findOrFail($id);
        $platform->status = !$platform->status;
        $platform->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Platform status updated successfully!',
            'new_status' => $platform->status,
        ]);
    }
}

