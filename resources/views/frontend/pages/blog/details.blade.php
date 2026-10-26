@extends('frontend.layouts.master')

@section('title', $blog->seo_title ?? $blog->title)

@push('front_style')
    <meta property="og:title" content="{{ $blog->seo_title ?? $blog->title }}">
    <meta property="og:description" content="{{ $blog->seo_description ?? Str::limit(strip_tags($blog->description), 150) }}">
    <meta property="og:image" content="{{ asset($blog->image) }}">
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}">
    <meta property="og:type" content="article">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->seo_title ?? $blog->title }}">
    <meta name="twitter:description" content="{{ $blog->seo_description ?? Str::limit(strip_tags($blog->description), 150) }}">
    <meta name="twitter:image" content="{{ asset($blog->image) }}">
@endpush

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Blog Details</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="javascript:;">Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- BLOG DETAILS START -->
    <section class="fp__blog_details mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <!-- Main Post Content -->
                <div class="col-xl-8 col-lg-8">
                    <div class="fp__blog_det_area">
                        <div class="fp__blog_details_img wow fadeInUp" data-wow-duration="1s">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100" style="max-height: 480px; object-fit: cover; border-radius: 5px;">
                        </div>
                        <div class="fp__blog_details_text wow fadeInUp mt-4" data-wow-duration="1s">
                            <ul class="details_bloger d-flex flex-wrap align-items-center mb-3">
                                <li class="me-4"><i class="far fa-user text-warning me-1"></i> By {{ $blog->user->name ?? 'Admin' }}</li>
                                <li class="me-4"><i class="far fa-calendar-alt text-warning me-1"></i> {{ $blog->created_at->format('d M Y') }}</li>
                                <li class="me-4"><i class="fas fa-folder-open text-warning me-1"></i> <a href="{{ route('blog', ['category' => $blog->category->slug]) }}" class="text-secondary">{{ $blog->category->name }}</a></li>
                                <li><i class="far fa-comments text-warning me-1"></i> {{ $blog->comments->count() }} Comments</li>
                            </ul>
                            
                            <h2 class="mb-4">{{ $blog->title }}</h2>
                            
                            <div class="blog_description_body mb-5" style="line-height: 1.8; font-size: 16px; color: #555;">
                                {!! $blog->description !!}
                            </div>

                            <!-- Social Sharing -->
                            <div class="blog_tags_share d-flex flex-wrap justify-content-between align-items-center border-top border-bottom py-3 my-4">
                                <div class="tags d-flex flex-wrap align-items-center">
                                    <span class="fw-bold me-2"><i class="fas fa-tag text-danger me-1"></i> Category:</span>
                                    <a href="{{ route('blog', ['category' => $blog->category->slug]) }}" class="badge bg-light text-dark border px-3 py-2 text-decoration-none">
                                        {{ $blog->category->name }}
                                    </a>
                                </div>
                                <div class="share d-flex flex-wrap align-items-center mt-2 mt-sm-0">
                                    <span class="fw-bold me-2"><i class="fas fa-share-alt text-primary me-1"></i> Share:</span>
                                    <ul class="d-flex flex-wrap gap-2 list-unstyled mb-0">
                                        <!-- Facebook -->
                                        <li>
                                            <a class="btn btn-sm btn-outline-primary rounded-circle" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <!-- Twitter / X -->
                                        <li>
                                            <a class="btn btn-sm btn-outline-info rounded-circle" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on X">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <!-- LinkedIn -->
                                        <li>
                                            <a class="btn btn-sm btn-outline-primary rounded-circle" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on LinkedIn">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <!-- WhatsApp -->
                                        <li>
                                            <a class="btn btn-sm btn-outline-success rounded-circle" href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}" target="_blank" title="Share on WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Previous & Next Post Navigation -->
                    @if ($previousPost || $nextPost)
                        <ul class="blog_det_button mt_50 xs_mt_40 wow fadeInUp d-flex justify-content-between list-unstyled gap-3" data-wow-duration="1s">
                            @if ($previousPost)
                                <li class="w-50">
                                    <a href="{{ route('blog.details', $previousPost->slug) }}" class="d-flex align-items-center p-3 border rounded text-decoration-none bg-white h-100 shadow-sm">
                                        <img src="{{ asset($previousPost->image) }}" alt="{{ $previousPost->title }}" class="img-fluid rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                        <div>
                                            <span class="d-block text-warning small fw-bold"><i class="fas fa-long-arrow-alt-left me-1"></i> Previous Post</span>
                                            <p class="mb-0 text-dark fw-bold small">{{ Str::limit($previousPost->title, 40) }}</p>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <div class="w-50"></div>
                            @endif

                            @if ($nextPost)
                                <li class="w-50 text-end">
                                    <a href="{{ route('blog.details', $nextPost->slug) }}" class="d-flex align-items-center justify-content-end p-3 border rounded text-decoration-none bg-white h-100 shadow-sm">
                                        <div class="text-end me-3">
                                            <span class="d-block text-warning small fw-bold">Next Post <i class="fas fa-long-arrow-alt-right ms-1"></i></span>
                                            <p class="mb-0 text-dark fw-bold small">{{ Str::limit($nextPost->title, 40) }}</p>
                                        </div>
                                        <img src="{{ asset($nextPost->image) }}" alt="{{ $nextPost->title }}" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                                    </a>
                                </li>
                            @else
                                <div class="w-50"></div>
                            @endif
                        </ul>
                    @endif

                    <!-- Comments List -->
                    <div class="fp__comment mt-5 p-4 bg-white rounded shadow-sm">
                        <h4>{{ $blog->comments->count() }} Comments</h4>
                        @forelse ($blog->comments as $comment)
                            <div class="fp__single_comment border-top pt-3 mt-3 d-flex">
                                <img src="{{ $comment->user->avatar ?? asset('frontend/images/client_img_1.png') }}"
                                     alt="{{ $comment->user->name ?? 'User' }}"
                                     class="img-fluid rounded-circle me-3"
                                     style="width: 55px; height: 55px; object-fit: cover;">
                                <div class="fp__single_comm_text flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-bold">{{ $comment->user->name ?? 'Anonymous' }}</h5>
                                        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-2 text-secondary mb-0">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="far fa-comments fa-3x mb-2 text-warning"></i>
                                <p class="mb-0">No comments yet. Be the first to join the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Leave a Comment Form -->
                    <div class="comment_input mt-4 p-4 bg-white rounded shadow-sm">
                        <h4 class="mb-2">Leave a Comment</h4>
                        <p class="text-muted small mb-4">Your feedback and thoughts are appreciated.</p>
                        
                        @auth
                            <form action="{{ route('blog.comment.store', $blog->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" rows="4" class="form-control" placeholder="Write your comment here..." required></textarea>
                                        @error('comment')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-warning text-white px-4 py-2 fw-bold">
                                            <i class="fas fa-paper-plane me-1"></i> Post Comment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning py-3 d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-lock me-2"></i> You must be logged in to post a comment.</span>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-warning text-white fw-bold">Log In</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4 mt-5 mt-lg-0">
                    <div id="sticky_sidebar">
                        <!-- Search Widget -->
                        <div class="fp__blog_search blog_sidebar m-0 wow fadeInUp p-4 bg-white rounded shadow-sm mb-4" data-wow-duration="1s">
                            <h3 class="mb-3">Search</h3>
                            <form method="GET" action="{{ route('blog') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search blog...">
                                    <button class="btn btn-warning text-white" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="fp__blog_categori blog_sidebar wow fadeInUp p-4 bg-white rounded shadow-sm mb-4" data-wow-duration="1s">
                            <h3 class="mb-3">Categories</h3>
                            <ul class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('blog', ['category' => $category->slug]) }}"
                                           class="d-flex justify-content-between align-items-center py-2 px-3 text-decoration-none {{ $blog->category_id == $category->id ? 'fw-bold text-warning' : 'text-dark' }}">
                                            <span>{{ $category->name }}</span>
                                            <span class="badge bg-warning text-white rounded-pill">{{ $category->posts_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Latest Posts Widget -->
                        <div class="fp__related_blog blog_sidebar wow fadeInUp p-4 bg-white rounded shadow-sm" data-wow-duration="1s">
                            <h3 class="mb-3">Recent Posts</h3>
                            <ul class="list-unstyled mb-0">
                                @forelse ($latestPosts as $recent)
                                    <li class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <a href="{{ route('blog.details', $recent->slug) }}">
                                            <img src="{{ asset($recent->image) }}" alt="{{ $recent->title }}"
                                                 class="img-fluid rounded me-3" style="width: 75px; height: 75px; object-fit: cover;">
                                        </a>
                                        <div class="text">
                                            <a href="{{ route('blog.details', $recent->slug) }}" class="text-dark fw-bold text-decoration-none d-block small mb-1" style="line-height: 1.4;">
                                                {{ Str::limit($recent->title, 45) }}
                                            </a>
                                            <p class="text-muted small mb-0">
                                                <i class="far fa-calendar-alt text-warning me-1"></i>
                                                {{ $recent->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-muted small">No other recent posts.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BLOG DETAILS END -->
@endsection

