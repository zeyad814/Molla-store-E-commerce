@extends('admin.layouts.auth')
@section('title','CMS')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CMS Table</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">CMS</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('adminCms') }}" method="get">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" name="search" class="form-control" placeholder="Search ..." value="{{ request()->query('search') }}">

                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                      </button>
                                      <a href="{{ route('coupon.index') }}" class="btn btn-default">
                                        <i class="fas fa-close"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                  <h5 class="card-title">CMS Page</h5>
                  @if($pageModule['edit_access']=="on" || $pageModule['full_access']=="on")
                  <a href="{{ route('createCms') }}" class="col-12 btn btn-primary" >add CMS</a>
                  @endif
                  <!-- Table with stripped rows -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>
                          <b>T</b>itle
                        </th>
                        <th>URL</th>
                        <th>Created on</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $datas)
                        <tr>
                          <td>{{ $datas->id }}</td>
                          <td>{{ $datas->title }}</td>
                          <td>{{ $datas->url }}</td>
                          <td>{{ $datas->created_at }}</td>
                        @if($pageModule['edit_access']=="on" || $pageModule['full_access']=="on")
                          @if ($datas['status']==1)
                          <td>
                            <form action="{{ route("updateCmsStatus",['id'=>$datas->id]) }}" method="post" >@csrf
                            <button type="submit"  class="btn btn-primary" >
                                <i class="fas fa-toggle-on"  ></i>
                            </button>
                            </form>
                        </td>
                          @else
                          <form action="{{ route("updateCmsStatus",['id'=>$datas->id]) }}" method="post" >@csrf
                          <td>
                            <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-toggle-off" ></i>
                            </button>
                        </form>
                        </td>
                          @endif
                          @endif
                          @if($pageModule['edit_access']=="on" || $pageModule['full_access']=="on")
                          <td>
                            <div class="table-actions">
                              <a href="{{ route('updateCms',$datas->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                          @endif
                          @if($pageModule['full_access']=="on")
                                  <div class="btn btn-danger"><a class="deleteCms" href="{{ route('deleteCms',$datas->id) }}" onclick="confirmation(event)" title="Delete CMS page" name=" CMS page" ><i class="bi bi-trash" style="color: white"></i></a></div>
                            </div>
                            @endif
                        </td>
                        </tr>
                        {{-- href="{{ route('deleteCms',$datas->id) }}" --}}
                        @empty
                        <h1>we dont any content to show</h1>
                        @endforelse

                    </tbody>
                  </table>
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
        //  $(document).ready(function(){

        //         $(document).on("click",".updateCmsPageStatus",function(){
        //             var status = $(this).attr("status");
        //             var page_id = $(this).attr("page_id");
        //             // alert(status);
        //             $.ajax({
        //                  type: 'post',
        //                  url: "{{route('updateCmsStatus')}}",
        //                  data: {
        //                     '_token' : "{{ csrf_token() }}",
        //                     status:status,
        //                     page_id:page_id
        //                         },
        //                 success:function(resp){

        //                 },error:function(){
        //                     alert("Error");
        //                 }
        //                     })
        //         })
        //  });
        ////////////////////////////////////////////////////////////////////////////
        // confirm arlert
        // $(document).on("click",".deleteCms",function(){
        //     var name = $(this).attr('name');
        //     if(confirm('Are you sure to delete this' +name+ '?')){
        //         return true;
        //     }
        //     return false;
        // })
        ////confrim by sweet arlert2
        // $(document).on("click",".deleteCms",function(){
        //     var record = $(this).attr('record');
        //     var recordid=$(this).atte('recordid');
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, delete it!"
        //         }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //             title: "Deleted!",
        //             text: "Your file has been deleted.",
        //             icon: "success"
        //             })
        //         }
        //         });
        // })
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
