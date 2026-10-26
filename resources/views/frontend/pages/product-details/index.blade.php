@extends('frontend.layouts.master')

@section('title', $product->name)

@push('front_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css" />
@endpush

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>{{ $product->name }}</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:;">Product Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- MENU DETAILS START -->
    <section class="fp__menu_details mt_115 xs_mt_85 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <!-- Product Gallery Slider -->
                <div class="col-lg-5 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box fp__menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li>
                                    <img class="zoom img-fluid w-100" src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                                </li>
                                @if ($product->gallery && $product->gallery->count() > 0)
                                    @foreach ($product->gallery as $galleryItem)
                                        <li>
                                            <img class="zoom img-fluid w-100" src="{{ asset($galleryItem->src) }}" alt="{{ $product->name }}">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i> </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i> </a>
                        </p>
                    </div>
                </div>

                <!-- Product Details Form -->
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <form class="fp__menu_details_text cart_form" id="cart_form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="base_price" value="{{ $product->offer_price > 0 ? $product->offer_price : $product->price }}">

                        <h2>{{ $product->name }}</h2>

                        <!-- Rating Stars -->
                        <p class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if (($product->active_reviews_avg ?? 0) >= $i)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-muted"></i>
                                @endif
                            @endfor
                            <span>({{ number_format($product->active_reviews_avg ?? 0, 1) }})</span>
                            <b class="text-black"><i>{{ $product->active_reviews_count ?? 0 }}</i> Reviews</b>
                        </p>

                        <!-- Price -->
                        @if ($product->offer_price > 0)
                            <h5 class="price">${{ number_format($product->offer_price, 2) }}
                                <del>${{ number_format($product->price, 2) }}</del>
                            </h5>
                        @else
                            <h5 class="price">${{ number_format($product->price, 2) }}</h5>
                        @endif

                        <p class="short_description">{{ $product->short_description }}</p>

                        <!-- Sizes -->
                        @if ($product->sizes && $product->sizes->count() > 0)
                            <div class="details_size">
                                <h5>Select Size</h5>
                                @foreach ($product->sizes as $size)
                                    <div class="form-check">
                                        <input class="form-check-input product_size_radio" type="radio" name="product_size"
                                            id="size-{{ $size->id }}" value="{{ $size->id }}" data-price="{{ $size->price }}"
                                            {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size-{{ $size->id }}">
                                            {{ $size->name }} <span>+${{ number_format($size->price, 2) }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Options -->
                        @if ($product->options && $product->options->count() > 0)
                            <div class="details_extra_item">
                                <h5>Select Options <span>(optional)</span></h5>
                                @foreach ($product->options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input product_option_checkbox" type="checkbox"
                                            name="product_options[]" value="{{ $option->id }}" id="option-{{ $option->id }}"
                                            data-price="{{ $option->price }}">
                                        <label class="form-check-label" for="option-{{ $option->id }}">
                                            {{ $option->name }} <span>+${{ number_format($option->price, 2) }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Quantity and Calculated Total Price -->
                        <div class="details_quentity">
                            <h5>Select Quantity</h5>
                            <div class="quentity_btn_area d-flex flex-wrap align-items-center">
                                <div class="quentity_btn">
                                    <button type="button" class="btn btn-danger qty_decrement"><i class="fas fa-minus"></i></button>
                                    <input type="number" value="1" min="1" name="quantity" id="modal_quantity" class="quantity" style="width: 80px; text-align: center;" readonly>
                                    <button type="button" class="btn btn-success qty_increment"><i class="fas fa-plus"></i></button>
                                </div>
                                <h3 class="ms-3 mb-0 text-success">
                                    Total: $<span id="modal_total_price">{{ number_format($product->offer_price > 0 ? $product->offer_price : $product->price, 2) }}</span>
                                </h3>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <ul class="details_button_area d-flex flex-wrap mt-4">
                            <li>
                                <button class="common_btn add_to_cart" type="submit" id="add_to_cart">
                                    <i class="fas fa-shopping-basket"></i> Add to Cart
                                </button>
                            </li>
                            <li>
                                <a class="wishlist" href="javascript:;" onclick="addToWishlist('{{ $product->id }}')" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                    </form>
                </div>

                <!-- Tabs: Description & Reviews -->
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Reviews ({{ $product->active_reviews_count ?? 0 }})</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="menu_det_description p-4">
                                    {!! $product->long_description !!}
                                </div>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="fp__review_area p-4">
                                    <div class="row">
                                        <!-- Reviews List -->
                                        <div class="col-lg-8">
                                            <h4>{{ count($reviews) }} Customer Reviews</h4>
                                            @if (count($reviews) > 0)
                                                <div class="fp__comment pt-0 mt_20">
                                                    @foreach ($reviews as $review)
                                                        <div class="fp__single_comment m-0 border-0 mb-4 p-3 bg-light rounded">
                                                            <img src="{{ $review->user->avatar ?? asset('frontend/images/client_img_1.png') }}"
                                                                alt="{{ $review->user->name }}" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                                            <div class="fp__single_comm_text">
                                                                <h3>{{ $review->user->name }}
                                                                    <span>{{ $review->created_at->format('d M Y') }}</span>
                                                                </h3>
                                                                <span class="rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <i class="fas fa-star text-warning"></i>
                                                                        @else
                                                                            <i class="far fa-star text-muted"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <b>({{ $review->rating }}/5)</b>
                                                                </span>
                                                                <p class="mt-2">{{ $review->message }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-4 text-muted">
                                                    <i class="far fa-comment-dots fa-3x mb-2"></i>
                                                    <p>No reviews yet for this product. Be the first to review it!</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Write Review Form -->
                                        <div class="col-lg-4">
                                            <div class="fp__post_review p-4 border rounded bg-white">
                                                <h4>Write a Review</h4>
                                                @auth
                                                    <form method="POST" action="{{ route('review.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Select Rating</label>
                                                            <div id="rateYo"></div>
                                                            <input type="hidden" name="rating" id="ratingValue" value="5">
                                                            @error('rating')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Your Review</label>
                                                            <textarea class="form-control" rows="4" name="message" placeholder="Share your experience with this food..." required></textarea>
                                                            @error('message')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <button class="common_btn w-100" type="submit">Submit Review</button>
                                                    </form>
                                                @else
                                                    <div class="alert alert-info mt-3">
                                                        <p class="mb-2">Please login to write a review.</p>
                                                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login Now</a>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if ($relatedProducts && $relatedProducts->count() > 0)
                <div class="fp__related_menu mt_90 xs_mt_60">
                    <h2>Related Delicious Foods</h2>
                    <div class="row">
                        @foreach ($relatedProducts as $related)
                            <div class="col-xl-3 col-sm-6 col-lg-4 mb-4">
                                <div class="fp__menu_item">
                                    <div class="fp__menu_item_img">
                                        <img src="{{ asset($related->main_image) }}" alt="{{ $related->name }}" class="img-fluid w-100" />
                                        @if ($related->category)
                                            <a class="category" href="javascript:;">{{ $related->category->name }}</a>
                                        @endif
                                    </div>
                                    <div class="fp__menu_item_text">
                                        <a class="title" href="{{ route('product.details', $related->slug) }}">{{ $related->name }}</a>
                                        @if ($related->offer_price > 0)
                                            <h5 class="price">${{ number_format($related->offer_price, 2) }}
                                                <del>${{ number_format($related->price, 2) }}</del>
                                            </h5>
                                        @else
                                            <h5 class="price">${{ number_format($related->price, 2) }}</h5>
                                        @endif
                                        <ul class="d-flex flex-wrap justify-content-center">
                                            <li>
                                                <a href="javascript:;" onclick="loadProductModal('{{ $related->id }}')" title="Quick View">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="addToWishlist('{{ $related->id }}')" title="Wishlist">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('product.details', $related->slug) }}" title="View Details">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- MENU DETAILS END -->
@endsection

@push('front_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize RateYo Star Rating Picker
            $("#rateYo").rateYo({
                rating: 5,
                fullStar: true,
                starWidth: "25px",
                normalFill: "#ddd",
                ratedFill: "#ffc107"
            }).on("rateyo.change", function(e, data) {
                $("#ratingValue").val(data.rating);
            });

            // Initialize Product Image Exzoom if elements exist
            if ($("#exzoom").length > 0 && typeof $.fn.exzoom === 'function') {
                $("#exzoom").exzoom({
                    autoPlay: false,
                });
            }
        });
    </script>
@endpush

