@extends('admin.layouts.auth')
@section('title','Categories')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>BRANDS TABLE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">brands</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">
                    <form action="{{ route('adminBrand') }}" method="get">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Category..." value="{{ request()->query('search') }}">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- <h5 class="card-title">Brands</h5> --}}
                <br>
                @if($pageModule['edit_access']=="on" || $pageModule['full_access']=="on")
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('createBrand') }}" class="btn btn-primary btn-lg active  " data-mdb-ripple-init role="button" aria-pressed="true">Add brand</a>
                    </div>
                @endif


                  <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>
                          <b>L</b>ogo
                        </th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                          <td class="w-25">
                            <img src="{{ asset('admin/assets/img') }}/{{ $brand->brand_logo }}" class="img-fluid img-thumbnail" width="80" height="20" alt="Sheep">
                          </td>
                          <td>{{ $brand->brand_name }}</td>

                          <td>{{ $brand->created_at }}</td>
                          <td>
                            <div class="table-actions">
                                @if($pageModule['edit_access']=="on" || $pageModule['full_access']=="on")
                                    @if($brand->status==1)
                                    <a class="updatebrandStatus btn btn-primary" href="javascript:void(0)" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}"  ><i class="fas fa-toggle-on" status="Active" ></i></a>
                                    @endif
                                    @if($brand->status==0)
                                    <a class="updatebrandStatus btn btn-primary" href="javascript:void(0)" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}"  ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                                    @endif
                                    <a href="{{ route('editBrand',$brand->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                                @endif
                                @if($pageModule['full_access']=="on")
                                <a class="btn btn-danger" href="{{ route('deleteBrand',$brand->id) }}" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>
                                @endif
                            </div>
                        </td>
                        </tr>
                        {{-- href="{{ route('deleteCms',$brand->id) }}" --}}
                        @empty
                        <h1>we dont any content to show</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $brands->links() }}
                  <!-- End Table with stripped rows -->

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
                $(document).on("click",".updatebrandStatus",function(){
                    var status = $(this).children().attr("status");
                    var brand_id = $(this).attr("brand_id");
                    $.ajax({
                         type: 'post',
                         url: "{{ route('updateBrandStatus') }}",
                         data: {
                            '_token' : "{{ csrf_token() }}",
                            status:status,
                            brand_id:brand_id
                                },
                        success:function(resp)
                        {
                            if(resp['status']==1)
                            {
                                $("#brand-"+brand_id).html("<i class='fas fa-toggle-on' status='Active' ></i>");
                            }else if(resp['status']==0)
                            {
                                $("#brand-"+brand_id).html("<i class='fas fa-toggle-off' status='Inactive' ></i>");
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
