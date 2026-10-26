<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::withCount('posts')->latest()->get();
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_categories,name'],
            'status' => ['required', 'boolean'],
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        toastr()->success('Blog category created successfully!');
        return redirect()->route('admin.blog-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $category = BlogCategory::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_categories,name,' . $id],
            'status' => ['required', 'boolean'],
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        toastr()->success('Blog category updated successfully!');
        return redirect()->route('admin.blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        toastr()->success('Blog category deleted successfully!');
        return redirect()->back();
    }
}

