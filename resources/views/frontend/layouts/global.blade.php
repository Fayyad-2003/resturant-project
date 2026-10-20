{{-- Global Scripts and Modals --}}

<script>
    // 1. Open Quick View Modal via AJAX
    function loadProductModal(productId) {
        $.ajax({
            type: "GET",
            url: "{{ url('/product-quick-view') }}/" + productId,
            success: function(response) {
                $('#modal_content').html(response);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Failed to load product modal", error);
            }
        });
    }

    // 2. Dynamic Price Calculator inside Quick View Modal
    $(document).ready(function() {
        // When size changes
        $(document).on('change', '.product_size_radio', function() {
            calculateTotalPrice();
        });

        // When option checkbox changes
        $(document).on('change', '.product_option_checkbox', function() {
            calculateTotalPrice();
        });

        // Quantity Increment
        $(document).on('click', '.qty_increment', function() {
            let qtyInput = $('#modal_quantity');
            let currentQty = parseInt(qtyInput.val()) || 1;
            qtyInput.val(currentQty + 1);
            calculateTotalPrice();
        });

        // Quantity Decrement
        $(document).on('click', '.qty_decrement', function() {
            let qtyInput = $('#modal_quantity');
            let currentQty = parseInt(qtyInput.val()) || 1;
            if (currentQty > 1) {
                qtyInput.val(currentQty - 1);
                calculateTotalPrice();
            }
        });

        // Calculation Function
        function calculateTotalPrice() {
            let basePrice = parseFloat($('#base_price').val()) || 0;
            let sizePrice = 0;
            let optionsPrice = 0;
            let quantity = parseInt($('#modal_quantity').val()) || 1;

            let selectedSize = $('.product_size_radio:checked');
            if (selectedSize.length > 0) {
                sizePrice = parseFloat(selectedSize.data('price')) || 0;
            }

            $('.product_option_checkbox:checked').each(function() {
                optionsPrice += parseFloat($(this).data('price')) || 0;
            });

            let total = (basePrice + sizePrice + optionsPrice) * quantity;
            $('#modal_total_price').text(total.toFixed(2));
        }

        // 3. Add to Cart via AJAX (Exact Complete Version Flow)
        $(document).off('submit', '.cart_form').on('submit', '.cart_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('add.to.cart') }}",
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $('#add_to_cart').prop('disabled', true).text('Adding...');
                },
                success: function(response) {
                    cartCount();
                    minicart();
                    if (typeof myCartContent === 'function') {
                        myCartContent();
                    }
                    $('#cartModal').modal('hide');
                    toastr.success(response);
                },
                error: function(xhr) {
                    console.error("Add to cart error:", xhr);
                    toastr.error("Failed to add product to cart.");
                },
                complete: function() {
                    $('#add_to_cart').prop('disabled', false).html('<i class="fas fa-shopping-basket"></i> Add to Cart');
                }
            });
        });

        // Direct click fallback for the Add to Cart button
        $(document).off('click', '#add_to_cart').on('click', '#add_to_cart', function(e) {
            e.preventDefault();
            $(this).closest('form').submit();
        });
    });

    // 4. Show Mini-Cart Sidebar Products
    function minicart() {
        $.ajax({
            type: "GET",
            url: "{{ route('mini.cart.content') }}",
            dataType: "html",
            success: function(response) {
                $('#minicart_products').html(response);
            }
        });
    }
    minicart(); // Call on page load

    // 5. Get Cart Count & Subtotal
    function cartCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('cart.count') }}",
            dataType: "json",
            success: function(response) {
                $('.cart_count').html(response.cartcount);
                $('.subtotal_price').html(response.carttotal);
            }
        });
    }
    cartCount(); // Call on page load

    // 6. Remove Mini-Cart Item
    function removeMiniCartItem(rowId) {
        $.ajax({
            type: "POST",
            url: "{{ route('remove.cart.item') }}",
            data: {
                rowId: rowId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                cartCount();
                minicart();
                myCartContent();
                toastr.success(response);
            },
            error: function() {
                toastr.error("Failed to remove item.");
            }
        });
    }

    // Load Full Cart Page Content
    function myCartContent(){
        $.ajax({
            type: "GET",
            url: "{{ route('my.cart.content') }}",
            dataType: "html",
            success: function(response) {
                $('#my_cart_page_content').html(response);
            }
        });
    }
    myCartContent();

    // Increment Quantity
    function cartIncrement(rowId) {
        $.ajax({
            type: "POST",
            url: "{{ route('cart.qty.increment') }}",
            data: {
                rowId: rowId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                cartCount();
                minicart();
                myCartContent();
                toastr.success(response);
            }
        })
    }

    // Decrement Quantity
    function cartDecrement(rowId) {
        $.ajax({
            type: "POST",
            url: "{{ route('cart.qty.decrement') }}",
            data: {
                rowId: rowId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                cartCount();
                minicart();
                myCartContent();
                toastr.success(response);
            }
        });
    }

    // Clear All Cart
    function cartClear() {
        $.ajax({
            type: "POST",
            url: "{{ route('cart.clear') }}",
            data: {
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                cartCount();
                minicart();
                myCartContent();
                toastr.success(response);
            }
        });
    }

</script>
