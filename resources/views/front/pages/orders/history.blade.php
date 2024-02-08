@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front/assets') }}/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">MY ORDERS<span></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">orders history</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @error('product_qty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date Purchased</th>
                                    <th>status</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- @forelse (session('cart') as $content) --}}
                                {{-- @if(Auth::check()==true) --}}
                                @forelse ($orders as $order)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <h3 class="product-title">
                                                <a href="{{ route('order.details',$order->id) }}">{{ $order->id }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="">{{\Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                    <td class="">
                                        <div class="product">
                                            <h3 class="product-title">
                                                @if($order->status=="delivered")
                                                <span class="badge bg-success">Delivered</span>
                                                @endif
                                                @if($order->status=="rejected")
                                                <span class="badge bg-danger">Rejected</span>
                                                @endif
                                                @if($order->status=="pending")
                                                <span class="badge bg-warning">Pending</span>
                                                @endif

                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->

                                    </td>
                                    <td class="total-col">${{ $order->total }}</td>
                                </tr>
                                @empty
                                <h1>the cart is Empty</h1>
                                @endforelse
                                {{-- @endif --}}

                            </tbody>
                        </table><!-- End .table table-wishlist -->

                    </div><!-- End .col-lg-9 -->
                            </form>

                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
