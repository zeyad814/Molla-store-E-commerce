@extends('admin.layouts.auth')
@section('title','Products')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>PRODUCTS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">products</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <form action="{{ route('adminProduct') }}" method="get">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                          <input type="text" name="search" class="form-control" placeholder="Search Category..." value="{{ request()->query('search') }}">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                              <a href="{{ route('adminProduct') }}" class="btn btn-default">
                                <i class="fas fa-close"></i>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
              <h5 class="card-title">Product Table</h5>
              @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <a href="{{ route('createProduct') }}" class="btn btn-primary btn-lg active  " data-mdb-ripple-init role="button" aria-pressed="true">Add Product</a>
                  </div>
              @endif
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Product category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>
                                <img src="{{ asset('admin/assets/img/products') }}/{{ $product->main_image }}" class="img-fluid img-thumbnail" width="80" height="20" alt="Sheep">
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ $product->final_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                                <div class="table-actions">
                                    @if($product->status==1)
                                    <a class="updateProductStatus btn btn-primary" href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}"  ><i class="fas fa-toggle-on" status="Active" ></i></a>
                                    @endif
                                    @if($product->status==0)
                                    <a class="updateProductStatus btn btn-primary" href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}"  ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                                    @endif
                                    <a href="{{ route('editProduct',$product->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                                @endif
                                    @if($pageModule['full_access']=="on")
                                    <a class="btn btn-danger" href="{{ route('deleteProduct',$product->id) }}" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h1>we dont have products</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
@section('customJs')
<script>

    $(document).ready(function(){

             $(document).on("click",".updateProductStatus",function(){
                    var status = $(this).children().attr("status");
                    var product_id = $(this).attr("product_id");
                    $.ajax({
                         type: 'post',
                         url: "{{route('updateProductStatus')}}",
                         data: {
                            '_token' : "{{ csrf_token() }}",
                            status:status,
                            product_id:product_id
                                },
                        success:function(resp)
                        {
                            if(resp['status']==1)
                            {
                                $("#product-"+product_id).html("<i class='fas fa-toggle-on' status='Active' ></i>");
                            }else if(resp['status']==0)
                            {
                                $("#product-"+product_id).html("<i class='fas fa-toggle-off' status='Inactive' ></i>");
                            }

                        },
                        error:function(){
                            alert("Error");
                        }
                            })
                })
        });


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
