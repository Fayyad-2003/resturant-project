@foreach($cartproducts as $product)
    <tr>
        <td class="fp__pro_img">
            <img src="{{ asset($product->options->thumbnail) }}" class="img-fluid w-100" alt="product">
        </td>

        <td class="fp__pro_name">
            <a href="#">{{ $product->name }}</a>
            @if($product->options->size_name)
                <span>
                    {{ $product->options->size_name }}
                    ({{ currencyPosition($product->options->size_price) }})
                </span>
            @endif

            @foreach($product->options->options as $opt)
                <p>{{ $opt['name'] }} - {{ currencyPosition($opt['price']) }}</p>
            @endforeach
        </td>

        <td class="fp__pro_status">
            <h6>{{ currencyPosition($product->price) }}</h6>
        </td>

        <td class="fp__pro_select">
            <div class="quentity_btn">
                <button class="btn btn-danger" id="{{ $product->rowId }}" type="button" {{ $product->qty > 1 ? '' : 'disabled' }} onclick="cartDecrement(this.id)">
                    <i class="fas fa-minus"></i>
                </button>

                <input type="text" placeholder="1" value="{{ $product->qty }}" readonly name="cart_qty" />
                <button class="btn btn-success" id="{{ $product->rowId }}" type="button" onclick="cartIncrement(this.id)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </td>

        <td class="fp__pro_tk">
            <h6>{{ currencyPosition($product->subtotal) }}</h6>
        </td>

        <td class="fp__pro_icon">
            <a type="button" id="{{ $product->rowId }}" onclick="removeMiniCartItem(this.id)">
                <i class="fas fa-times"></i>
            </a>
        </td>
    </tr>
@endforeach
