<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = BlogPost::with(['category', 'user'])->latest()->get();
        return view('admin.blog.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3072'],
            'title' => ['required', 'string', 'max:255', 'unique:blog_posts,title'],
            'category_id' => ['required', 'exists:blog_categories,id'],
            'description' => ['required'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', null, '/uploads/blog');

        BlogPost::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'status' => $request->status,
        ]);

        toastr()->success('Blog post published successfully!');
        return redirect()->route('admin.blog-posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'image' => ['nullable', 'image', 'max:3072'],
            'title' => ['required', 'string', 'max:255', 'unique:blog_posts,title,' . $id],
            'category_id' => ['required', 'exists:blog_categories,id'],
            'description' => ['required'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', $post->image, '/uploads/blog');

        $post->update([
            'category_id' => $request->category_id,
            'image' => $imagePath ?? $post->image,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'status' => $request->status,
        ]);

        toastr()->success('Blog post updated successfully!');
        return redirect()->route('admin.blog-posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);
        $this->removeImage($post->image);
        $post->delete();

        toastr()->success('Blog post deleted successfully!');
        return redirect()->back();
    }
}

