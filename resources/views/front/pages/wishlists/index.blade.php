@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($wishlists as $product)
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                    <a href="#">
                                        <img src="{{ asset('admin/assets/img/products') }}/{{ $product->product->main_image }}" alt="Product image">
                                    </a>
                                </figure>

                                <h3 class="product-title">
                                    <a href="#">{{ $product->product->product_name }}</a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                        <td class="price-col">${{ $product->product->final_price }}</td>
                        <td class="stock-col">@if($product->product->stock==0)<span class="out-of-stock">Out of stock</span>@else<span class="in-stock">In stock</span>@endif</td>
                        <td class="action-col">
                            <form action="{{ route('cartStore',$product->product_id) }}" method="post">@csrf
                                <input type="hidden" name="product_qty" value="1" >
                            <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</a>
                            </form>
                        </td>

                        <td class="remove-col"><a href="{{ route('wishlist.delete',$product->product_id) }}"  class="btn btn-remove"><i class="icon-close"></i></a></td>

                    </tr>
                    @empty
                    <h1>we dont have content to show</h1>
                    @endforelse


                </tbody>
            </table><!-- End .table table-wishlist -->

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
