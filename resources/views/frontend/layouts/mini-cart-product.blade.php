@forelse ($cartproducts as $product)
    <li>
        <div class="menu_cart_img">
            <img src="{{ asset($product->options->thumbnail) }}" alt="menu" class="img-fluid w-100">
        </div>
        <div class="menu_cart_text">
            <a class="title" href="javascript:;">{{ $product->name }}</a>
            @if ($product->options->size_name)
                <p class="size">
                    {{ $product->options->size_name }} -
                    ({{ currencyPosition($product->options->size_price) }})
                </p>
            @endif
            @if (!empty($product->options->options))
                @foreach ($product->options->options as $opt)
                    <span class="extra">{{ $opt['name'] }}</span>
                @endforeach
            @endif
            @if ($product->price)
                <p class="price">{{ currencyPosition($product->price) }} <span class="text-black">*</span> {{ $product->qty }}</p>
            @endif
        </div>
        <span class="del_icon remove_mini_cart_item" id="{{ $product->rowId }}" onclick="removeMiniCartItem(this.id)" style="cursor: pointer;">
            <i class="fas fa-times"></i>
        </span>
    </li>
@empty
    <li class="text-center py-4 text-muted">
        Your cart is empty!
    </li>
@endforelse
