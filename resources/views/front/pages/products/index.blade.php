@extends('front.layouts.auth')
@section('frontContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front/assets') }}/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">List<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="latest" {{ ($sort  == 'latest' ? 'selected':'') }} >Latest</option>
                                        <option value="price_desc" {{ ($sort  == 'price_desc' ? 'selected':'') }}>High price</option>
                                        <option value="price_asc" {{ ($sort  == 'price_asc' ? 'selected':'') }}>Low Price</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->

                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                     @include('front.pages.products.ajax_product')
                     {{ $products->links() }}
                    </div>
                </div><!-- End .col-lg-9 -->
               @include('front.pages.products.filter')
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
@section('frontJs')

<script>

    rangeSlider=$(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: {{ $priceMin }},
        skin: "round",
        max_postfix: "+",
        prefix: "$",
        to: {{ $priceMax }},
        grid: true,
        onFinish: function(){
            apply_filters()
        }
    });
    var slider=$(".js-range-slider").data("ionRangeSlider");

    $(".brand-label").change(function() {
        apply_filters();
    });
    $("#sort").change(function(){
        apply_filters();
    });
    $("#rating-label").change(function(){
        apply_filters();
    });
    function apply_filters(){
        var brands =[];
        var rates=[];

        $(".brand-label").each(function(){
            if($(this).is(":checked")== true){
                brands.push($(this).val())
            }
        });
        $(".rating-label").each(function(){
            if($(this).is(":checked")== true){
                rates.push($(this).val())
            }
        });
        console.log(rates.toString());

        var url = '{{ url()->current() }}?';
        // range filter
        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;
        // sort filter
        url += '&sort='+$("#sort").val()
        //search filter
        var keywords = $("#search").val();

        if(keywords.length > 0){
            url += '&search='+keywords;
        }

        window.location.href = url+'&brand='+brands.toString();
    }

</script>


@endsection

