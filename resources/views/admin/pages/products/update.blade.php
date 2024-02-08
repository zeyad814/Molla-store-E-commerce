@extends('admin.layouts.auth')
@section('title', 'Product')
@section('adminContent')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Layouts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="content-header">
            <div class="container-fluid my-2">

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <form method="post" action="{{ route('updateProduct',$product->id) }}" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <h5 class="card-title">Title</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="product_name" value="{{ $product->product_name }}" id="title"
                                                    class="form-control" placeholder="Title of Product">
                                                @error('product_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="category_description" name="description" style="height: 150px"
                                                    placeholder="Description">{{ $product->description }}</textarea>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Media</h5>
                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label for="inputEmail5" >Main Image</label>
                                        <input type="file" name="main_image" class="form-control" multiple="" id="inputEmail5">
                                        @if(!empty($product->main_image))
                                        <img class="img-fluid img-thumbnail " width="100" height="50" src="{{ asset('admin/assets/img/products/'.$product->main_image) }}">
                                        <a class="deleteCms btn btn-danger" href="{{ route('deleteProductMainImage',$product->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a>
                                        @endif
                                        @error('main_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail5">Image 1</label>
                                        <input type="file" name="image_1" class="form-control" multiple="" id="inputEmail5">
                                        @if(!empty($product->image_1))
                                        <img class="img-fluid img-thumbnail " width="100" height="50" src="{{ asset('admin/assets/img/products/'.$product->image_1) }}">
                                        <a class="deleteCms btn btn-danger" href="{{ route('deleteProductImage1',$product->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a>
                                        @endif
                                        @error('image_1')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail5">Image 2</label>
                                        <input type="file" name="image_2" class="form-control" multiple="" id="inputEmail5">
                                        @if(!empty($product->image_2))
                                        <img class="img-fluid img-thumbnail " width="100" height="50" src="{{ asset('admin/assets/img/products/'.$product->image_2) }}">
                                        <a class="deleteCms btn btn-danger" href="{{ route('deleteProductImage2',$product->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a>
                                        @endif
                                        @error('image_2')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Pricing</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Product Price</label>
                                            <input type="number" name="product_price" id="firstNumber" value="{{ $product->product_price }}" class="form-control"
                                                placeholder="Price">
                                            @error('product_price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($product->discount_type=='category'||$product->discount_type=='brand')
                                    @php $readonly ="readonly";@endphp
                                     @else
                                       @php $readonly=''; @endphp
                                    @endif
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="price">Product discount (%)</label>
                                            <input type="number" {{ $readonly }} name="product_discount" value="{{ $product->product_discount }}" id="secondNumber"
                                                class="form-control" placeholder="discount">
                                            @error('product_discount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="price">Final Price</label>
                                            <input type="number" name="final_price" value="{{ $product->final_price }}" id="result" readonly
                                                class="form-control" placeholder="Final Price">
                                            @error('final_price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Inventory</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" value="{{ $product->sku }}" name="sku" id="sku" class="form-control"
                                                placeholder="sku">
                                            @error('sku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Product Code (optional)</label>
                                            <input type="text" value="{{ $product->product_code }}" name="product_code" id="result" class="form-control"
                                                placeholder="code here...">
                                            @error('product_code')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                        </div>
                                        <div class="mb-3">
                                            <label for="barcode">Stock</label>
                                            <input type="number" value="{{ $product->stock }}" min="0" name="stock" id="qty"
                                                class="form-control" placeholder="Qty">
                                            @error('stock')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Product status</h5>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-select">
                                        @if($product->status==1)
                                        @php $active="selected" @endphp
                                        @else
                                        @php $active="" @endphp
                                        @endif
                                        @if($product->status==0)
                                        @php $inactive="selected" @endphp
                                        @else
                                        @php $inactive="" @endphp
                                        @endif
                                        <option {{ $active }} value="1">Active</option>
                                        <option {{ $inactive }} value="0">Block</option>
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product category</h5>
                                <div class="mb-3">
                                    <select name="category_id" class="form-select">
                                        <option selected value="{{$product->category_id}}">{{$product->category->category_name}}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id  }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="category">Sub category</label>
                                    <select name="sub_category" id="sub_category" class="form-select">
                                        <option value="">Mobile</option>
                                    </select>
                                    @error('sub_category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Product brand</h5>
                                <div class="mb-3">
                                    <select name="brand_id" id="status" class="form-select">
                                        <option selected value="{{$product->brand_id}}">{{$product->brand->brand_name}}</option>
                                        @foreach ($brands as $brand)
                                            <option  value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Featured product</h5>
                                <div class="mb-3">
                                    @if($product->is_featured="yes")
                                        @php $featured="selected" @endphp
                                        @else
                                        @php $featured="" @endphp
                                        @endif
                                        @if($product->is_featured="no")
                                        @php $infeatured="selected" @endphp
                                        @else
                                        @php $infeatured="" @endphp
                                        @endif
                                    <select name="is_featured" id="status" class="form-select">
                                        <option {{ $featured }} value="no">No</option>
                                        <option {{ $infeatured }} value="yes">Yes</option>
                                    </select>
                                    @error('is_featured')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">best Seller</h5>
                                @if(Auth::guard('admin')->user()->type==2)
                                <div class="mb-3">
                                    @if($product->is_bestseller=="yes")
                                        @php $bestseller="selected" @endphp
                                        @else
                                        @php $bestseller="" @endphp
                                        @endif
                                        @if($product->is_bestseller=="no")
                                        @php $inbestseller="selected" @endphp
                                        @else
                                        @php $inbestseller="" @endphp
                                        @endif
                                    <select name="is_bestseller" id="status" class="form-select">
                                        <option {{ $inbestseller  }} value="no">No</option>
                                        <option {{ $bestseller }} value="yes">Yes</option>
                                    </select>
                                    @error('is_bestseller')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                @endif
                            </div>
                        </div>


                    </div>

                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit">Create</button>
                        <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                    </div>
                    </form>
                    <!-- /.card -->
                </section>

    </main><!-- End #main -->

@endsection
@section('customJs')

    <script>
        const firstInput = document.getElementById("firstNumber");
        const secondInput = document.getElementById("secondNumber");
        const resultInput = document.getElementById("result");
        firstInput.addEventListener("input", calculateSum);
        secondInput.addEventListener("input", calculateSum);

        function calculateSum() {
            const firstValue = parseFloat(firstInput.value);
            const secondValue = parseFloat(secondInput.value);

            // Handle potential errors if values are not numbers
            if (!secondInput.value) {
                resultInput.value = firstInput.value;
                return;
            }

            const sum = firstValue - ((firstValue * secondValue) / 100);
            resultInput.value = sum;
        }
        function confirmation(ev)
        {

            ev.preventDefault();

            var url = ev.currentTarget.getAttribute('href');
           console.log(url);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    })
                    window.location.href=url;


                }
                });

        }
    </script>

@endsection
