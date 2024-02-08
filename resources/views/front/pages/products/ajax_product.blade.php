@foreach ($products as $product)
                        <div class="product product-list">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <figure class="product-media">
                                        <span class="product-label label-new">New</span>
                                        @if($product->stock==0)
                                        <span class="product-label label-out">Out of Stock</span>
                                        @endif
                                        @if($product->product_discount >0)
                                        <span class="product-label label-sale">{{ $product->product_discount }}% off</span>
                                        @endif
                                        <a href="{{ route('front.product.show',$product->id) }}">
                                            <img src="{{ asset('admin/assets/img/products') }}/{{ $product->main_image }}" alt="Product image" class="product-image">
                                        </a>
                                    </figure><!-- End .product-media -->
                                </div><!-- End .col-sm-6 col-lg-3 -->

                                <div class="col-6 col-lg-3 order-lg-last">
                                    <div class="product-list-action">
                                        <div class="product-price">
                                            @if($product->product_discount >0)
                                            <span class="new-price">${{ $product->final_price }}</span>
                                            <span class="old-price">${{ $product->product_price }}</span>
                                            @else
                                            ${{ $product->final_price }}
                                            @endif
                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ getPercentRating($product->id) }}%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( {{ getCountRating($product->id) }} Reviews )</span>
                                        </div><!-- End .rating-container -->
                                        {{-- <div class="product-action">
                                            <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                        </div><!-- End .product-action --> --}}
                                        <form action="{{ route('cartStore',$product->id) }}" method="post">@csrf
                                            <input type="hidden" name="product_qty" value="1" >
                                        <a href="javascript:void(0);" onclick="this.closest('form').submit();"  class="btn-product btn-cart"><span>add to cart</span></a>
                                    </div><!-- End .product-list-action -->
                                </div><!-- End .col-sm-6 col-lg-3 -->
                                        </form>
                                <div class="col-lg-6">
                                    <div class="product-body product-action-inner">
                                        <a onclick="addToWishlist({{ $product->id }})" href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a>
                                        <div class="product-cat">
                                            <a href="#">{{ $product->category->category_name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('front.product.show',$product->id) }}">{{ $product->product_name }}</a></h3><!-- End .product-title -->

                                        <div class="product-content">
                                            <p>{{ $product->description }} </p>
                                        </div><!-- End .product-content -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .product -->
                        @endforeach
