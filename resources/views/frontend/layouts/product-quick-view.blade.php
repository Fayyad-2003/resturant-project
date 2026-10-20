{{-- Product Quick View Modal --}}
<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
    <div class="fp__cart_popup_img">
        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
    </div>
    <form class="fp__menu_details_text cart_form" id="cart_form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        <!-- Base price for JS calculation -->
        <input type="hidden" id="main_price" class="main_price" value="{{ $product->offer_price > 0 ? $product->offer_price : $product->price }}" name="main_price">
        <input type="hidden" id="base_price" value="{{ $product->offer_price > 0 ? $product->offer_price : $product->price }}">
        
        <div class="fp__cart_popup_text">
            <h4 class="title">{{ $product->name }}</h4>
            <p class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
                <span>(5.0)</span>
            </p>

            @if ($product->offer_price > 0)
                <h4 class="price">${{ number_format($product->offer_price, 2) }}
                    <del>${{ number_format($product->price, 2) }}</del>
                </h4>
            @else
                <h4 class="price">${{ number_format($product->price, 2) }}</h4>
            @endif

            <!-- Sizes -->
            @if($product->sizes->count() > 0)
            <div class="details_size">
                <h5>Select Size</h5>
                @foreach($product->sizes as $size)
                <div class="form-check">
                    <input class="form-check-input product_size_radio" type="radio" 
                           name="product_price" id="size-{{ $size->id }}"
                           value="{{ $size->id }}" data-price="{{ $size->price }}">
                    <label class="form-check-label" for="size-{{ $size->id }}">
                        {{ $size->name }} <span>+${{ number_format($size->price, 2) }}</span>
                    </label>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Options -->
            @if ($product->options->count() > 0)
                <div class="details_extra_item">
                    <h5>Select Options <span>(optional)</span></h5>
                    @foreach ($product->options as $option)
                        <div class="form-check">
                            <input class="form-check-input product_option_checkbox" type="checkbox" 
                                   name="product_ptions[]" id="option-{{ $option->id }}" 
                                   value="{{ $option->id }}" data-price="{{ $option->price }}">
                            <label class="form-check-label" for="option-{{ $option->id }}">
                                {{ $option->name }} <span>+${{ number_format($option->price, 2) }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Quantity & Live Total Price -->
            <div class="details_quentity">
                <h5>Select Quantity</h5>
                <div class="quentity_btn_area d-flex flex-wrap align-items-center">
                    <div class="quentity_btn">
                        <button type="button" class="btn btn-danger cart_qty_decrement qty_decrement"><i class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" name="quantity" id="quantity" class="quantity modal_quantity" style="width: 80px; text-align: center;" readonly>
                        <button type="button" class="btn btn-success cart_qty_increment qty_increment"><i class="fas fa-plus"></i></button>
                    </div>

                    <h3 class="ms-3 mb-0 text-success">
                        Total: $<span id="price">{{ number_format($product->offer_price > 0 ? $product->offer_price : $product->price, 2) }}</span><span id="modal_total_price" style="display:none;"></span>
                    </h3>
                </div>
            </div>

            <ul class="details_button_area d-flex flex-wrap mt-3">
                <li><button class="common_btn add_to_cart" type="submit" id="add_to_cart"><i class="fas fa-shopping-basket"></i> Add to Cart</button></li>
            </ul>
        </div>
    </form>
</div>
