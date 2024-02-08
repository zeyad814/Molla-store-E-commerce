@extends('admin.layouts.auth')
@section('title','Categories')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CATEGORIES TABLE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Categories</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <form action="{{ route('adminCategory') }}" method="get">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                {{-- <input type="search" name="search" vlaue="{{ Request::get('search') }}" class="form-control float-right" placeholder="Search"> --}}
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
                <div class="card-body">
                  <h5 class="card-title">categories</h5>
                  {{-- <a href="{{ route('createCategory') }}" class="col-12 btn btn-primary" >add Category</a> --}}
                  @if($categoriesModule['edit_access']=="on" || $categoriesModule['full_access']=="on")
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('createCategory') }}" class="btn btn-primary btn-lg active  " data-mdb-ripple-init role="button" aria-pressed="true">Add Category</a>
                    </div>
                    @endif
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>
                          <b>I</b>mage
                        </th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                          <td>{{ $category->id }}</td>
                          <td class="w-25">
                            <img src="{{ asset('admin/assets/img') }}/{{ $category->category_image }}" class="img-fluid img-thumbnail" width="80" height="20" alt="Sheep">
                          </td>
                          <td>{{ $category->category_name }}</td>

                          <td>{{ $category->created_at }}</td>
                          <td>
                            <div class="table-actions">
                                @if($categoriesModule['edit_access']=="on" || $categoriesModule['full_access']=="on")
                                @if($category->status ==1)
                                <a class="updateCategoryStatus btn btn-primary" href="javascript:void(0)" id="category-{{ $category->id }}" category_id="{{ $category->id }}"  ><i class="fas fa-toggle-on" status="Active" ></i></a>
                                @else
                                <a class="updateCategoryStatus btn btn-primary" href="javascript:void(0)" id="category-{{ $category->id }}" category_id="{{ $category->id }}"  ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                                @endif
                                <a href="{{ route('editCategory',$category->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                                @endif
                                @if($categoriesModule['full_access']=="on")
                                <a class="btn btn-danger" href="{{ route('deleteCategory',$category->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a>
                                @endif
                            </div>
                        </td>
                        </tr>
                        {{-- href="{{ route('deleteCms',$category->id) }}" --}}
                        @empty
                        <h1>we dont any content to show</h1>
                        @endforelse

                    </tbody>
                  </table>
                  {{ $categories->links() }}
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
                $(document).on("click",".updateCategoryStatus",function(){
                    var status = $(this).children().attr("status");
                    var category_id = $(this).attr("category_id");
                    $.ajax({
                         type: 'post',
                         url: "{{route('updateCategoryStatus')}}",
                         data: {
                            '_token' : "{{ csrf_token() }}",
                            status:status,
                            category_id:category_id
                                },
                        success:function(resp)
                        {
                            if(resp['status']==1)
                            {
                                $("#category-"+category_id).html("<i class='fas fa-toggle-on' status='Active' ></i>");
                            }else if(resp['status']==0)
                            {
                                $("#category-"+category_id).html("<i class='fas fa-toggle-off' status='Inactive' ></i>");
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
