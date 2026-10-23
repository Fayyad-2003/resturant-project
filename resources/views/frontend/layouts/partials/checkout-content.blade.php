@foreach (Cart::content() as $product)
    <div class="my-2 border rounded p-2">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ asset($product->options->product_info['image'] ?? 'frontend/images/banner2_img_2.jpg') }}"
                class="img-thumbnail me-2" style="height: 50px; width: 65px; object-fit: cover;" alt="{{ $product->name }}">
            <div class="flex-grow-1">
                <h6 class="mb-0 fs-6">{{ $product->name }}</h6>
                <strong class="text-muted small">Price: {{ currencyPosition($product->price) }}</strong>
            </div>
        </div>

        <div class="ps-1 small text-muted">
            @if (!empty($product->options->size_name))
                <p class="mb-1">
                    <strong>Size:</strong> {{ $product->options->size_name }}
                </p>
            @endif

            @if (!empty($product->options->options))
                <p class="mb-1">
                    <strong>Options:</strong>
                    @foreach ($product->options->options as $item)
                        {{ $item['name'] }} ({{ currencyPosition($item['price']) }}){{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </p>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
            <span class="small">
                Total: <strong>{{ currencyPosition($product->price * $product->qty) }}</strong>
            </span>

            <div class="d-flex align-items-center">
                <button class="btn btn-danger btn-sm py-0 px-2" id="{{ $product->rowId }}" type="button"
                    onclick="cartDecrement(this.id)" {{ $product->qty <= 1 ? 'disabled' : '' }}>
                    -
                </button>

                <span class="mx-2 fw-bold">
                    {{ $product->qty }}
                </span>

                <button class="btn btn-success btn-sm py-0 px-2" id="{{ $product->rowId }}" type="button"
                    onclick="cartIncrement(this.id)">
                    +
                </button>
            </div>
        </div>
    </div>
@endforeach