@extends('front.layouts.auth')
@section('frontContent')
<style>
    *{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Centered</li>
            </ol>

            {{-- <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav><!-- End .pager-nav --> --}}
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <br>
    @error('comment')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

@error('rating')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('description')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<br>
    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <span class="product-label label-new">New</span>
                                    @if($product->stock==0)
                                    <span class="product-label label-out">Out of Stock</span>
                                    @endif
                                    @if($product->product_discount > 0)
                                    <span class="product-label label-sale">{{ $product->product_discount }}% off</span>
                                    @endif
                                    <img id="product-zoom" src="{{ asset('admin/assets/img/products') }}/{{ $product->main_image }}" data-zoom-image="{{ asset('front/assets') }}/images/products/single/centered/1-big.jpg" alt="product image">


                                </figure><!-- End .product-main-image -->

                                {{-- <div id="product-zoom-gallery" class="product-image-gallery">
                                    <a class="product-gallery-item active" href="#" data-image="{{ asset('front/assets') }}/images/products/single/centered/1.jpg" data-zoom-image="{{ asset('front/assets') }}/images/products/single/centered/1-big.jpg">
                                        <img src="{{ asset('front/assets') }}/images/products/single/centered/1-small.jpg" alt="product side">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="{{ asset('front/assets') }}/images/products/single/centered/2.jpg" data-zoom-image="{{ asset('front/assets') }}/images/products/single/centered/2-big.jpg">
                                        <img src="{{ asset('front/assets') }}/images/products/single/centered/2-small.jpg" alt="product cross">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="{{ asset('front/assets') }}/images/products/single/centered/3.jpg" data-zoom-image="{{ asset('front/assets') }}/images/products/single/centered/3-big.jpg">
                                        <img src="{{ asset('front/assets') }}/images/products/single/centered/3-small.jpg" alt="product with model">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="{{ asset('front/assets') }}/images/products/single/centered/4.jpg" data-zoom-image="{{ asset('front/assets') }}/images/products/single/centered/4-big.jpg">
                                        <img src="{{ asset('front/assets') }}/images/products/single/centered/4-small.jpg" alt="product back">
                                    </a>
                                </div><!-- End .product-image-gallery --> --}}
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">

                        <div class="product-details product-details-centered">

                            <h1 class="product-title">{{ $product->product_name }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ getPercentRating($product->id) }}%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( {{ getCountRating($product->id) }} Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                @if($product->product_discount>0)
                                <span class="new-price">${{ $product->final_price }}</span>
                                <span class="old-price">${{ $product->product_price }}</span>
                                @else
                                ${{ $product->final_price }}
                                @endif
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero.</p>
                            </div><!-- End .product-content -->

                            {{-- <div class="details-filter-row details-row-size">
                                <label>Color:</label>

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .details-filter-row --> --}}

                            {{-- <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="form-control">
                                        <option value="#" selected="selected">One Size</option>
                                        <option value="s">Small</option>
                                        <option value="m">Medium</option>
                                        <option value="l">Large</option>
                                        <option value="xl">Extra Large</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                            </div><!-- End .details-filter-row --> --}}
                            <form action="{{ route('cartStore',$product->id) }}" method="post" >@csrf
                            <div class="product-details-action">
                                <div class="details-action-col">
                                    @error('product_qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" name="product_qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="image" value="{{ $product->main_image }}">
                                    <input type="hidden" name="price" value="{{ $product->final_price }}">
                                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                                    {{-- <input type="hidden" name="user_id"  value="{{ Auth::guard('web')->user()->id }}" > --}}
                                    <button type="submit" class="btn-product btn-cart">
                                        <span>add to cart</span>
                                    </button>
                                </form>
                                </div><!-- End .details-action-col -->
                                <div class="details-action-wrapper">
                                    <a href="#" onclick="addToWishlist({{ $product->id }})" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    {{-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> --}}
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{ route('front.products',$product->category->id) }}">{{ $product->category->category_name }}</a>
                                    {{-- <a href="#">Dresses</a>, --}}
                                    {{-- <a href="#">Yellow</a> --}}
                                </div><!-- End .product-cat -->

                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a> q --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $count }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            <p>{{ $product->description }}</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    {{-- <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                            <h3>Fabric & care</h3>
                            <ul>
                                <li>Faux suede fabric</li>
                                <li>Gold tone metal hoop handles.</li>
                                <li>RI branding</li>
                                <li>Snake print trim interior </li>
                                <li>Adjustable cross body strap</li>
                                <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                            </ul>

                            <h3>Size</h3>
                            <p>one size</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane --> --}}
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <h5>Reviews ({{ getCountRating($product->id) }})</h5>
                        @foreach ($productReview as $review)
                        <div class="reviews">
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">{{ $review->name }}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $review->rating*20 }}%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>{{ $review->comment }}</h4>

                                        <div class="review-content">
                                            <p>{{ $review->description }}</p>
                                        </div><!-- End .review-content -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                        </div><!-- End .reviews -->
                        @endforeach
                        <br>
                        <div class="col-lg-12">
                			<h2 class="title mb-1">If you want Rate this Product</h2><!-- End .title mb-2 -->
                			<p class="mb-2">Use the form below to rate</p>

                			<form action="{{ route('rate.store') }}" method="post"  class="contact-form mb-3">@csrf
                				<div class="row">
                					<div class="col-sm-6">
                                        <label for="cname" class="sr-only">Name</label>
                						<input type="text" class="form-control" name="name" id="cname" placeholder="Name *" required>
                					</div><!-- End .col-sm-6 -->
                					<div class="col-sm-6">
                                        <label for="cemail" class="sr-only">Email</label>
                						<input type="email" class="form-control" name="email" id="cemail" placeholder="Email *" required>
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->

                					<div class="col-sm-12">
                                        <label for="csubject" class="sr-only">Comment</label>
                						<input type="text" name="comment" class="form-control" required id="csubject" placeholder="Message">
                                        @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                					</div><!-- End .col-sm-6 -->
                					<div class="col-sm-12">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                          </div>
                					</div><!-- End .col-sm-6 -->
                				</div><!-- End .row -->
                                @error('rating')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="cmessage" class="sr-only">Message</label>
                				<textarea class="form-control" name="description" cols="30" rows="4" id="cmessage" placeholder="Description *"></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                				<button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                					<span>SUBMIT</span>
            						<i class="icon-long-arrow-right"></i>
                				</button>
                			</form><!-- End .contact-form -->
                		</div><!-- End .col-lg-6 -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                @foreach ($relatedProducts as $relatedProduct )
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        @if($relatedProduct->stock==0)
                        <span class="product-label label-out">Out of Stock</span>
                        @endif
                        {{-- <span class="product-label label-top">Top</span> --}}
                        <a href="{{ route('front.product.show',$relatedProduct->id) }}">
                            <img src="{{ asset('admin/assets/img/products') }}/{{ $relatedProduct->main_image }}" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" onclick="addToWishlist({{ $relatedProduct->id }})" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div><!-- End .product-action-vertical -->

                        {{-- <div class="product-action">
                            <form action="{{ route('cartStore',$relatedProduct->id) }}" method="post" >@csrf
                            <a href="javascript:void();" onclick="this.closest('form').submit();"  class="btn-product btn-cart"><span>add to cart</span></a>
                            </form>
                        </div><!-- End .product-action --> --}}
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{ route('front.products',$relatedProduct->category->id) }}">{{ $relatedProduct->category->category_name }}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{ route('front.product.show',$relatedProduct->id) }}">{{ $relatedProduct->product_name }}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            ${{ $relatedProduct->final_price }}
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: {{ getPercentRating($relatedProduct->id) }}%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( {{ getCountRating($relatedProduct->id) }} Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
@section('frontJs')
<script>


    // $(document).ready(function(){
    //     $("#addToCart").submit(function(){
    //         var formData = $(this).serialize();
    //         alert(formData);
    //         $.ajax({
    //             type: 'post',
    //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             data:formData,
    //             success:function(resp)
    //             {
    //                 if(resp['status']==true){
    //                     $('.print-success-message').show();
    //                     $('.print-success-message').delay(3000).fadeOut('slow');
    //                     $('.print-success-message').html("<div class='alert alert-success'><strong>success</strong>product added successfully </div>")
    //                 }else{
    //                     $('.print-error-message').show();
    //                     $('.print-error-message').delay(3000).fadeOut('slow');
    //                     $('.print-error-message').html("<div class='alert alert-danger'><strong>Danger!</strong>"+resp['message']+"</div>")
    //                 }
    //             },
    //             error:function(){
    //                 alert("Error");
    //             }
    //                 })
    //     })
    // });


</script>
@endsection
