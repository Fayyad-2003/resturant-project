<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display listing of blog articles
     */
    public function index(Request $request): View
    {
        $query = BlogPost::with(['category', 'user'])->where('status', 1);

        $searchTerm = $request->search ?? $request->title;

        // Search by keyword
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $blogs = $query->latest()->paginate(9)->withQueryString();
        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 1);
            }])
            ->get();

        return view('frontend.pages.blog.index', compact('blogs', 'categories', 'searchTerm'));
    }

    /**
     * Show single blog post details
     */
    public function details(string $slug): View
    {
        $blog = BlogPost::with(['category', 'user', 'comments' => function ($q) {
                $q->where('status', 1)->latest();
            }, 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $latestPosts = BlogPost::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(4)
            ->get();

        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 1);
            }])
            ->get();

        $nextPost = BlogPost::where('id', '>', $blog->id)->where('status', 1)->first();
        $previousPost = BlogPost::where('id', '<', $blog->id)->where('status', 1)->latest('id')->first();

        return view('frontend.pages.blog.details', compact('blog', 'latestPosts', 'categories', 'nextPost', 'previousPost'));
    }

    /**
     * Store comment on a blog post
     */
    public function commentStore(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $post = BlogPost::where('status', 1)->findOrFail($id);

        BlogComment::create([
            'user_id' => Auth::id(),
            'blog_id' => $post->id,
            'comment' => $request->comment,
            'status' => 1,
        ]);

        toastr()->success('Your comment has been posted successfully!');
        return redirect()->back();
    }
}
