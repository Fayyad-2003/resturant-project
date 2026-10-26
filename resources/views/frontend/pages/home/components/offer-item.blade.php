    <!-- OFFER ITEM START  -->
    @if(isset($dailyOffers) && $dailyOffers->count() > 0)
    <section class="fp__offer_item mt_100 xs_mt_70 pt_95 xs_pt_65 pb_150 xs_pb_120">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                    <div class="fp__section_heading mb_50">
                        <h4>daily offer</h4>
                        <h2>up to 75% off for this day</h2>
                        <span>
                            <img src="{{ asset('frontend') }}/images/heading_shapes.png" alt="shapes"
                                class="img-fluid w-100" />
                        </span>
                        <p>
                            Objectively pontificate quality models before intuitive
                            information. Dramatically recaptiualize multifunctional
                            materials.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row offer_item_slider wow fadeInUp" data-wow-duration="1s">
                @foreach ($dailyOffers as $product)
                    @php
                        $discount = $product->price > 0 ? (($product->price - $product->offer_price) / $product->price) * 100 : 0;
                    @endphp
                    <div class="col-xl-4">
                        <div class="fp__offer_item_single">
                            <div class="img">
                                <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                            </div>
                            <div class="text">
                                <span>{{ round($discount) }}% off</span>
                                <a class="title" href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                <p>{!! Str::limit(strip_tags($product->short_description), 65) !!}</p>
                                <ul class="d-flex flex-wrap">
                                    <li><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')" title="Quick View"><i class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="javascript:;" onclick="addToWishlist('{{ $product->id }}')" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="{{ route('product.details', $product->slug) }}" title="View Details"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- OFFER ITEM END  -->
