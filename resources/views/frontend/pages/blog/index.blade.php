@extends('frontend.layouts.master')

@section('title', 'Our Latest Food Blogs')

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Our Latest Food Blogs</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- BLOG PAGE START -->
    <section class="fp__blog_page fp__blog2 mt_120 xs_mt_65 mb_100 xs_mb_70">
        <div class="container">
            <!-- Search & Filter Bar -->
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6 col-md-8">
                    <form method="GET" action="{{ route('blog') }}" class="d-flex gap-2">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search articles by title or keyword..." value="{{ request('search') }}">
                            <button class="btn btn-warning text-white px-4" type="submit">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-4 mt-3 mt-md-0 text-md-end">
                    @if(request('search') || request('category'))
                        <a href="{{ route('blog') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Clear Filter
                        </a>
                    @endif
                </div>
            </div>

            <!-- Categories Filter Badges -->
            @if($categories->count() > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="fw-bold me-2 text-dark"><i class="fas fa-tags me-1 text-danger"></i> Categories:</span>
                            <a href="{{ route('blog', request('search') ? ['search' => request('search')] : []) }}"
                               class="badge {{ !request('category') ? 'bg-danger text-white' : 'bg-light text-dark border' }} text-decoration-none py-2 px-3">
                                All ({{ $categories->sum('posts_count') }})
                            </a>
                            @foreach ($categories as $cat)
                                <a href="{{ route('blog', array_merge(request()->only('search'), ['category' => $cat->slug])) }}"
                                   class="badge {{ request('category') == $cat->slug ? 'bg-danger text-white' : 'bg-light text-dark border' }} text-decoration-none py-2 px-3">
                                    {{ $cat->name }} ({{ $cat->posts_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search Result Info -->
            @if(request('search'))
                <div class="alert alert-info py-2 d-flex justify-content-between align-items-center">
                    <span>Showing search results for: <strong>"{{ request('search') }}"</strong></span>
                    <span class="text-muted small">{{ $blogs->total() }} results found</span>
                </div>
            @endif

            <!-- Blog Posts Grid -->
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp mb-4" data-wow-duration="1s">
                        <x-frontend.blog-card :blog="$blog" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card p-5 border-0 shadow-sm">
                            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                            <h4 class="text-secondary">No blog posts found</h4>
                            <p class="text-muted">Try searching with different keywords or browse all categories.</p>
                            <div class="mt-3">
                                <a href="{{ route('blog') }}" class="btn btn-warning text-white">View All Posts</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($blogs->hasPages())
                <div class="fp__pagination mt_35">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $blogs->links('vendor.pagination.food-park-pagination') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- BLOG PAGE END -->
@endsection

