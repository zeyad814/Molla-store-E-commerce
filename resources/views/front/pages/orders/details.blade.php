@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front/assets') }}/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Order<span>{{ $order->id }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('order.history') }}">orders history</a></li>
                <li class="breadcrumb-item active" aria-current="page">details</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                    <img src="{{ asset('admin/assets/img/products') }}/{{ $product->product->main_image }}">
                                            </figure>

                                            <h3 class="product-title">
                                                {{ $product->product->product_name }} x {{ $product->product_qty }}
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td >${{ $product->product->final_price }}</td>
                                    <td class="total-col">${{ $product->product->final_price*$product->product_qty }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->


                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Order Details</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Order ID:</td>
                                        <td>{{ $order->id }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-subtotal">
                                        <td>Date Purchased:</td>
                                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-subtotal">
                                        <td>Status:</td>
                                        <td>
                                            @if($order->status=="delivered")
                                                <span class="badge bg-success">Delivered</span>
                                                @endif
                                                @if($order->status=="rejected")
                                                <span class="badge bg-danger">Rejected</span>
                                                @endif
                                                @if($order->status=="pending")
                                                <span class="badge bg-warning">Pending</span>
                                                @endif
                                        </td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-subtotal">
                                        <td>Discount @if($order->discount>0)({{ $order->coupon_code }})@endif:</td>
                                        <td>{{ $order->discount }}</td>
                                    </tr><!-- End .summary-subtotal -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>${{ $order->total }}</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                        </div><!-- End .summary -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection

