<!-- MENU ITEM START  -->
<!-- MENU ITEM START  -->
<section class="fp__menu mt_95 xs_mt_65">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_45">
                    <h4>Food Menu</h4>
                    <h2>Our Popular Delicious Foods</h2>
                    <span>
                        <img src="{{ asset('frontend') }}/images/heading_shapes.png" alt="shapes"
                            class="img-fluid w-100" />
                    </span>
                    <p>
                        Explore our handcrafted menu items prepared with fresh ingredients, various sizes, and tasty
                        extra options.
                    </p>
                </div>
            </div>
        </div>

        <!-- Category Filters -->
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-12">
                <div class="menu_filter d-flex flex-wrap justify-content-center">
                    <button class="active" data-filter="*">All Menu</button>
                    @foreach ($categories as $category)
                        <button data-filter=".cat-{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row grid">
            @forelse ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4 cat-{{ $product->category_id }}">
                    <div class="fp__menu_item">
                        <div class="fp__menu_item_img">
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}"
                                class="img-fluid w-100" />
                            @if ($product->category)
                                <a class="category" href="javascript:;">{{ $product->category->name }}</a>
                            @endif
                        </div>
                        <div class="fp__menu_item_text">
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(5.0)</span>
                            </p>
                            <a class="title" href="javascript:;">{{ $product->name }}</a>

                            @if ($product->offer_price > 0)
                                <h5 class="price">${{ number_format($product->offer_price, 2) }}
                                    <del>${{ number_format($product->price, 2) }}</del>
                                </h5>
                            @else
                                <h5 class="price">${{ number_format($product->price, 2) }}</h5>
                            @endif


                            <ul class="d-flex flex-wrap justify-content-center">
                                <!-- Quick View Button triggers modal via AJAX -->
                                <li>
                                    <a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"
                                        title="Quick View / Add to Cart">
                                        <i class="fas fa-shopping-basket"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:;" onclick="addToWishlist('{{ $product->id }}')"
                                        title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"
                                        title="View Details">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No products available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- MENU ITEM END  -->