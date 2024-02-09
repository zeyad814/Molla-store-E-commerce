@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front/assets') }}/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @error('product_qty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- @forelse (session('cart') as $content) --}}
                                @if(Auth::check()==true)
                                @forelse ($cartContent as $content)
                            <form action="{{ route('cart.update',$content->id) }}"></form>
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{ asset('admin/assets/img/products') }}/{{ $content->product->main_image }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="#">{{ $content->product->product_name }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">${{ $content->price }}</td>
                                    <td class="quantity-col">
                                        {{-- <div class="cart-product-quantity"> --}}
                                            @if($content->product->stock==0)
                                            <span class="out-of-stock">Out of stock</span>
                                            @else
                                            @php $plus="plus"; $minus="minus"; @endphp
                                            <a href="{{ route('increment.cart.quantity',$content->id) }}" ><i class="bi bi-file-plus"></i></a>
                                            {{ $content->product_qty }}
                                            <a href="{{ route('decrement.cart.quantity',$content->id) }}"><i class="bi bi-file-minus"></i></a>
                                            @endif
                                            {{-- </div><!-- End .cart-product-quantity --> --}}
                                    </td>
                                    <td class="total-col">${{ $content->price * $content->product_qty }}</td>
                                    <td class="remove-col"><a href="{{ route('deleteCart',$content->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                                </tr>
                                @empty
                                <h1>the cart is Empty</h1>
                                @endforelse
                                @endif
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                        {{ $cartContent->links() }}


                    </div><!-- End .col-lg-9 -->
                            </form>

                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>$@if(Auth::check()==true){{ $totalPrice }}@endif</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="free-shipping" checked name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$0.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    {{-- <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$10.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="express-shipping">Express:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$20.00</td>
                                    </tr><!-- End .summary-shipping-row --> --}}

                                    <tr class="summary-shipping-estimate">
                                        {{-- <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td> --}}
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>$@if(Auth::check()==true){{ $totalPrice }}@endif</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            <a href="{{ route('front.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                        </div><!-- End .summary -->

                        <a href="{{ route('front.products') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
@section('frontJs')

<script>
    $('.add').click(function(){
      var qtyElement = $(this).parent().prev(); // Qty Input
      var qtyValue = parseInt(qtyElement.val());
      if (qtyValue < 10) {
          qtyElement.val(qtyValue+1);
      }
  });

  $('.sub').click(function(){
      var qtyElement = $(this).parent().next();
      var qtyValue = parseInt(qtyElement.val());
      if (qtyValue > 1) {
          qtyElement.val(qtyValue-1);
      }
  });
</script>

@endsection
