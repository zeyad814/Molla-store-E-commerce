@extends('admin.layouts.auth')
@section('title','sub admins')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>SUB ADMINS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Sub Admins</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <form action="{{ route('subAdmins') }}" method="get">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                              <input type="text" name="search" class="form-control" placeholder="Search Category..." value="{{ request()->query('search') }}">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                  <a href="{{ route('subAdmins') }}" class="btn btn-default">
                                    <i class="fas fa-close"></i>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                  <a href="{{ route('addSubadmins') }}" class="col-12 btn btn-primary" >add Sub Admin</a>
                  <!-- Table with stripped rows -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>
                          <b>N</b>ame
                        </th>
                        <th>phone</th>
                        <th>email</th>
                        <th>Created on</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($subadmin as $subadmins)
                        <tr>
                          <td>{{ $subadmins->id }}</td>
                          <td>{{ $subadmins->name }}</td>
                          <td>{{ $subadmins->phone }}</td>
                          <td>{{ $subadmins->email }}</td>
                          <td>{{ $subadmins->created_at }}</td>
                          @if ($subadmins['status']==1)
                          <td>
                            <form action="{{ route("updateSubadminState",['id'=>$subadmins->id]) }}" method="post" >@csrf
                            <button type="submit"  class="btn btn-primary" >
                                <i class="fas fa-toggle-on"  ></i>
                            </button>
                            </form>
                        </td>
                          @else
                          <form action="{{ route("updateSubadminState",$subadmins->id   ) }}" method="post" >@csrf
                          <td>
                            <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-toggle-off" ></i>
                            </button>
                        </form>
                        </td>
                          @endif
                          <td>
                            <div class="table-actions">

                                  <div class="btn btn-danger"><a class="deleteCms" href="{{ route("deleteSubadmin",$subadmins->id   ) }}" onclick="confirmation(event)" title="Delete CMS page" name=" CMS page" ><i class="fas fa-trash" style="color: white"></i></a></div>
                                  <div class="btn btn-primary"><a class="deleteCms" href="{{ route("updateRoles",$subadmins->id) }}"  title="Roles"><i class="fas fa-unlock" style="color: white"></i></a></div>
                            </div>
                        </td>
                        </tr>
                        {{-- href="{{ route('deleteCms',$datas->id) }}" --}}
                        @empty
                        <h1>we dont any content to show</h1>
                        @endforelse

                    </tbody>
                  </table>
                  {{ $subadmin->links() }}
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
