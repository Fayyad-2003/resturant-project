@if (Session::has('coupon'))
    <h6>Total Cart</h6>
    <p>Coupon:
        <span>
            <strong>{{ Session::get('coupon')['code'] }}</strong> &nbsp;
            <i onclick="removeCoupon()" style="cursor: pointer" class="fas fa-times text-danger" title="Remove Coupon"></i>
        </span>
    </p>

    <p>Subtotal: <span>{{ currencyPosition(Cart::total()) }}</span></p>
    <p>Discount:
        <span>
            {{ Session::get('coupon')['discount'] }}{{ Session::get('coupon')['discount_type'] === 'percent' ? '%' : '' }}
            (-{{ currencyPosition(Session::get('coupon')['coupon_discount']) }})
        </span>
    </p>
    <p class="total">
        <span>Total:</span>
        <span
            class="text-success font-weight-bold">{{ currencyPosition(Session::get('coupon')['coupon_discount_amount']) }}</span>
    </p>
@else
    <h6>Total Cart</h6>
    <p>Subtotal: <span>{{ currencyPosition(Cart::total()) }}</span></p>
    <p class="total"><span>Total:</span> <span>{{ currencyPosition(Cart::total()) }}</span></p>
    <form onsubmit="event.preventDefault(); couponApply();">
        <input type="text" placeholder="Coupon Code" id="coupon_code" class="coupon_code" name="coupon_code">
        <button type="button" id="coupon_apply" class="coupon_apply" onclick="couponApply()">Apply</button>
    </form>
@endif