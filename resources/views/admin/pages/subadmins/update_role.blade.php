@extends('admin.layouts.auth')
@section('title', 'update-role')
@section('adminContent')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sub Admins</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Sub admins</li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="content">
            <!-- Default box -->
            @if (!empty($role))
                @foreach ($role as $roles)
                    @if ($roles['module'] == 'cms_pages')
                        @if ($roles['view_access'] == 'on')
                            @php $check_view="checked" @endphp
                        @else
                            @php $check_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_edit="checked" @endphp
                        @else
                            @php $check_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_full="checked" @endphp
                        @else
                            @php $check_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'categories')
                        @if ($roles['view_access'] == 'on')
                            @php $check_category_view="checked" @endphp
                        @else
                            @php $check_category_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_category_edit="checked" @endphp
                        @else
                            @php $check_category_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_category_full="checked" @endphp
                        @else
                            @php $check_category_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'products')
                        @if ($roles['view_access'] == 'on')
                            @php $check_product_view="checked" @endphp
                        @else
                            @php $check_product_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_product_edit="checked" @endphp
                        @else
                            @php $check_product_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_product_full="checked" @endphp
                        @else
                            @php $check_product_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'banners')
                        @if ($roles['view_access'] == 'on')
                            @php $check_banner_view="checked" @endphp
                        @else
                            @php $check_banner_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_banner_edit="checked" @endphp
                        @else
                            @php $check_banner_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_banner_full="checked" @endphp
                        @else
                            @php $check_banner_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'coupons')
                        @if ($roles['view_access'] == 'on')
                            @php $check_coupon_view="checked" @endphp
                        @else
                            @php $check_coupon_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_coupon_edit="checked" @endphp
                        @else
                            @php $check_coupon_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_coupon_full="checked" @endphp
                        @else
                            @php $check_coupon_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'ratings')
                        @if ($roles['view_access'] == 'on')
                            @php $check_rating_view="checked" @endphp
                        @else
                            @php $check_rating_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_rating_edit="checked" @endphp
                        @else
                            @php $check_rating_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_rating_full="checked" @endphp
                        @else
                            @php $check_rating_full="" @endphp
                        @endif
                    @endif
                    @if ($roles['module'] == 'brands')
                        @if ($roles['view_access'] == 'on')
                            @php $check_brand_view="checked" @endphp
                        @else
                            @php $check_brand_view="" @endphp
                        @endif
                        @if ($roles['edit_access'] == 'on')
                            @php $check_brand_edit="checked" @endphp
                        @else
                            @php $check_brand_edit="" @endphp
                        @endif
                        @if ($roles['full_access'] == 'on')
                            @php $check_brand_full="checked" @endphp
                        @else
                            @php $check_brand_full="" @endphp
                        @endif
                    @endif
                @endforeach
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('submitUpdateRoles', $data->id) }}" method="post">@csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">CMS Access</h5>
                                    <div class="mb-3">
                                        <input type="hidden" name="subadmin_id" value="{{ $data->id }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="cms_pages[view]"
                                                @if (isset($check_view)) {{ $check_view }} @endif
                                                type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="cms_pages[edit]"
                                                @if (isset($check_edit)) {{ $check_edit }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                                Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="cms_pages[full]"
                                                @if (isset($check_full)) {{ $check_full }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Category Access</h5>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="categories[view]"
                                                @if (isset($check_category_view)) {{ $check_category_view }} @endif
                                                type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="categories[edit]"
                                                @if (isset($check_category_edit)) {{ $check_category_edit }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                                Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="categories[full]"
                                                @if (isset($check_category_full)) {{ $check_category_full }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Rating Access</h5>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="ratings[view]"
                                                @if (isset($check_rating_view)) {{ $check_rating_view }} @endif
                                                type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="ratings[edit]"
                                                @if (isset($check_rating_edit)) {{ $check_rating_edit }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                                Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="ratings[full]"
                                                @if (isset($check_rating_full)) {{ $check_rating_full }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Brand Access</h5>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[view]"
                                            @if (isset($check_brand_view)) {{ $check_brand_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[edit]"
                                            @if (isset($check_brand_edit)) {{ $check_brand_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[full]"
                                            @if (isset($check_brand_full)) {{ $check_brand_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Product Access</h5>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[view]"
                                            @if (isset($check_product_view)) {{ $check_product_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[edit]"
                                            @if (isset($check_product_edit)) {{ $check_product_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[full]"
                                            @if (isset($check_product_full)) {{ $check_product_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Banner Access</h5>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="banners[view]"
                                                @if (isset($check_banner_view)) {{ $check_banner_view }} @endif
                                                type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">View
                                                Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="banners[edit]"
                                                @if (isset($check_banner_edit)) {{ $check_banner_edit }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                                Access</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="banners[full]"
                                                @if (isset($check_banner_full)) {{ $check_banner_full }} @endif
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Full
                                                Access</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Coupon Access</h5>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="coupons[view]"
                                            @if (isset($check_coupon_view)) {{ $check_coupon_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="coupons[edit]"
                                            @if (isset($check_coupon_edit)) {{ $check_coupon_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="coupons[full]"
                                            @if (isset($check_coupon_full)) {{ $check_coupon_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full
                                            Access</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="pb-5 pt-3">
                    <button class="btn btn-primary" type="submit">submit</button>
                    <a href="{{ route('adminProduct') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
            </form>
            <!-- /.card -->
        </section>

    </main><!-- End #main -->

    {{-- <section class="section">
            <div class="row">
                <div class="col-lg-3 ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Roles for Sub admins</h5>
                            @if (!empty($role))
                                @foreach ($role as $roles)
                                    @if ($roles['module'] == 'cms_pages')
                                        @if ($roles['view_access'] == 'on')
                                            @php $check_view="checked" @endphp
                                        @else
                                            @php $check_view="" @endphp
                                        @endif
                                        @if ($roles['edit_access'] == 'on')
                                            @php $check_edit="checked" @endphp
                                        @else
                                            @php $check_edit="" @endphp
                                        @endif
                                        @if ($roles['full_access'] == 'on')
                                            @php $check_full="checked" @endphp
                                        @else
                                            @php $check_full="" @endphp
                                        @endif
                                    @endif
                                    @if ($roles['module'] == 'categories')
                                        @if ($roles['view_access'] == 'on')
                                            @php $check_category_view="checked" @endphp
                                        @else
                                            @php $check_category_view="" @endphp
                                        @endif
                                        @if ($roles['edit_access'] == 'on')
                                            @php $check_category_edit="checked" @endphp
                                        @else
                                            @php $check_category_edit="" @endphp
                                        @endif
                                        @if ($roles['full_access'] == 'on')
                                            @php $check_category_full="checked" @endphp
                                        @else
                                            @php $check_category_full="" @endphp
                                        @endif
                                    @endif
                                    @if ($roles['module'] == 'products')
                                        @if ($roles['view_access'] == 'on')
                                            @php $check_product_view="checked" @endphp
                                        @else
                                            @php $check_product_view="" @endphp
                                        @endif
                                        @if ($roles['edit_access'] == 'on')
                                            @php $check_product_edit="checked" @endphp
                                        @else
                                            @php $check_product_edit="" @endphp
                                        @endif
                                        @if ($roles['full_access'] == 'on')
                                            @php $check_product_full="checked" @endphp
                                        @else
                                            @php $check_product_full="" @endphp
                                        @endif
                                    @endif
                                    @if ($roles['module'] == 'banners')
                                        @if ($roles['view_access'] == 'on')
                                            @php $check_banner_view="checked" @endphp
                                        @else
                                            @php $check_banner_view="" @endphp
                                        @endif
                                        @if ($roles['edit_access'] == 'on')
                                            @php $check_banner_edit="checked" @endphp
                                        @else
                                            @php $check_banner_edit="" @endphp
                                        @endif
                                        @if ($roles['full_access'] == 'on')
                                            @php $check_banner_full="checked" @endphp
                                        @else
                                            @php $check_banner_full="" @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            <!-- Advanced Form Elements -->
                            <form action="{{ route('submitUpdateRoles', $data->id) }}" method="post">@csrf
                                <div class="row mb-5">
                                    <h3>cms pages:</h3>
                                    <input type="hidden" name="subadmin_id" value="{{ $data->id }}">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="cms_pages[view]"
                                            @if (isset($check_view)) {{ $check_view }} @endif type="checkbox"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="cms_pages[edit]"
                                            @if (isset($check_edit)) {{ $check_edit }} @endif type="checkbox"
                                            id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="cms_pages[full]"
                                            @if (isset($check_full)) {{ $check_full }} @endif type="checkbox"
                                            id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                    <h3>Categories:</h3>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="categories[view]"
                                            @if (isset($check_category_view)) {{ $check_category_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="categories[edit]"
                                            @if (isset($check_category_edit)) {{ $check_category_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="categories[full]"
                                            @if (isset($check_category_full)) {{ $check_category_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                    <h3>Products:</h3>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[view]"
                                            @if (isset($check_product_view)) {{ $check_product_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[edit]"
                                            @if (isset($check_product_edit)) {{ $check_product_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="products[full]"
                                            @if (isset($check_product_full)) {{ $check_product_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                    <h3>Brands:</h3>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[view]"
                                            @if (isset($check_brand_view)) {{ $check_brand_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[edit]"
                                            @if (isset($check_brand_edit)) {{ $check_brand_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="brands[full]"
                                            @if (isset($check_brand_full)) {{ $check_brand_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                    <h3>Brands:</h3>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="banners[view]"
                                            @if (isset($check_banner_view)) {{ $check_banner_view }} @endif
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">View Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="banners[edit]"
                                            @if (isset($check_banner_edit)) {{ $check_banner_edit }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Edit/View
                                            Access</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="banners[full]"
                                            @if (isset($check_banner_full)) {{ $check_banner_full }} @endif
                                            type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Full Access</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </div>

                    </div>

                    </form><!-- End General Form Elements -->

                </div>

            </div>

            </div>

            </div>


            </div>


            </div>

        </section> --}}

    </main><!-- End #main -->

@endsection
