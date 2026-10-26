@props(['product'])

<div class="fp__menu_item">
    <div class="fp__menu_item_img">
        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
        @if ($product->category)
            <a class="category" href="{{ route('shop', ['category' => $product->category->slug]) }}">
                {{ $product->category->name }}
            </a>
        @endif
    </div>

    <div class="fp__menu_item_text">
        <p class="rating">
            @php
                $avgRating = round($product->reviews_avg_rating ?? ($product->active_review_avg ?? 5), 1);
                $reviewCount = $product->reviews_count ?? ($product->active_review_count ?? 0);
            @endphp
            @for ($i = 1; $i <= 5; $i++)
                @if ($avgRating >= $i)
                    <i class="fas fa-star"></i>
                @elseif ($avgRating >= ($i - 0.5))
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
            <span>({{ $reviewCount }})</span>
        </p>

        <a class="title" href="{{ route('product.details', $product->slug) }}">
            {{ Str::limit($product->name, 28) }}
        </a>

        @if ($product->offer_price > 0)
            <h5 class="price">${{ number_format($product->offer_price, 2) }}
                <del>${{ number_format($product->price, 2) }}</del>
            </h5>
        @else
            <h5 class="price">${{ number_format($product->price, 2) }}</h5>
        @endif

        <ul class="d-flex flex-wrap justify-content-center">
            <li>
                <a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"
                    title="Quick View / Add to Cart">
                    <i class="fas fa-shopping-basket"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;" onclick="addToWishlist('{{ $product->id }}')" title="Add to Wishlist">
                    <i class="fal fa-heart"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('product.details', $product->slug) }}" title="View Details">
                    <i class="far fa-eye"></i>
                </a>
            </li>
        </ul>
    </div>
</div>