@extends('frontend.layouts.master')

@section('title', 'Stripe Payment')
@push('front_style')
    <style type="text/css">
        #card-element {
            height: 50px;
            padding: 14px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            background-color: #fff;
        }
    </style>
@endpush

@section('content')
    <!-- BREADCRUMB START -->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend') }}/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Stripe Payment</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="javascript:;">Payment</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <section class="my-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <div class="card shadow-sm boder-0 p-4">
                        <div class="card-body">
                            <h3 class="mb-4 text-center">Credit or Debit Card Payment</h3>
                            <form action="{{ route('stripe.post') }}" method="POST" id="checkout-form">
                                @csrf
                                <input type="hidden" name="payment_amount" value="{{ $amount }}">
                                <input type="hidden" name="stripeToken" id="stripe-token-id">

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Cardholder Name</label>
                                    <input type="text" class="form-control" name="Name" value="{{ auth()->user()->name }}"
                                        placeholder="Cardholder Name">
                                </div>

                                <div class="mb-4">
                                    <label for="card" class="form-label fw-bold">Card Details</label>
                                    <div id="card-element"></div>
                                </div>

                                <button id="pay-btn" class="common_btn w-100" type="button" onclick="createToken()">
                                    Pay ${{ number_format($amount, 2) }} Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('front_script')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        var elements = stripe.elements();
        var cardEelement = elements.create('card');
        cardEelement.mount('#card-element');

        function createToken() {
            var payBtn = document.getElementById('pay-btn');
            payBtn.disabled = true;
            payBtn.innerText = "Processing Payment...";

            stripe.createToken(cardEelement).then(function (result) {
                if (typeof result.error !== 'undefined') {
                    payBtn.disabled = false;
                    payBtn.innerText = "Pay ${{ number_format($amount, 2) }} Now";
                    toastr.error(result.error.message);
                }

                if (typeof result.token !== 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById("checkout-form").submit();
                }

                if (typeof result.token !== 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            })
        }
    </script>
@endpush