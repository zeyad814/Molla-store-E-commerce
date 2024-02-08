@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front/assets') }}/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                    <form action="{{ route('front.submit.checkout') }}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name" class="form-control" >
                                        @error('first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" name="last_name" class="form-control" >
                                        @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Street address *</label>
                                <input type="text" class="form-control" name="address" placeholder="House number and Street name" >
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" name="town" class="form-control" >
                                        @error('town')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State / County *</label>
                                        <input type="text" name="state" class="form-control" >
                                        @error('state')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP *</label>
                                        <input type="text" name="postal_code" class="form-control" >
                                        @error('postal_code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" name="phone" class="form-control" >
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address *</label>
                                <input type="email" name="email" class="form-control" >
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                <label>Order notes (optional)</label>
                                <textarea class="form-control" cols="30" rows="4" name="notes" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                    @error('notes')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($cartContent as $content )
                                        <tr>
                                            <td><a href="#">{{ $content->product->product_name }} x {{ $content->product_qty }}</a></td>
                                            <td>${{ $content->price*$content->product_qty }}</td>
                                        </tr>
                                        @empty
                                        <h2>no products</h2>
                                        @endforelse


                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ $totalPrice }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>Free shipping</td>
                                        </tr>
                                        <tr>
                                            <td>Discount:</td>
                                            <td>{{ $discount }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ $totalPrice }}</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <div class="accordion-summary" id="accordion-payment">

                                    <div class="card">
                                        <div class="card-header" id="heading-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                    Cash on delivery
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                            {{-- <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                                            </div><!-- End .card-body --> --}}
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    {{-- <div class="card">
                                        <div class="card-header" id="heading-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                    PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card --> --}}


                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
                    <div class="col-lg-9 cart-discount">
                        <form action="{{ route('submit.coupon') }}" method="post">@csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="code"  placeholder="coupon code">
                                <div class="input-group-append">
                                    @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- End .input-group -->
                        </form>
                    </div>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
