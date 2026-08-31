$(document).ready(function () {
    // product price with attributes
    $(document).on("change", 'input[name="product_price"]', function (e) {
        e.preventDefault();
        updateTotalPrice();
    });

    // product price option with attribute
    $(document).on("change", 'input[name="product_ptions[]"]', function (e) {
        e.preventDefault();
        updateTotalPrice();
    });

    // increment value
    $(document).on("click", ".cart_qty_increment", function (e) {
        e.preventDefault();
        let quantity = parseFloat($("#quantity").val()) || 1;
        quantity += 1;
        $("#quantity").val(quantity);
        updateTotalPrice(); // calling function
    });

    // increment value
    $(document).on("click", ".cart_qty_decrement", function (e) {
        e.preventDefault();
        let quantity = parseFloat($("#quantity").val()) || 1;
        if (quantity > 1) {
            quantity -= 1;
        }
        $("#quantity").val(quantity);
        updateTotalPrice(); // calling function
    });

    // start function
    function updateTotalPrice() {
        let quantity = parseFloat($("#quantity").val()) || 1;
        let main_price = parseFloat($("#main_price").val());
        let productPrice = 0;
        let productOptions = 0;

        let productPriceSelected = $('input[name="product_price"]:checked');
        if (productPriceSelected.length > 0) {
            productPrice += parseFloat(productPriceSelected.data("price"));
        }

        let productOptionsSelected = $(
            'input[name="product_ptions[]"]:checked'
        );

        $(productOptionsSelected).each(function () {
            if (productOptionsSelected.length > 0) {
                productOptions += parseFloat($(this).data("price"));
            }
        });

        let totalPrice =
            (main_price + productPrice + productOptions) * quantity;
        $("#price").text(totalPrice);
    }
});

// product quickview
function quickView(id) {
    $.ajax({
        type: "GET",
        url: route("product-quick-view"),
        data: {
            id: id,
        },
        dataType: "html",
        beforeSend: function () {
            $("#premiumLoader").removeClass("d-none");
        },
        success: function (response) {
            $("#modal_content").html(response);
            $("#cartModal").modal("show");
        },
        error: function () {},
        complete: function () {
            $("#premiumLoader").addClass("d-none");
        },
    });
}

// seet alert notification start
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    customClass: {
        popup: "colored-toast",
    },
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
});
// seet alert notification end

// add to cart
$(document).ready(function () {
    $(document).on("submit", ".cart_form", function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: route("add.to.cart"),
            data: formData,
            dataType: "json",
            success: function (response) {
                cartCount();
                minicart();
                Toast.fire({
                    icon: "success",
                    title: response,
                });
            },
        });
    });
});

// show minicart sidebar product
function minicart() {
    $.ajax({
        type: "GET",
        url: route("mini.cart.content"),
        // data: "data",
        dataType: "html",
        success: function (response) {
            $("#minicart_products").html(response);
        },
    });
}
minicart(); // calling function here

function cartCount() {
    $.ajax({
        type: "GET",
        url: route("cart.count"),
        // data: "data",
        dataType: "json",
        success: function (response) {
            $(".cart_count").html(response.cartcount);
            $(".subtotal_price").html(response.carttotal);
        },
    });
}
cartCount(); //calling

// remove mini cart item
function removeMiniCartItem(rowId) {
    $.ajax({
        type: "POST",
        url: route("remove.cart.item"),
        data: {
            rowId: rowId,
        },
        dataType: "JSON",
        success: function (response) {
            cartCount();
            minicart();
            myCartContent();
            couponCalculation();
            Toast.fire({
                icon: "warning",
                title: response,
            });
        },
    });
}

// show my cart view content
function myCartContent() {
    $.ajax({
        type: "GET",
        url: route("my.cart.content"),
        dataType: "html",
        success: function (response) {
            $("#my_cart_page_content").html(response);
        },
    });
}
myCartContent(); //calling

// cart qty increment
function cartIncrement(rowId) {
    $.ajax({
        type: "POST",
        url: route("cart.qty.increment"),
        data: {
            rowId: rowId,
        },
        dataType: "json",
        success: function (response) {
            cartCount();
            minicart();
            myCartContent();
            couponCalculation();
            checkoutContent();
            Toast.fire({
                icon: "success",
                title: response,
            });
        },
    });
}
// cart qty decrement
function cartDecrement(rowId) {
    $.ajax({
        type: "POST",
        url: route("cart.qty.decrement"),
        data: {
            rowId: rowId,
        },
        dataType: "json",
        success: function (response) {
            cartCount();
            minicart();
            myCartContent();
            couponCalculation();
            checkoutContent();
            Toast.fire({
                icon: "success",
                title: response,
            });
        },
    });
}

/**
 * cart celar
 */

/**coupon */
function couponApply() {
    var coupondata = $(".coupon_code").val();
    $.ajax({
        type: "GET",
        url: route("coupon.apply"),
        data: {
            coupondata: coupondata,
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                Toast.fire({
                    icon: "success",
                    title: response.success,
                });
                couponCalculation(); // caupon calculation calling
            } else {
                Toast.fire({
                    icon: "error",
                    title: response.error,
                });
            }
        },
    });
}

//  coupon calculation
function couponCalculation() {
    $.ajax({
        type: "GET",
        url: route("coupon.calculation"),
        dataType: "html",
        success: function (response) {
            $("#coupon_calculation").html(response);
        },
    });
}
couponCalculation();

// remove coupon
function removeCoupon() {
    $.ajax({
        type: "GET",
        url: route("coupon.remove"),
        dataType: "json",
        success: function (response) {
            couponCalculation();
            Toast.fire({
                icon: "success",
                title: response.success,
            });
        },
    });
}

// clear cart
function cartClear() {
    $.ajax({
        type: "POST",
        url: route("cart.clear"),
        dataType: "json",
        success: function (response) {
            Toast.fire({
                icon: "success",
                title: response,
            });
            cartCount();
            minicart();
            myCartContent();
            couponCalculation();
        },
    });
}

// checkout content
function checkoutContent() {
    $.ajax({
        type: "GET",
        url: route("checkout.content"),
        dataType: "html",
        success: function (response) {
            minicart();
            myCartContent();
            couponCalculation();
            $(".checkout_content").html(response);
        },
    });
}
checkoutContent();

// ****************************************wishlist all routes*******************
function addToWishlist(id) {
    $.ajax({
        type: "POST",
        url: route("add.wishlist"),
        data: { id: id },
        dataType: "json",
        success: function (response) {
            if (response.status == "success") {
                Toast.fire({
                    icon: "success",
                    title: response.message,
                });
            } else {
                Toast.fire({
                    icon: "error",
                    title: response.message,
                });
            }
        },
    });
}
