<section class="fp__testimonial pt_95 xs_pt_66 mb_150 xs_mb_120">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_30">
                    <h4>testimonial</h4>
                    <h2>our customer feedbacks</h2>
                    <span>
                        <img src="{{ asset('frontend/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                    </span>
                    <p>Genuine experiences and reviews shared by our wonderful guests and customers.</p>
                    <div class="mt-3">
                        @auth
                            <button type="button" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#submitTestimonialModal">
                                <i class="fas fa-comment-dots me-1"></i> Share Your Experience
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-warning text-dark fw-bold px-4 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> Log in to Share Your Experience
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        @if(isset($testimonials) && $testimonials->count() > 0)
            <div class="row testi_slider">
                @foreach ($testimonials as $item)
                    <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__single_testimonial">
                            <div class="fp__testimonial_header d-flex flex-wrap align-items-center">
                                <div class="img">
                                    <img src="{{ asset($item->image ?: 'frontend/images/client_img_1.jpg') }}" alt="{{ $item->name }}" class="img-fluid w-100" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                </div>
                                <div class="text">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ $item->designation ?: 'Customer' }}</p>
                                </div>
                            </div>
                            <div class="fp__single_testimonial_body">
                                <p class="feedback">{{ $item->details }}</p>
                                <span class="rating">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $item->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="far fa-comment-alt fa-3x mb-2 text-warning"></i>
                <p>No customer reviews yet. Be the first to share your dining experience!</p>
            </div>
        @endif
    </div>
</section>

<!-- Submit Testimonial Modal -->
@auth
<div class="modal fade" id="submitTestimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white fw-bold" id="testimonialModalLabel">
                    <i class="fas fa-star me-2"></i> Share Your Dining Experience
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('testimonial.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                        <img src="{{ asset(Auth::user()->avatar ?: 'frontend/images/client_img_1.jpg') }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Overall Rating</label>
                        <select name="rating" class="form-select form-control" required>
                            <option value="5">⭐⭐⭐⭐⭐ 5 Stars - Exceptional!</option>
                            <option value="4">⭐⭐⭐⭐ 4 Stars - Very Good</option>
                            <option value="3">⭐⭐⭐ 3 Stars - Average</option>
                            <option value="2">⭐⭐ 2 Stars - Below Average</option>
                            <option value="1">⭐ 1 Star - Poor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Your Title / Tagline (Optional)</label>
                        <input type="text" name="designation" class="form-control" placeholder="e.g. Regular Foodie, Family Visitor, Pasta Lover">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Your Feedback / Review <span class="text-danger">*</span></label>
                        <textarea name="details" rows="4" class="form-control" placeholder="Tell us what you liked about our food, ambiance, or service..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning text-white fw-bold px-4">
                        <i class="fas fa-paper-plane me-1"></i> Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
