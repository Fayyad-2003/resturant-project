<div class="fp__single_blog">
    <a href="{{ route('blog.details', $blog->slug) }}" class="fp__single_blog_img">
        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100" style="height: 240px; object-fit: cover;">
    </a>
    <div class="fp__single_blog_text">
        <a class="category" href="{{ route('blog', ['category' => $blog->category->slug]) }}">{{ $blog->category->name }}</a>
        <ul class="d-flex flex-wrap mt_15">
            <li><i class="fas fa-user"></i> {{ $blog->user->name ?? 'Admin' }}</li>
            <li><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}</li>
            <li><i class="fas fa-comments"></i> {{ $blog->comments->count() }}</li>
        </ul>
        <a class="title" href="{{ route('blog.details', $blog->slug) }}">{{ Str::words($blog->title, 7, '...') }}</a>
    </div>
</div>

