@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1 class="text-capitalize">Sizes & Options: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-dark text-capitalize">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- ================= Left Column: Product Sizes ================= -->
            <div class="col-12 col-md-6">
                <!-- Create Size Form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><i class="fas fa-expand-arrows-alt"></i> Create Product Size</h4>
                    </div>
                    <form action="{{ route('admin.product-size.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-7 col-12">
                                    <div class="form-group">
                                        <label>Size Name (e.g. Small, Large) <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter size name" required>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label>Price ($) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0 d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Product Base Price: </small>
                                @if ($product->offer_price > 0)
                                    <strong class="text-success">${{ number_format($product->offer_price, 2) }}</strong>
                                    <del class="text-danger small">${{ number_format($product->price, 2) }}</del>
                                @else
                                    <strong class="text-success">${{ number_format($product->price, 2) }}</strong>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Save Size
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Sizes List Table -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><i class="fas fa-list"></i> Available Sizes ({{ count($sizes) }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th>Size Name</th>
                                        <th>Price</th>
                                        <th style="width: 100px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sizes as $index => $size)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td><strong>{{ $size->name }}</strong></td>
                                            <td><span class="badge badge-success">${{ number_format($size->price, 2) }}</span></td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product-size.destroy', $size->id) }}" 
                                                   class="btn btn-danger btn-sm delete-item-btn" 
                                                   title="Delete Size">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">
                                                No sizes added yet for this product.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= Right Column: Product Options ================= -->
            <div class="col-12 col-md-6">
                <!-- Create Option Form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><i class="fas fa-plus-circle"></i> Create Product Option</h4>
                    </div>
                    <form action="{{ route('admin.product-option.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-7 col-12">
                                    <div class="form-group">
                                        <label>Option Name (e.g. Extra Cheese) <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter option name" required>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label>Price ($) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Save Option
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Options List Table -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h4><i class="fas fa-layer-group"></i> Extra Options ({{ count($options) }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th>Option Name</th>
                                        <th>Price</th>
                                        <th style="width: 100px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($options as $index => $option)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td><strong>{{ $option->name }}</strong></td>
                                            <td><span class="badge badge-info">+${{ number_format($option->price, 2) }}</span></td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product-option.destroy', $option->id) }}" 
                                                   class="btn btn-danger btn-sm delete-item-btn" 
                                                   title="Delete Option">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">
                                                No extra options added yet for this product.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        // Universal AJAX delete handler for both Sizes and Options
        $('body').on('click', '.delete-item-btn', function(e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('href');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this item!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn-secondary",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: response.message || "Item deleted successfully.",
                                    icon: "success",
                                    button: "OK",
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                swal("Error!", response.message || "Failed to delete item.", "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            let errorMessage = "Something went wrong while deleting.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            swal("Error!", errorMessage, "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endpush