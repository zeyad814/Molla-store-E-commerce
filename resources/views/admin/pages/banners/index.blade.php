@extends('admin.layouts.auth')
@section('title','Banner')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>BANNERS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">banners</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">banner Table</h5>
                @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('createBanner') }}" class="btn btn-primary btn-lg active" data-mdb-ripple-init role="button" aria-pressed="true">Add Banner</a>
                </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Type</th>
                        <th scope="col">link</th>
                        <th scope="col">title</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                        <tr>
                            <th scope="row">{{ $banner->id }}</th>
                            <td><img src="{{ asset('admin/assets/img/banners/'. $banner->image) }}" height="140px" alt=""></td>
                            <td>{{ $banner->type }}</td>
                            <td>{{ $banner->link }}</td>
                            <td>{{ $banner->title }}</td>
                            <td>
                                @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                                <div class="table-actions">
                                    @if($banner->status==1)
                                    <a class="updateBannerStatus btn btn-primary" href="javascript:void(0)" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}"  ><i class="fas fa-toggle-on" status="Active" ></i></a>
                                    @endif
                                    @if($banner->status==0)
                                    <a class="updateBannerStatus btn btn-primary" href="javascript:void(0)" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}"  ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                                    @endif
                                    <a href="{{ route('editBanner',$banner->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                                @endif
                                    @if($pageModule['full_access']=="on")
                                    <a class="btn btn-danger" href="{{ route('deleteBanner',$banner->id) }}" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h1>we dont have banners</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $banners->links() }}
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

            $(document).on('input','#search',function(){
                var search=$(this).val();
                 $.ajax({
                    url:"{{ route('adminProductSearch') }}",
                    method:'POST',
                    datatype:'html',
                    cache:false,
                    data:{'_token' : "{{ csrf_token() }}",
                            search:search},
                    success:function(data){
                        $('#ajax_search_result').html(data);
                    },
                    error:function(){
                        alert('Error');
                    }
                })
            });
            $(document).on('click','#ajax_search_pagination a',function(e){
                e.preventDefault();
                var search=$(this).val();
                $.ajax({
                    url:$(this).attr("href"),
                    method:'POST',
                    datatype:'html',
                    cache:false,
                    data:{'_token' : "{{ csrf_token() }}",
                            search:search},
                    success:function(data){
                        $('#ajax_search_result').html(data);
                    },
                    error:function(){
                    }
                })

            });
             $(document).on("click",".updateBannerStatus",function(){
                    var status = $(this).children().attr("status");
                    var banner_id = $(this).attr("banner_id");
                    $.ajax({
                         type: 'post',
                         url: "{{route('updateBannerStatus')}}",
                         data: {
                            '_token' : "{{ csrf_token() }}",
                            status:status,
                            banner_id:banner_id
                                },
                        success:function(resp)
                        {
                            if(resp['status']==1)
                            {
                                $("#banner-"+banner_id).html("<i class='fas fa-toggle-on' status='Active' ></i>");
                            }else if(resp['status']==0)
                            {
                                $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' status='Inactive' ></i>");
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
