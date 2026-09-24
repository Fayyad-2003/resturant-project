{{-- Product Quick View Modal --}}
<div class="modal-body">
    <button type="button" class="btn-close" aria-label="Close"><i class="fas fa-times"></i></button>
    <div class="fp__cart_popup_img">
        <img src="$product->thumbnail" alt="menu" class="img-fluid w-100">
    </div>
    <form class="fp__menu_details_text cart_form" id="cart_form">
        <input type="hidden" name="product_id" value="1">
        <input type="hidden" id="main_price" class="main_price" value="25.00" name="main_price">
        <div class="fp__cart_popup_text">
            <a class="title">Sample Title</a>
            <p class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
                <span>(201)</span>
            </p>

            <h4 class="price">25.00
                <del>25.00</del>
            </h4>

            <h4 class="price">25.00 </h4>

            <div class="details_size">
                <h5>select size</h5>

                <div class="form-check">
                    <input class="form-check-input checkbox" type="radio" name="product_price" id="size-Admin User"
                        value="1">
                    <label class="form-check-label" for="size-Admin User">
                        Admin User <span>+25.00</span>
                    </label>
                </div>

            </div>

            <div class="details_extra_item">
                <h5>select option <span>(optional)</span></h5>

                <div class="form-check">
                    <input class="form-check-input checkbox" type="checkbox" value="1" id="option-Admin User"
                        name="product_ptions[]">
                    <label class="form-check-label" for="option-Admin User">
                        Admin User <span>+25.00</span>
                    </label>
                </div>

            </div>

            <div class="details_quentity">
                <h5>select quentity</h5>
                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                    <div class="quentity_btn">
                        <button type="button" class="btn btn-danger cart_qty_decrement" id="cart_qty_decrement"><i
                                class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" name="quantity" id="quantity"
                            class="quantity" style="width: 110px; ">
                        <button type="button" class="btn btn-success cart_qty_increment " id="cart_qty_increment"><i
                                class="fas fa-plus"></i></button>
                    </div>

                    <h3>FoodPark<h3 id="price" style="margin-left: 0 !important;">25.00
                        </h3>
                    </h3>

                    <h3>FoodPark<h3 id="price" style="margin-left: 0 !important;">25.00</h3>
                    </h3>

                </div>
            </div>
            <ul class="details_button_area d-flex flex-wrap">
                <li><button class="common_btn add_to_cart" type="submit" id="add_to_cart">add to cart</button></li>
            </ul>
        </div>
    </form>
</div>
